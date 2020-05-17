<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Buku;
use Validator,File,Redirect,Response;
use PDF;
use App\Exports\BukuExport;
use Maatwebsite\Excel\Facades\Excel;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.kategori_id')
        ->select('buku.*', 'pengarang.nama','penerbit.nama AS pen','kategori.nama AS kat')
        ->get();
        return view('buku.index', compact('ar_buku'));
    }

    public function koleksiBuku()
    {
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.kategori_id')
        ->select('buku.*', 'pengarang.nama','penerbit.nama AS pen','kategori.nama AS kat')
        ->get();
        return view('buku.koleksi', compact('ar_buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('buku.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'isbn' => 'required|unique:buku|max:100',
            'judul' => 'required|max:100',
            'tahun_cetak' => 'required|integer',
            'stok' => 'required|integer',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'kategori' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ],
        [
            'isbn.required' => 'ISBN wajib diisi !!!',
            'isbn.unique' => 'ISBN sudah ada !!!',
            'isbn.max' => 'ISBN maksimal 100 karakter !!!',
            'judul.required' => 'Judul Buku wajib diisi !!!',
            'judul.max' => 'Judul Buku maksimal 100 karakter !!!',
            'tahun_cetak.required' => 'Tahun Cetak wajib diisi !!!',
            'tahun_cetak.integer' => 'Tahun Cetak harus berupa angka !!!',
            'stok.required' => 'Stok wajib diisi !!!',
            'stok.integer' => 'Stok harus berupa angka !!!',
            'penerbit.required' => 'Penerbit wajib diisi !!!',
            'pengarang.required' => 'Pengarang wajib diisi !!!',
            'kategori.required' => 'Kategori wajib diisi !!!',
            'cover.image' => 'Ekstensi file yang boleh hanya jpg,jpeg,png',
            'cover.max' => 'Ukuran file cover buku terlalu besar, maksimal 2MB'
        ]
    );

        if(!empty($request->cover)) {
            $fileName = $request->isbn.'.'.$request->cover->extension();  
            $request->cover->move(public_path('img/buku'), $fileName);
        } else { 
            $fileName = '';
        }

        DB::table('buku')->insert(
            [
                'isbn'=>$request->isbn,
                'judul'=>$request->judul,
                'tahun_cetak'=>$request->tahun_cetak,
                'stok'=>$request->stok,
                'idpenerbit'=>$request->penerbit,
                'idpengarang'=>$request->pengarang,
                'kategori_id'=>$request->kategori,
                'cover'=>$fileName  
        ]);
        return redirect('/buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.kategori_id')
        ->select('buku.*', 'pengarang.nama','penerbit.nama AS pen','kategori.nama AS kat')
        ->where('buku.id','=', $id)
        ->get();
        return view('buku.show', compact('ar_buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Buku::where('id', $id)->get();
        return view('buku.form_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'isbn' => 'required|max:100',
            'judul' => 'required|max:100',
            'tahun_cetak' => 'required|integer',
            'stok' => 'required|integer',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'kategori' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ],
        [
            'isbn.required' => 'ISBN wajib diisi !!!',
            'isbn.max' => 'ISBN maksimal 100 karakter !!!',
            'judul.required' => 'Judul Buku wajib diisi !!!',
            'judul.max' => 'Judul Buku maksimal 100 karakter !!!',
            'tahun_cetak.required' => 'Tahun Cetak wajib diisi !!!',
            'tahun_cetak.integer' => 'Tahun Cetak harus berupa angka !!!',
            'stok.required' => 'Stok wajib diisi !!!',
            'stok.integer' => 'Stok harus berupa angka !!!',
            'penerbit.required' => 'Penerbit wajib diisi !!!',
            'pengarang.required' => 'Pengarang wajib diisi !!!',
            'kategori.required' => 'Kategori wajib diisi !!!',
            'cover.image' => 'Ekstensi file yang boleh hanya jpg,jpeg,png',
            'cover.max' => 'Ukuran file cover buku terlalu besar, maksimal 2MB',
        ]
    );

        $cover = DB::table('buku')->select('cover')
                ->where('id', $id)->get();
        foreach($cover as $c) {
            $namaFile = $c->cover;
        }

        if(!empty($request->cover)) {
            
            File::delete(public_path('img/buku/'.$namaFile));

            $request->validate([
                'file' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $fileName = $request->nama.'.'.$request->cover->extension();  
            $request->cover->move(public_path('img/buku'), $fileName);
        } else { 
            $fileName = $namaFile;
        }

        DB::table('buku')->where('id',$id)->update(
            [
                'isbn'=>$request->isbn,
                'judul'=>$request->judul,
                'tahun_cetak'=>$request->tahun_cetak,
                'stok'=>$request->stok,
                'idpenerbit'=>$request->penerbit,
                'idpengarang'=>$request->pengarang,
                'kategori_id'=>$request->kategori,
                'cover'=>$fileName  
        ]);
        return redirect('/buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cover = DB::table('buku')->select('cover')
                ->where('id', $id)->get();
        foreach($cover as $c) {
            $namaFile = $c->cover;
        }

        File::delete(public_path('img/buku/'.$namaFile));

        DB::table('buku')->where('id',$id)->delete();
        return redirect('/buku');
    }

    public function generatePDF()
    {
        $data = ['title' => 'Coba PDF'];
        $pdf = PDF::loadView('buku/pdf', $data);
        return $pdf->download('coba.pdf');
    }

    public function bukuPDF()
    {
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.kategori_id')
        ->select('buku.*', 'pengarang.nama','penerbit.nama AS pen','kategori.nama AS kat')
        ->get();
        $pdf = PDF::loadView('buku/bukuPDF',['ar_buku'=>$ar_buku]);
        return $pdf->download('dataBuku.pdf');
    }

    public function bukuExcel() 
    {
        return Excel::download(new BukuExport, 'buku.xlsx');
    }

}

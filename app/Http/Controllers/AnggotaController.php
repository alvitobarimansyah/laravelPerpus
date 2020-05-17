<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Anggota;
use Validator,File,Redirect,Response;
use PDF;
use App\Exports\AnggotaExport;
use Maatwebsite\Excel\Facades\Excel;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_anggota = DB::table('anggota')->get();
        return view('anggota.index', compact('ar_anggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('anggota.form');
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
        'no' => 'required|integer|unique',
        'nama' => 'required|max:45',
        'gender' => 'required',
        'tmplahir' => 'required',
        'tgllahir' => 'required',
        'alamat' => 'required',
        'email' => 'nullable|email|max:45',
        'hp' => 'required|integer',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ],
    [
        'no.required' => 'No Anggota wajib diisi',
        'no.integer' => 'No Anggota harus berupa angka',
        'no.unique' => 'No Anggota sudah ada',
        'nama.required' => 'Nama wajib diisi',
        'nama.max' => 'Nama maksimal 45 karakter',
        'gender.required' => 'Jenis Kelamin wajib diisi',
        'tmplahir.required' => 'Tempat Lahir wajib diisi',
        'tgllahir.required' => 'Tanggal Lahir wajib diisi',
        'alamat.required' => 'Alamat wajib diisi',
        'email.email' => 'Email wajib diisi',
        'email.max' => 'Email maksimal 45 karakter',
        'hp.required' => 'No Hp wajib diisi',
        'hp.integer' => 'No Hp harus berupa angka',
        'foto.image' => 'Ekstensi file yang boleh hanya jpg,jpeg,png',
        'foto.max' => 'Ukuran file foto terlalu besar, maksimal 2MB',
    ]
);

    if(!empty($request->foto)) {
        $fileName = $request->nama.'.'.$request->foto->extension();  
        $request->foto->move(public_path('img/anggota'), $fileName);
    } else { 
        $fileName = '';
    }

        DB::table('anggota')->insert(
            [
                'no_anggota'=>$request->no,
                'nama'=>$request->nama,
                'gender'=>$request->gender,
                'tempat_lahir'=>$request->tmplahir,
                'tanggal_lahir'=>$request->tgllahir,
                'alamat'=>$request->alamat,
                'email'=>$request->email,
                'hp'=>$request->hp,
                'foto'=>$fileName  
        ]);
        return redirect('/anggota');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_anggota = DB::table('anggota')->where('anggota.id','=', $id)->get();
        return view('anggota.show', compact('ar_anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Anggota::where('id', $id)->get();
        return view('anggota.form_edit', compact('data'));
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
            'no' => 'required|integer',
            'nama' => 'required|max:45',
            'gender' => 'required',
            'tmplahir' => 'required',
            'tgllahir' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|max:45',
            'hp' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ],
        [
            'no.required' => 'No Anggota wajib diisi',
            'no.integer' => 'No Anggota harus berupa angka',
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 45 karakter',
            'gender.required' => 'Jenis Kelamin wajib diisi',
            'tmplahir.required' => 'Tempat Lahir wajib diisi',
            'tgllahir.required' => 'Tanggal Lahir wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus berupa email',
            'email.max' => 'Email maksimal 45 karakter',
            'hp.required' => 'No Hp wajib diisi',
            'hp.integer' => 'No Hp harus berupa angka',
            'foto.image' => 'Ekstensi file yang boleh hanya jpg,jpeg,png',
            'foto.max' => 'Ukuran file foto terlalu besar, maksimal 2MB',
        ]
    );
    
        if(!empty($request->foto)) {
            $fileName = $request->nama.'.'.$request->foto->extension();  
            $request->foto->move(public_path('img/anggota'), $fileName);
        } else { 
            $fileName = '';
        }

        DB::table('anggota')->where('id',$id)->update(
            [
                'no_anggota'=>$request->no,
                'nama'=>$request->nama,
                'gender'=>$request->gender,
                'tempat_lahir'=>$request->tmplahir,
                'tanggal_lahir'=>$request->tgllahir,
                'alamat'=>$request->alamat,
                'email'=>$request->email,
                'hp'=>$request->hp,
                'foto'=>$fileName   
        ]);
        return redirect('/anggota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foto = DB::table('anggota')->select('foto')
                ->where('id', $id)->get();
        foreach($foto as $f) {
            $namaFile = $f->foto;
        }

        File::delete(public_path('img/anggota/'.$namaFile));

        DB::table('anggota')->where('id',$id)->delete();
        return redirect('/anggota');
    }

    public function generatePDF()
    {
        $data = ['title' => 'Coba PDF'];
        $pdf = PDF::loadView('anggota/pdf', $data);
        return $pdf->download('coba.pdf');
    }

    public function anggotaPDF()
    {
        $ar_anggota = DB::table('anggota')->get();
        $pdf = PDF::loadView('anggota/anggotaPDF',['ar_anggota'=>$ar_anggota]);
        return $pdf->download('dataAnggota.pdf');
    }

    public function anggotaExcel() 
    {
        return Excel::download(new AnggotaExport, 'anggota.xlsx');
    }
}

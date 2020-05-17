<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pengarang;
use Validator,File,Redirect,Response;
use PDF;

class PengarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_pengarang = DB::table('pengarang')->get();
        return view('pengarang.index', compact('ar_pengarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengarang.form');
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
            'nama' => 'required|max:45',
            'email' => 'nullable|email|max:45',
            'hp' => 'nullable|max:15',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ],
        [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 45 karakter',
            'email.max' => 'Email maksimal 45 karakter',
            'hp.max' => 'No Hp harus 15 karakter',
            'foto.image' => 'Ekstensi file yang boleh hanya jpg,jpeg,png',
            'foto.max' => 'Ukuran file foto terlalu besar, maksimal 2MB',
        ]
    );
    
        if(!empty($request->foto)) {
            $fileName = $request->nama.'.'.$request->foto->extension();  
            $request->foto->move(public_path('img/pengarang'), $fileName);
        } else { 
            $fileName = '';
        }

        DB::table('pengarang')->insert(
            [ 
                'nama'=>$request->nama,
                'email'=>$request->email,
                'hp'=>$request->hp,
                'foto'=>$fileName
                //'foto'=>$request->foto,     
            ]);
            //landing page
            return redirect('/pengarang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pengarang::where('id', $id)->get();
        return view('pengarang.form_edit', compact('data'));
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
            'nama' => 'required|max:45',
            'email' => 'nullable|email|max:45',
            'hp' => 'nullable|max:15',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ],
        [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 45 karakter',
            'email.max' => 'Email maksimal 45 karakter',
            'hp.max' => 'No Hp harus 15 karakter',
            'foto.image' => 'Ekstensi file yang boleh hanya jpg,jpeg,png',
            'foto.max' => 'Ukuran file foto terlalu besar, maksimal 2MB',
        ]
    );
    
        if(!empty($request->foto)) {
            $fileName = $request->nama.'.'.$request->foto->extension();  
            $request->foto->move(public_path('img/pengarang'), $fileName);
        } else { 
            $fileName = '';
        }
        
        $foto = DB::table('pengarang')->select('foto')
                ->where('id', $id)->get();
        foreach($foto as $f) {
            $namaFile = $f->foto;
        }

        if(!empty($request->foto)) {
            
            File::delete(public_path('img/pengarang/'.$namaFile));

            $request->validate([
                'file' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $fileName = $request->nama.'.'.$request->foto->extension();  
            $request->foto->move(public_path('img/pengarang'), $fileName);
        } else { 
            $fileName = $namaFile;
        }

        DB::table('pengarang')->where('id',$id)->update(
            [
                'nama'=>$request->nama,
                'email'=>$request->email,
                'hp'=>$request->hp,
                'foto'=>$fileName
        ]);
        return redirect('/pengarang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foto = DB::table('pengarang')->select('foto')
                ->where('id', $id)->get();
        foreach($foto as $f) {
            $namaFile = $f->foto;
        }
        File::delete(public_path('img/pengarang/'.$namaFile));

        DB::table('pengarang')->where('id',$id)->delete();
        return redirect('/pengarang');
    }

    public function generatePDF()
    {
        $data = ['title' => 'Coba PDF'];
        $pdf = PDF::loadView('pengarang/pdf', $data);
        return $pdf->download('coba.pdf');
    }

    public function pengarangPDF()
    {
        $ar_pengarang = DB::table('pengarang')->get();
        $pdf = PDF::loadView('pengarang/pengarangPDF',['ar_pengarang'=>$ar_pengarang]);
        return $pdf->download('dataPengarang.pdf');
    }

    public function pengarangExcel() 
    {
        return Excel::download(new PengarangExport, 'pengarang.xlsx');
    }
}

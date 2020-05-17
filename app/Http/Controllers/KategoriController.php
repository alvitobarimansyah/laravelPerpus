<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Kategori;
use Validator,File,Redirect,Response;
use PDF;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_kategori = DB::table('kategori')->get();
        return view('kategori.index', compact('ar_kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.form');
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
        ],
        [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 45 karakter',
        ]
    );

        DB::table('kategori')->insert(
            [
                'nama'=>$request->nama
        ]);
        return redirect('/kategori');
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
        $data = Kategori::where('id', $id)->get();
        return view('kategori.form_edit', compact('data'));
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
        ],
        [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 45 karakter',
        ]
    );
    
        DB::table('kategori')->where('id',$id)->update(
            [
                'nama'=>$request->nama
        ]);
        return redirect('/kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('kategori')->where('id',$id)->delete();
        return redirect('/kategori');
    }

    public function generatePDF()
    {
        $data = ['title' => 'Coba PDF'];
        $pdf = PDF::loadView('kategori/pdf', $data);
        return $pdf->download('coba.pdf');
    }

    public function kategoriPDF()
    {
        $ar_kategori = DB::table('kategori')->get();
        $pdf = PDF::loadView('kategori/kategoriPDF',['ar_kategori'=>$ar_kategori]);
        return $pdf->download('dataKategori.pdf');
    }

    public function kategoriExcel() 
    {
        return Excel::download(new KategoriExport, 'kategori.xlsx');
    }
}

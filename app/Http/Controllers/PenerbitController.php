<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//tambahan
use DB;
use App\Penerbit;
use Validator,File,Redirect,Response;
use PDF;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_penerbit = DB::table('penerbit')->get();
        return view('penerbit.index', compact('ar_penerbit'));
    }

    /**
     * Show the form for creating 
     * a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penerbit.form');
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
            'nama' => 'required|unique|max:45',
            'alamat' => 'required',
            'email' => 'nullable|email|max:45',
            'website' => 'nullable|max:45',
            'telp' => 'nullable|integer|max:15',
            'cp' => 'nullable|max:45'
        ],
        [
            'nama.required' => 'Nama wajib diisi',
            'nama.unique' => 'Nama sudah ada',
            'nama.max' => 'Nama maksimal 45 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'email.max' => 'Email maksimal 45 karakter',
            'website.max' => 'Website maksimal 45 karakter',
            'telp.integer' => 'No Telp harus angka',
            'telp.max' => 'No Telp maksimal 15 karakter',
            'cp.max' => 'Contact Person maksimal 45 karakter'
        ]
    );
    
        DB::table('penerbit')->insert(
            [
                'nama'=>$request->nama,
                'alamat'=>$request->alamat,
                'email'=>$request->email,
                'website'=>$request->website,
                'telp'=>$request->telp,
                'cp'=>$request->cp
        ]);
        return redirect('/penerbit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_penerbit = DB::table('penerbit')
        ->where('penerbit.id','=', $id)
        ->get();
        return view('penerbit.show', compact('ar_penerbit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Penerbit::where('id', $id)->get();
        return view('penerbit.form_edit', compact('data'));
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
            'alamat' => 'required',
            'email' => 'nullable|email|max:45',
            'website' => 'nullable|max:45',
            'telp' => 'nullable|max:15',
            'cp' => 'nullable|max:45'
        ],
        [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 45 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'email.max' => 'Email maksimal 45 karakter',
            'website.max' => 'Website maksimal 45 karakter',
            'telp.max' => 'No Telp maksimal 15 karakter',
            'cp.max' => 'Contact Person maksimal 45 karakter'
        ]
    );

        DB::table('penerbit')->where('id',$id)->update(
            [
                'nama'=>$request->nama,
                'alamat'=>$request->alamat,
                'email'=>$request->email,
                'website'=>$request->website,
                'telp'=>$request->telp,
                'cp'=>$request->cp
        ]);
        return redirect('/penerbit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('penerbit')->where('id',$id)->delete();
        return redirect('/penerbit');
    }

    public function generatePDF()
    {
        $data = ['title' => 'Coba PDF'];
        $pdf = PDF::loadView('penerbit/pdf', $data);
        return $pdf->download('coba.pdf');
    }

    public function penerbitPDF()
    {
        $ar_penerbit = DB::table('penerbit')->get();
        $pdf = PDF::loadView('penerbit/penerbitPDF',['ar_penerbit'=>$ar_penerbit]);
        return $pdf->download('dataPenerbit.pdf');
    }

    public function penerbitExcel() 
    {
        return Excel::download(new PenerbitExport, 'penerbit.xlsx');
    }
}

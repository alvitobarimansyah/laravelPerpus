<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_member = DB::table('users')->get();
        return view('member.index', compact('ar_member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('users')->insert(
            [
                'name'=>$request->nama,
                'email'=>$request->email,
                'password'=>$request->password,
                'role'=>$request->role,
                'isactive'=>$request->isactive,
                'foto'=>$request->foto  
        ]);
        return redirect('/member');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_member = DB::table('users')->where('users.id','=', $id)->get();
        return view('member.show', compact('ar_member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Member::where('id', $id)->get();
        return view('member.form_edit', compact('data'));
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
        DB::table('users')->where('id',$id)->update(
            [
                'name'=>$request->nama,
                'email'=>$request->email,
                'password'=>$request->password,
                'role'=>$request->role,
                'isactive'=>$request->isactive,
                'foto'=>$request->foto  
        ]);
        return redirect('/member');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id',$id)->delete();
        return redirect('/member');
    }
}

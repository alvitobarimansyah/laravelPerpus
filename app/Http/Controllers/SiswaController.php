<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function dataSiswa() {
        $siswa1 = 'Alvito'; $alamat1 = 'Walang Timur';
        $siswa2 = 'Sunan'; $alamat2 = 'Bendungan Melayu';

        return view('siswa', compact('siswa1','siswa2','alamat1','alamat2'));
    }
}
<?php

namespace App\Exports;

use App\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class BukuExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Buku::all();
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.kategori_id')
        ->select('buku.isbn', 'buku.judul', 'buku.tahun_cetak', 'buku.stok', 
            'pengarang.nama','penerbit.nama AS pen','kategori.nama AS kat')
        ->get();

        return $ar_buku;
    }
}

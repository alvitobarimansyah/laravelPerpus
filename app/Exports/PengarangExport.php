<?php

namespace App\Exports;

use App\Pengarang;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengarangExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $ar_pengarang = DB::table('pengarang')->get();
        return $ar_pengarang;
    }
}

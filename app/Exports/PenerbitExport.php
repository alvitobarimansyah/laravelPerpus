<?php

namespace App\Exports;

use App\Penerbit;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenerbitExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $ar_penerbit = DB::table('penerbit')->get();   
        return $ar_penerbit;
    }
}

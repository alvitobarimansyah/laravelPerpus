@extends('layouts.index')
@section('content')
    
@php
$no = 1;
$p1 = ['nama'=>'Budi', 'produk'=>'TV', 'jumlah'=>2];
$p2 = ['nama'=>'Siti', 'produk'=>'AC', 'jumlah'=>1];
$p3 = ['nama'=>'Dewi', 'produk'=>'Kulkas', 'jumlah'=>3];
$ar_pembeli = [$p1,$p2,$p3];
$ar_judul = ['No', 'Nama', 'Produk', 'Jumlah', 'Harga Satuan', 'Harga Kotor', 'Diskon', 'PPN', 'Harga Bayar'];
@endphp
<h3 align="center"> Daftar Pembelian Produk Toko  </h3>
<table border="1" cellpadding="10" align="center">
    <thead>
        <tr>

            @foreach($ar_judul as $jdl)
                <th> {{ $jdl }} </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($ar_pembeli as $pembeli)
            {{-- harga satuan --}}
            @switch ($pembeli['produk'])
                @case('TV') @php $harsat = 2000000; @endphp @break
                @case('AC') @php $harsat = 3000000; @endphp @break
                @case('Kulkas') @php $harsat = 4000000; @endphp @break
                @default @php $harsat = 0; @endphp
            @endswitch
            @php $harkot = $harsat * $pembeli['jumlah']; @endphp
            @if($pembeli['produk'] >= 'Kulkas' && $pembeli['jumlah'] >= 3) @php $diskon = 0.3 * $harkot ; @endphp
            @elseif($pembeli['produk'] >= 'AC' && $pembeli['jumlah'] >= 2) @php $diskon = 0.2 * $harkot ; @endphp
            @else @php $diskon = 0.1 * $harkot; @endphp
            @endif
            @php
                $ppn = ($harkot - $diskon) * 0.1;
                $harbay = ($harkot - $diskon) + $ppn;
            @endphp
            <tr>
                <td> {{ $no++ }} </td>
                <td> {{ $pembeli['nama'] }} </td>
                <td> {{ $pembeli['produk'] }} </td>
                <td> {{ $pembeli['jumlah'] }} </td>
                <td> {{ $harsat }} </td>
                <td> Rp. {{ number_format ($harkot,0,',','.') }}  </td>
                <td> Rp. {{ number_format ($diskon,0,',','.') }}  </td>
                <td> RP. {{ number_format ($ppn,2,',','.') }}  </td>
                <td> Rp. {{ number_format ($harbay,2,',','.') }}  </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
@extends('layouts.index')
@section('content')
    @foreach ($ar_buku as $buku)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $buku->judul}}</h6>
        </div>
        <div class="card-body">
        @if(!empty($buku->cover))
        <td><img src="{{asset('img/buku')}}/{{ $buku->cover }}" height="20%" /></td>
        @else
        <td><img src="{{asset('img')}}/nophoto.png" height="20%" /></td>
        @endif <br>
        ISBN : {{ $buku->isbn}} <br>
        Tahun Cetak : {{ $buku->tahun_cetak}} <br>
        Stok : {{ $buku->stok}} <br>
        Pengarang : {{ $buku->nama}} <br>
        Penerbit : {{ $buku->pen}} <br>
        Kategori : {{ $buku->kat}} <br>
        </div>
    </div>  
    @if ( Auth::user()->role != 'anggota')
    <a href="{{url('buku')}}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i>
        Go Back
    </a>         
    @else
    <a href="{{url('koleksibuku')}}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i>
        Go Back
    </a>  
    @endif
    @endforeach
@endsection
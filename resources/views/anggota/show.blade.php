@extends('layouts.index')
@section('content')
    @foreach ($ar_anggota as $anggota)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $anggota->nama}}</h6>
        </div>
        <div class="card-body">
        @if(!empty($anggota->foto))
        <td><img src="{{asset('img/anggota')}}/{{ $anggota->foto }}" height="20%" /></td>
        @else
        <td><img src="{{asset('img')}}/nophoto.png" height="20%" /></td>
        @endif <br>
        No Anggota : {{ $anggota->no_anggota}} <br>
        Jenis Kelamin : {{ $anggota->gender}} <br>
        Tempat Lahir : {{ $anggota->tempat_lahir}} <br>
        Tanggal Lahir : {{ $anggota->tanggal_lahir}} <br>
        Alamat : {{ $anggota->alamat}} <br>
        Email : {{ $anggota->email}} <br>
        No HP : {{ $anggota->hp}} <br>
        </div>
    </div>  
    <a href="{{url('anggota')}}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i>
        Go Back
    </a>  
    @endforeach
@endsection
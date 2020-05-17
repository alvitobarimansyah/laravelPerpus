@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota')
@php
    $no = 1;
    $ar_judul = ['No', 'Pengarang', 'Email', 'No.Hp', 'Foto', 'Action'];
@endphp
<a href="{{route('pengarang.create')}}" class="btn btn-primary">
    Add Data
</a>
<a href="{{ url('pengarangpdf') }}" class="btn btn-info">
  <i class="fas fa-file-pdf"></i> Unduh Pengarang 
</a>
<a href="{{ url('exportpengarang') }}" class="btn btn-success">
  <i class="fas fa-file-excel"></i> Unduh Pengarang 
</a>
<br><br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"> Daftar Pengarang </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                @foreach ($ar_judul as $jdl)
                    <th> {{ $jdl }} </th>
                @endforeach 
                </tr>
            </thead>
            <tbody>
                @foreach ($ar_pengarang as $pengarang)
                <tr>
                    <td> {{ $no++ }} </td>
                    <td> {{ $pengarang->nama }} </td>
                    <td> {{ $pengarang->email }} </td>
                    <td> {{ $pengarang->hp }} </td>
                    @if(!empty($pengarang->foto))
                    <td><img src="{{asset('img/pengarang')}}/{{ $pengarang->foto }}" height="20%" /></td>
                    @else
                    <td><img src="{{asset('img')}}/nophoto.png" height="20%" /></td>
                    @endif
                    <td>
                      <form method="POST" action="{{ route('pengarang.destroy',$pengarang->id) }}">
                        @csrf
                        @method('DELETE')
                        <a href="{{route('pengarang.edit',$pengarang->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>&nbsp;
                        <button type="submit" onclick="return confirm('Yakin dihapus')" class="btn btn-danger">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
  @else
    @include('auth.terlarang')
  @endif
@endsection
@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota')
@php
    $no = 1;
    $ar_judul = ['No', 'Penerbit', 'Alamat', 'Email', 'Action'];
@endphp
<a href="{{route('penerbit.create')}}" class="btn btn-primary">
    Add Data
</a>
<a href="{{ url('penerbitpdf') }}" class="btn btn-info">
  <i class="fas fa-file-pdf"></i> Unduh Penerbit 
</a>
<a href="{{ url('exportpenerbit') }}" class="btn btn-success">
  <i class="fas fa-file-excel"></i> Unduh Penerbit 
</a>
<br><br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"> Daftar Penerbit </h6>
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
                @foreach ($ar_penerbit as $penerbit)
                <tr>
                    <td> {{ $no++ }} </td>
                    <td> {{ $penerbit->nama }} </td>
                    <td> {{ $penerbit->alamat }} </td>
                    <td> {{ $penerbit->email }} </td>
                    <td>
                      <form method="POST" action="{{ route('penerbit.destroy',$penerbit->id) }}">
                        @csrf
                        @method('DELETE')
                        <a href="{{route('penerbit.show',$penerbit->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>&nbsp;
                        <a href="{{route('penerbit.edit',$penerbit->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>&nbsp;
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
@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota')   
  @php
    $no = 1;
    $ar_judul = ['No', 'ISBN', 'Judul', 'Pengarang', 
                'Penerbit', 'Kategori', 'Cover', 'Action'];
  @endphp
  <a href="{{route('buku.create')}}" class="btn btn-primary">
    Add Data
  </a>
  <a href="{{ url('bukupdf') }}" class="btn btn-info">
    <i class="fas fa-file-pdf"></i> Unduh Buku 
  </a>
  <a href="{{ url('exportbuku') }}" class="btn btn-success">
    <i class="fas fa-file-excel"></i> Unduh Buku 
  </a>
  <br><br>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"> Daftar Koleksi Buku </h6>
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
            @foreach ($ar_buku as $buku)
              <tr>
                <td> {{ $no++ }} </td>
                <td> {{ $buku->isbn }} </td>
                <td> {{ $buku->judul }} </td>
                <td> {{ $buku->nama }} </td>
                <td> {{ $buku->pen }} </td>
                <td> {{ $buku->kat }} </td>
                <td>
                  @if(!empty($buku->cover))
                  <img src="{{asset('img/buku')}}/{{ $buku->cover }}" height="10%">
                  @else
                  <img src="{{asset('img')}}/nophoto.png" height="10%">
                  @endif
                </td>
                <td>
                  <form method="POST" action="{{ route('buku.destroy',$buku->id) }}">
                    @csrf
                    @method('DELETE')
                    <a href="{{route('buku.show',$buku->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>&nbsp;
                    <a href="{{route('buku.edit',$buku->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>&nbsp;
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
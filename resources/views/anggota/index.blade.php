@extends('layouts.index')
@section('content')
  @php
    $no = 1;
    $ar_judul = ['No', 'No Anggota', 'Nama',                                                                                
                'Email', 'Foto', 'Action'];
  @endphp
  <a href="{{route('anggota.create')}}" class="btn btn-primary">
    Add Data
  </a>
  <a href="{{ url('anggotapdf') }}" class="btn btn-info">
    <i class="fas fa-file-pdf"></i> Unduh Anggota
  </a>
  <a href="{{ url('exportanggota') }}" class="btn btn-success">
    <i class="fas fa-file-excel"></i> Unduh Anggota
  </a>
  <br><br>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"> Daftar Anggota </h6>
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
            @foreach ($ar_anggota as $anggota)
              <tr>
                <td> {{ $no++ }} </td>
                <td> {{ $anggota->no_anggota }} </td>
                <td> {{ $anggota->nama }} </td>
                <td> {{ $anggota->email }} </td>
                @if(!empty($anggota->foto))
                <td><img src="{{asset('img/anggota')}}/{{ $anggota->foto }}" height="10%" /></td>
                @else
                <td><img src="{{asset('img')}}/nophoto.png" height="10%" /></td>
                @endif
                <td>
                  <form method="POST" action="{{ route('anggota.destroy',$anggota->id) }}">
                    @csrf
                    @method('DELETE')
                    <a href="{{route('anggota.show',$anggota->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>&nbsp;
                    <a href="{{route('anggota.edit',$anggota->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>&nbsp;
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
@endsection
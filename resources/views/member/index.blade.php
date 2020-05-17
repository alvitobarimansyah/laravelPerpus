@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota')    
  @php
    $no = 1;
    $ar_judul = ['No', 'Nama', 'Email', 'Role', 
                'Active', 'Foto', 'Action'];
  @endphp
  <a href="{{route('member.create')}}" class="btn btn-primary">
        Add Data
  </a>
  <br><br>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"> Daftar User </h6>
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
            @foreach ($ar_member as $member)
              <tr>
                <td> {{ $no++ }} </td>
                <td> {{ $member->name }} </td>
                <td> {{ $member->email }} </td>
                <td> {{ $member->role }} </td>
                <td> {{ $member->isactive }} </td>
                <td>
                  @if(!empty($member->foto))
                  <img src="{{asset('img/member')}}/{{ $member->foto }}" height="10%">
                  @else
                  <img src="{{asset('img')}}/nophoto.png" height="10%">
                  @endif
                </td>
                <td>
                  <form method="POST" action="{{ route('member.destroy',$member->id) }}">
                    @csrf
                    @method('DELETE')
                    <a href="{{route('member.show',$member->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>&nbsp;
                    <a href="{{route('member.edit',$member->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>&nbsp;
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
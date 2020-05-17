@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota')
    @foreach ($data as $rs)
        <h3> Form Input Kategori </h3>
        <form class="user" method="POST" action="{{route('kategori.update',$rs->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                @php $val = ($errors->isEmpty()) ? $rs->nama : old('nama'); @endphp
                <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" 
                placeholder="Nama Kategori" value="{{ $val }}">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror 
            </div>
            <button type="submit" name="proses" value="ubah" class="btn btn-warning">
                Update
            </button>
        </form>
    @endforeach
    @else
    @include('auth.terlarang')
  @endif
@endsection
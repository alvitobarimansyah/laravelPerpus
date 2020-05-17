@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota')
<h3> Form Input Pengarang </h3>
<form class="user" method="POST" action="{{route('pengarang.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" placeholder="Nama Pengarang" value="{{ old('nama') }}">
        @error('nama')<div class="invalid-feedback"> {{ $message }} </div>@enderror
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror " 
        placeholder="Email" value="{{ old('email') }}">
        @error('email')<div class="invalid-feedback"> {{ $message }} </div>@enderror
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user @error('hp') is-invalid @enderror" name="hp" placeholder="No.Hp" value="{{ old('hp') }}">
        @error('hp')<div class="invalid-feedback"> {{ $message }} </div>@enderror
    </div>
    <div class="form-group">
        <label> Foto </label>
        <input type="file" name="foto" class="form-control  @error('foto') is-invalid @enderror" value="{{ old('foto') }}">
        @error('foto')<div class="invalid-feedback"> {{ $message }} </div>@enderror
    </div>
    
    <button type="submit" name="proses" value="simpan" class="btn btn-primary">
      Add
    </button>
  </form>
  @else
  @include('auth.terlarang')
@endif
@endsection
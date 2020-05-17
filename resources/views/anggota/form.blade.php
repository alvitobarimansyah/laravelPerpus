@extends('layouts.index')
@section('content')
@php
  $ar_gender = ['Laki-Laki'=>'L','Perempuan'=>'P'];
@endphp
  <h3> Form Input Anggota </h3>
  <form class="user" method="POST" action="{{route('anggota.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <input type="text" name="no" class="form-control form-control-user @error('no') is-invalid @enderror" placeholder="No Anggota" value="{{ old('no') }}">
      @error('no')<div class="invalid-feedback"> {{ $message }} </div>@enderror
    </div>
    <div class="form-group">
      <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" placeholder="Nama" value="{{ old('nama') }}">
      @error('nama')<div class="invalid-feedback"> {{ $message }} </div>@enderror
    </div>
    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <label> Jenis Kelamin </label>
        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
          <option value="">-- Pilih Jenis Kelamin --</option>
          @foreach ($ar_gender as $label => $jk)
            @php $sel = ( old('gender') == $jk) ? 'selected' : ''; @endphp
          <option value="{{ $jk }}" {{ $sel }}>{{ $label }}</option>
          @endforeach
        </select>
        @error('gender')<div class="invalid-feedback"> {{ $message }} </div>@enderror
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-user @error('tmplahir') is-invalid @enderror" 
        name="tmplahir" placeholder="Tempat Lahir" value="{{ old('tmplahir') }}">
        @error('tmplahir')<div class="invalid-feedback"> {{ $message }} </div>@enderror
      </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
          <input type="date" class="form-control form-control-user @error('tgllahir') is-invalid @enderror" 
          name="tgllahir" placeholder="Tanggal Lahir" value="{{ old('tgllahir') }}">
          @error('tgllahir')<div class="invalid-feedback"> {{ $message }} </div>@enderror
        </div>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-user @error('alamat') is-invalid @enderror" name="alamat" 
          placeholder="Alamat" value="{{ old('alamat') }}">
          @error('alamat')<div class="invalid-feedback"> {{ $message }} </div>@enderror
        </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" 
        placeholder="Email" value="{{ old('email') }}">
        @error('email')<div class="invalid-feedback"> {{ $message }} </div>@enderror
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-user @error('hp') is-invalid @enderror" name="hp" placeholder="NO HP" value="{{ old('hp') }}">
        @error('hp')<div class="invalid-feedback"> {{ $message }} </div>@enderror
      </div>
    </div>
    <div class="form-group">
        <label> Foto </label>
        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}">
        @error('foto')<div class="invalid-feedback"> {{ $message }} </div>@enderror
    </div>
    <button type="submit" name="proses" value="simpan" class="btn btn-primary">
      Add
    </button>
  </form>
@endsection
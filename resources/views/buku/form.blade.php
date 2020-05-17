@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota')   
  @php
    $rs1 = App\Penerbit::all();
    $rs2 = App\Pengarang::all();
    $rs3 = App\Kategori::all();
  @endphp
  <h3> Form Input Buku </h3>
  <form class="user" method="POST" action="{{route('buku.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <input type="text" name="isbn" class="form-control form-control-user @error('isbn') is-invalid @enderror" 
      placeholder="ISBN" value="{{ old('isbn') }}">
      @error('isbn')<div class="invalid-feedback"> {{ $message }} </div>@enderror
    </div>
    <div class="form-group">
      <input type="text" name="judul" class="form-control form-control-user @error('judul') is-invalid @enderror" 
      placeholder="Judul Buku" value="{{ old('judul') }}">
      @error('judul')<div class="invalid-feedback"> {{ $message }} </div>@enderror
    </div>
    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="text" class="form-control form-control-user @error('tahun_cetak') is-invalid @enderror" 
        name="tahun_cetak" placeholder="Tahun Cetak" value="{{ old('tahun_cetak') }}">
        @error('tahun_cetak')<div class="invalid-feedback"> {{ $message }} </div>@enderror
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-user @error('stok') is-invalid @enderror" 
        name="stok" placeholder="Stok" value="{{ old('stok') }}">
        @error('stok')<div class="invalid-feedback"> {{ $message }} </div>@enderror
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <label> Penerbit </label>
        <select name="penerbit" class="form-control @error('penerbit') is-invalid @enderror">
          <option value="">-- Pilih Penerbit --</option>
          @foreach ($rs1 as $penerbit)
            @php $sel = ( old('penerbit') == $penerbit['id']) ? 'selected' : ''; @endphp
          <option value="{{ $penerbit['id'] }}" {{ $sel }}>{{ $penerbit['nama'] }}</option>
          @endforeach
        </select>
        @error('penerbit')<div class="invalid-feedback"> {{ $message }} </div>@enderror
      </div>
      <div class="col-sm-6">
        <label> Pengarang </label>
        <select name="pengarang" class="form-control @error('pengarang') is-invalid @enderror">
          <option value="">-- Pilih Pengarang --</option>
          @foreach ($rs2 as $pengarang)
            @php $sel = ( old('pengarang') == $pengarang['id']) ? 'selected' : ''; @endphp
            <option value="{{ $pengarang['id'] }}" {{ $sel }}>{{ $pengarang['nama'] }}</option>
          @endforeach
        </select>
        @error('pengarang')<div class="invalid-feedback"> {{ $message }} </div>@enderror
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <label> Kategori </label>
        <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
          <option value="">-- Pilih Kategori --</option>
          @foreach ($rs3 as $kategori)
            @php $sel = ( old('kategori') == $kategori['id']) ? 'selected' : ''; @endphp
            <option value="{{ $kategori['id'] }}" {{ $sel }}>{{ $kategori['nama'] }}</option>
          @endforeach
        </select>
        @error('kategori')<div class="invalid-feedback"> {{ $message }} </div>@enderror
      </div>
      <div class="col-sm-6">
        <label> Upload Cover </label> 
        <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" value="{{ old('cover') }}">
        @error('cover')<div class="invalid-feedback"> {{ $message }} </div>@enderror
      </div>
    </div>
    <button type="submit" name="proses" value="simpan" class="btn btn-primary">
      Add
    </button>
  </form>
  @else
  @include('auth.terlarang')
@endif
@endsection
@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota')   
@php
$rs1 = App\Penerbit::all();
$rs2 = App\Pengarang::all();
$rs3 = App\Kategori::all();         
@endphp
@foreach ($data as $rs)
<h3>Form Edit Buku</h3>
<form class="user" method="POST" action="{{route('buku.update',$rs->id)}}"  enctype="multipart/form-data">
    @csrf
    @method('PUT')  
    <div class="form-group">
        @php $val = ($errors->isEmpty()) ? $rs->isbn : old('isbn'); @endphp
        <input type="text" name="isbn" class="form-control form-control-user @error('isbn') is-invalid @enderror"
         placeholder="ISBN" value="{{ $val }}">
        @error('isbn')<div class="invalid-feedback">{{ $message }}</div>@enderror 
    </div>
    <div class="form-group">
        @php $val = ($errors->isEmpty()) ? $rs->judul : old('judul'); @endphp
        <input type="text" name="judul" class="form-control form-control-user @error('judul') is-invalid @enderror"
         placeholder="Judul Buku" value="{{ $val }}">
        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror  
    </div>
    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        @php $val = ($errors->isEmpty()) ? $rs->tahun_cetak : old('tahun_cetak'); @endphp
        <input type="text" class="form-control form-control-user @error('tahun_cetak') is-invalid @enderror"
         name="tahun_cetak" value="{{ $val }}">
        @error('tahun_cetak')<div class="invalid-feedback">{{ $message }}</div>@enderror 
      </div>
      <div class="col-sm-6">
        @php $val = ($errors->isEmpty()) ? $rs->stok : old('stok'); @endphp
        <input type="text" class="form-control form-control-user @error('stok') is-invalid @enderror"
         name="stok" placeholder="Stok" value="{{ $val }}">
        @error('stok')<div class="invalid-feedback">{{ $message }}</div>@enderror 
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <label>Penerbit</label>
        <select name="penerbit" class="form-control @error('penerbit') is-invalid @enderror">
            <option value="">-- Pilih Penerbit --</option>
            @foreach($rs1 as $penerbit)
            @php  $sel = ( $penerbit['id'] == $rs->idpenerbit) ? 'selected' : ''; @endphp 
            @if($errors->isEmpty())
                <option value="{{ $penerbit['id'] }}" {{ $sel }}>{{ $penerbit['nama'] }}</option>
            @else
            <option value="{{ $penerbit['id'] }}">{{ $penerbit['nama'] }}</option>
            @endif
            @endforeach
        </select>
        @error('penerbit')<div class="invalid-feedback">{{ $message }}</div>@enderror     
      </div>
      <div class="col-sm-6">
        <label>Pengarang</label>
        <select name="pengarang" class="form-control @error('pengarang') is-invalid @enderror">
            <option value="">-- Pilih Pengarang --</option>
            @foreach($rs2 as $pengarang)
            @php  $sel = ( $pengarang['id'] == $rs->idpengarang) ? 'selected' : ''; @endphp
            @if($errors->isEmpty())
                <option value="{{ $pengarang['id']}}" {{ $sel }}>{{ $pengarang['nama']}}</option>
            @else
            <option value="{{ $pengarang['id']}}">{{ $pengarang['nama'] }}</option>
            @endif
            @endforeach
        </select>  
        @error('pengarang')<div class="invalid-feedback">{{ $message }}</div>@enderror  
      </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
          <label>Kategori</label>
          <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
              <option value="">-- Pilih Kategori --</option>
              @foreach($rs3 as $kategori)
              @php  $sel = ( $kategori['id'] == $rs->kategori_id) ? 'selected' : ''; @endphp
              @if($errors->isEmpty())
                  <option value="{{ $kategori['id']}}" {{ $sel }}>{{ $kategori['nama']}}</option>
              @else
              <option value="{{ $kategori['id']}}">{{ $kategori['nama']}}</option>
              @endif
              @endforeach
          </select>    
          @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror  
        </div>
        <div class="col-sm-6">
          <label> Cover Buku</label>
          <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover"/> 
          @error('cover')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>
    <button type="submit" name="proses" value="ubah" class="btn btn-warning">
      Ubah
    </button> 
  </form>
@endforeach    
@else
@include('auth.terlarang')
@endif
@endsection
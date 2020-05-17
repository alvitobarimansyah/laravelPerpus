@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota')
<h3> Form Input Pengarang </h3>
@foreach ($data as $rs)  
<form class="user" method="POST" action="{{route('pengarang.update',$rs->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      @php $val = ($errors->isEmpty()) ? $rs->nama : old('nama'); @endphp
    <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" 
    placeholder="Nama Pengarang" value="{{$val}}">
    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror 
    </div>
    <div class="form-group">
      @php $val = ($errors->isEmpty()) ? $rs->email : old('email'); @endphp
        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" 
        placeholder="Email" value="{{$val}}">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror 
    </div>
    <div class="form-group">
      @php $val = ($errors->isEmpty()) ? $rs->hp : old('hp'); @endphp
        <input type="text" class="form-control form-control-user @error('hp') is-invalid @enderror" 
        name="hp" placeholder="No.Hp" value="{{$val}}">
        @error('hp')<div class="invalid-feedback">{{ $message }}</div>@enderror 
    </div>
    <div class="form-group">
        <label> Foto </label>
        @php $val = ($errors->isEmpty()) ? $rs->foto : old('foto'); @endphp
        <input type="file" name="foto" class="form_control @error('foto') is-invalid @enderror" value="{{$val}}">
        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror 
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
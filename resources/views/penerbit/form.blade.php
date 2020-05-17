@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota')
<h3> Form Input Penerbit </h3>
<form class="user" method="POST" action="{{route('penerbit.store')}}">
    @csrf
    <div class="form-group">
        <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" 
        placeholder="Nama Penerbit" value="{{ old('nama') }}">
        @error('nama')<div class="invalid-feedback"> {{ $message }} </div>@enderror
    </div>
    <div class="form-group">
        <input type="text" name="alamat" class="form-control form-control-user @error('alamat') is-invalid @enderror" 
        placeholder="Alamat" value="{{ old('alamat') }}">
        @error('alamat')<div class="invalid-feedback"> {{ $message }} </div>@enderror
    </div>
    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" 
        name="email" placeholder="Email" value="{{ old('email') }}">
        @error('email')<div class="invalid-feedback"> {{ $message }} </div>@enderror
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-user @error('website') is-invalid @enderror" 
        name="website" placeholder="Website" value="{{ old('website') }}">
        @error('website')<div class="invalid-feedback"> {{ $message }} </div>@enderror
      </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
          <input type="text" class="form-control form-control-user @error('telp') is-invalid @enderror" 
          name="telp" placeholder="No.Telp" value="{{ old('telp') }}">
          @error('telp')<div class="invalid-feedback"> {{ $message }} </div>@enderror
        </div>
        <div class="col-sm-6">
          <input type="text" class="form-control form-control-user @error('cp') is-invalid @enderror" 
          name="cp" placeholder="Contact Person" value="{{ old('cp') }}">
          @error('cp')<div class="invalid-feedback"> {{ $message }} </div>@enderror
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
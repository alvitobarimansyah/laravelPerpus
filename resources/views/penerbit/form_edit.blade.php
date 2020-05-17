@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota')
<h3> Form Input Penerbit </h3>
@foreach ($data as $rs)
<form class="user" method="POST" action="{{route('penerbit.update',$rs->id)}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        @php $val = ($errors->isEmpty()) ? $rs->nama : old('nama'); @endphp
        <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" 
        placeholder="Nama Penerbit" value="{{ $val }}">
        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror 
    </div>
    <div class="form-group">
        @php $val = ($errors->isEmpty()) ? $rs->alamat : old('alamat'); @endphp
        <input type="text" name="alamat" class="form-control form-control-user @error('alamat') is-invalid @enderror" 
        placeholder="Alamat" value="{{ $val }}">
        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        @php $val = ($errors->isEmpty()) ? $rs->email : old('email'); @endphp
        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" 
        placeholder="Email" value="{{ $val }}">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="col-sm-6">
        @php $val = ($errors->isEmpty()) ? $rs->website : old('website'); @endphp
        <input type="text" class="form-control form-control-user @error('website') is-invalid @enderror" name="website" 
        placeholder="Website" value="{{ $val }}">
        @error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
          @php $val = ($errors->isEmpty()) ? $rs->telp : old('telp'); @endphp
          <input type="text" class="form-control form-control-user @error('telp') is-invalid @enderror" name="telp" 
          placeholder="No.Telp" value="{{ $val }}">
          @error('telp')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-sm-6">
          @php $val = ($errors->isEmpty()) ? $rs->cp : old('cp'); @endphp
          <input type="text" class="form-control form-control-user @error('cp') is-invalid @enderror" 
          name="cp" placeholder="Contact Person" value="{{ $val }}">
          @error('cp')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
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
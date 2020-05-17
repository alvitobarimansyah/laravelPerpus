@extends('layouts.index')
@section('content')
  @php
    $ar_gender = ['Laki-Laki'=>'L','Perempuan'=>'P'];
  @endphp
    @foreach ($data as $rs)
        <h3> Form Input Anggota </h3>
        <form class="user" method="POST" action="{{route('anggota.update',$rs->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
            @php $val = ($errors->isEmpty()) ? $rs->no_anggota : old('no'); @endphp
            <input type="text" name="no" class="form-control form-control-user @error('no') is-invalid @enderror" 
            placeholder="No Anggota" value="{{$val}}">
            @error('no')<div class="invalid-feedback">{{ $message }}</div>@enderror 
              </div>
              <div class="form-group">
                @php $val = ($errors->isEmpty()) ? $rs->nama : old('nama'); @endphp
                <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" 
                placeholder="Nama" value="{{$val}}">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror 
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label> Jenis Kelamin </label>
                  <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    @foreach ($ar_gender as $label => $jk)
                      @php $sel = ( $jk == $rs->gender) ? 'selected' : ''; @endphp
                    @if($errors->isEmpty())
                    <option value="{{ $jk }}" {{ $sel }}>{{ $label }}</option>
                    @else
                    <option value="{{ $jk }}">{{ $label }}</option>
                    @endif
                    @endforeach
                  </select>
                  @error('gender')<div class="invalid-feedback"> {{ $message }} </div>@enderror
                </div>
                <div class="col-sm-6">
                  @php $val = ($errors->isEmpty()) ? $rs->tempat_lahir : old('tmplahir'); @endphp
                  <input type="text" class="form-control form-control-user @error('tmplahir') is-invalid @enderror" name="tmplahir" 
                  placeholder="Tempat Lahir" value="{{$val}}">
                  @error('tmplahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    @php $val = ($errors->isEmpty()) ? $rs->tanggal_lahir : old('tgllahir'); @endphp
                    <input type="date" class="form-control form-control-user @error('tgllahir') is-invalid @enderror" name="tgllahir" 
                    placeholder="Tanggal Lahir" value="{{$val}}">
                    @error('tgllahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-sm-6">
                    @php $val = ($errors->isEmpty()) ? $rs->tanggal_lahir : old('tgllahir'); @endphp
                    <input type="text" class="form-control form-control-user @error('tgllahir') is-invalid @enderror" 
                    name="alamat" placeholder="Alamat" value="{{$rs->alamat}}">
                    @error('tgllahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  @php $val = ($errors->isEmpty()) ? $rs->email : old('email'); @endphp
                  <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" 
                  name="email" placeholder="Email" value="{{$val}}">
                  @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-sm-6">
                  @php $val = ($errors->isEmpty()) ? $rs->hp : old('hp'); @endphp
                  <input type="text" class="form-control form-control-user @error('hp') is-invalid @enderror" 
                  name="hp" placeholder="NO HP" value="{{$rs->hp}}">
                  @error('hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="form-group">
                  <label> Foto </label>
                  @php $val = ($errors->isEmpty()) ? $rs->foto : old('foto'); @endphp
                  <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" value="{{$rs->foto}}">
                  @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            <button type="submit" name="proses" value="ubah" class="btn btn-warning">
                Update
            </button>
        </form>
    @endforeach
@endsection
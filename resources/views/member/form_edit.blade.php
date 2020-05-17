@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota') 
@php
  $ar_role = ['admin','staff','anggota'];
  $ar_active = ['yes','no','banned'];
@endphp
@foreach ($data as $rs)
  <h3> Form Input User </h3>
  <form class="user" method="POST" action="{{route('member.update',$rs->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
    <input type="text" name="nama" class="form-control form-control-user" placeholder="Nama User" value="{{ $rs->name}}">
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user" placeholder="Email" value="{{ $rs->email}}">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control form-control-user" placeholder="Password" value="{{ $rs->password}}">
    </div>
    <div class="form-group row">
        <label> Role </label>
        <select name="role" class="form-control">
          <option value="">-- Pilih Role --</option>
          @foreach ($ar_role as $role)
          @php $sel = ( $role == $rs->role) ? 'selected' : ''; @endphp
          <option value="{{ $role }}" {{ $sel }}>{{ $role }}</option>
          @endforeach
        </select>
    </div>
    <div class="form-group row">
          <label> Active </label>
          <select name="isactive" class="form-control">
            <option value="">-- Pilih Active --</option>
            @foreach ($ar_active as $active)
            @php $sel = ( $active == $rs->isactive) ? 'selected' : ''; @endphp
            <option value="{{ $active }}" {{ $sel }}>{{ $active }}</option>
            @endforeach
          </select>
    </div>
    <div class="form-group">
        <label> Foto </label>
        <input type="file" name="foto" class="form-control" value="{{ $rs->foto}}">
    </div>
    <button type="submit" name="proses" value="simpan" class="btn btn-warning">
      Update
    </button>
  </form>
@endforeach
@else
    @include('auth.terlarang')
  @endif
@endsection
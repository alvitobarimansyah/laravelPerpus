@extends('layouts.index')
@section('content')
    @foreach ($ar_penerbit as $penerbit)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> {{ $penerbit->nama }} </h6>
        </div>
        <div class="card-body">
        Alamat : {{ $penerbit->alamat}} <br>
        Email : {{ $penerbit->email}} <br>
        Website : {{ $penerbit->website}} <br>
        No.Telp : {{ $penerbit->telp}} <br>
        Contact Person : {{ $penerbit->cp}} <br>
        </div>
    </div>  
    <a href="{{url('penerbit')}}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i>
        Go Back
    </a>  
    @endforeach
@endsection
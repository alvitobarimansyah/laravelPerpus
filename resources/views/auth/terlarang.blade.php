@extends('layouts.index2')
@section('content')
<div class="jumbotron">
    <h2>
        Access Denied!!!
    </h2>
    <p>
        Maaf Anda Terlarang Untuk Mengakses Halaman ini
    </p>
    <p>
        <a class="btn btn-primary btn-large" href="{{ url('koleksibuku')}}"> Home </a>
    </p>
</div>
@endsection

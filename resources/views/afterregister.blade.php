@php
    session_start();
@endphp
@extends('layouts.index2')
@section('content')
<div class="container">
    <div class="jumbotron">
        <h2>
            Terima Kasih sudah Register
        </h2>
        <p>
            Mohon tunggu approval Administrator kami
        </p>
    </div>
</div>
@endsection
@php
    session_destroy();
@endphp
@extends('layouts.index')
@section('content')
    @foreach ($ar_member as $member)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $member->name}}</h6>
        </div>
        <div class="card-body">
        @if(!empty($member->foto))
        <td><img src="{{asset('img/member')}}/{{ $member->foto }}" height="20%" /></td>
        @else
        <td><img src="{{asset('img')}}/nophoto.png" height="20%" /></td>
        @endif <br>
        Nama User : {{ $member->name}} <br>
        Email : {{ $member->email}} <br>
        Role : {{ $member->role}} <br>
        Active : {{ $member->isactive}} <br>
        </div>
    </div>  
    <a href="{{url('member')}}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i>
        Go Back
    </a>  
    @endforeach
@endsection
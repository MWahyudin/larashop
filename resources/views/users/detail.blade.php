@extends('layouts.global')
@section('title',$user->name)

@section('content')
<div class="row justify-content-center">
<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <b>Name:</b> <br />
            {{ $user->name }}
            <br><br>
            @if($user->avatar)
                <img src="{{ asset('storage/'. $user->avatar) }}" width="128px" />
            @else
                No avatar
            @endif
            <br>
            <br>
            <b>Username:</b><br>
            {{ $user->name }}
            <br>
            <br>
            <b>Phone number</b> <br>
            {{ $user->phone }}
            <br><br>
            <b>Address</b> <br>
            {{ $user->address }}

            <br>
            <br>
            <b>Roles:</b> <br>
            @foreach(json_decode($user->roles) as $role)
                &middot; {{ $role }} <br>
            @endforeach
        </div>
    </div>
</div>
</div>


@endsection
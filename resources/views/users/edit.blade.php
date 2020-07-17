@extends('layouts.global')
@section('title','Edit '.$user->name)

@section('content')
<div class="row justify-content-center">
<div class="col-md-8">
    @if(session('status'))
        <div class='alert alert-success'>
            {{ session('status') }}
        </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3"
        action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input class="form-control" placeholder="Full Name" type="text" name="name" id="name"
            value="{{ $user->name }}" />
        <br>
        <label for="username">Username</label>
        <input class="form-control" placeholder="username" type="text" name="username" id="username"
            value="{{ $user->username }}" disabled />
        <br>
        <label for="email">email</label>
        <input class="form-control" placeholder="email" type="text" name="email" id="email" value="{{ $user->email }}"
            disabled />
        <br>
        <label for="phone">Phone number</label>
        <br>
        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
        <br>
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control">{{ $user->address }}
 </textarea>
 <br>
        <br>
        <label for="">Status</label>
        <br />
        <input
            {{ $user->status == "ACTIVE" ? "checked" : "" }}
            value="ACTIVE" type="radio" class="form-control" id="active" name="status">
        <label for="active">Active</label>
        <input
            {{ $user->status == "INACTIVE" ? "checked" : "" }}
            value="INACTIVE" type="radio" class="form-control" id="inactive" name="status">
        <label for="inactive">Inactive</label>
        <br>
        <label for="">Avatar</label>
        <br>
        @if($user->avatar)
            <img src="{{ asset('storage/'.$user->avatar) }}" width="80px" />
            <br>
        @else
            No avatar
        @endif
        <br>
        <input
        id="avatar"
        name="avatar"
        type="file"
        class="form-control">
        <small
        class="text-muted">fill it blank if do not want change avatar</small>
       
        <hr
        class="my-3">
        <label for="">Level</label>
        <br>
        <input type="radio"
            {{ in_array("ADMIN", json_decode($user->roles)) ? "checked" : "" }}
            name="roles[]" id="ADMIN" value="ADMIN">
        <label for="ADMIN">Administrator</label>
        <input type="radio"
            {{ in_array("STAFF", json_decode($user->roles)) ? "checked" : "" }}
            name="roles[]" id="STAFF" value="STAFF">
        <label for="STAFF">Staff</label>
        <input type="radio"
            {{ in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : "" }}
            name="roles[]" id="CUSTOMER" value="CUSTOMER">
        <label for="CUSTOMER">Customer</label> <br>
        <input class="btn btn-primary" type="submit" value="Save" />
    </form>
</div>
</div>

@endsection

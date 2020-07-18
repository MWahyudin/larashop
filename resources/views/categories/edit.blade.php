@extends('layouts.global')
@section('title','Edit category')
@section('pageTitle','Edit category')

@section('content')
@if(session('status'))
    <div class='alert alert-success'>
        {{ session('status') }}
    </div>
@endif
<form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Name</label>
    <input type='text' class='form-control' name='name' value="{{ $category->name }}">
    <br>
    @if($category->image)
        <span>Current image</span><br>
        <img src="{{ asset('storage/'. $category->image) }}" width="120px">
        <br><br>
    @endif
    <input type="file" class="form-control" name="image">
    <small class="text-muted">fill it blank if not want change</small>
    <br><br>
    <input type="submit" class="btn btn-primary" value="Update">
</form>

@endsection

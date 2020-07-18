@extends('layouts.global')
@section('title','New category')

@section('content')
<form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data"
    class="bg-white shadows-sm p-3">
    @csrf
    <label>Category name</label>
    <input type="text" class="form-control sm" name="name">
    <br>
    <label>Image</label>
    <input type='file' class='form-control' name='image'>
<input type="submit" value="save" class="btn btn-primary btn-sm mt-4">
</form>

@endsection

@extends('layouts.global')
@section('title','Detail category')
@section('pageTitle',$category->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <b>Name:</b> <br />
                {{ $category->name }}
                <br><br>
                @if($category->image)
                    <img src="{{ asset('storage/'. $category->image) }}" width="128px" />
                @else
                    No avatar
                @endif
                <br>
               
            </div>
        </div>
    </div>
    
@endsection
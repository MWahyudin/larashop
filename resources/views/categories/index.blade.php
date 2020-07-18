@extends('layouts.global')
@section('title','List Categories')
@section('pageTitle','List categories')

@section('content')
@if(session('status'))
  <div class='alert alert-success'>
      {{session('status')}}
  </div>
@endif
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th>No</th>
                    <th><b>Name</b></th>
                    <th><b>Slug</b></th>
                    <th><b>Image</b></th>
                    <th><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
               
                @foreach($categories as $item => $category)
                    <tr>
                        <td>{{ $item + $categories->firstItem() }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}"
                                    width="48px" />
                            @else
                                No image
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="btn btn-info btn-sm">
                                    Edit</a> |
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('categories.show', $category->id) }}">
                                    Detail
                                </a> |
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this item?')"> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colSpan="10">
                        {{ $categories->appends(Request::all())->links() }}
                    </td>
                </tr>
            </tfoot>
            <a href="{{ route('categories.create') }}"" class="btn btn-primary mt-4 mb-4">
                Add new category
            </a>
        </table>
      
    </div>
</div>

@endsection

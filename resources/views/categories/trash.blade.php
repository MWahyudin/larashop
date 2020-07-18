@extends('layouts.global')
@section('title','Trash Categories')
@section('pageTitle','Trash categories')

@section('content')
@if(session('status'))
    <div class='alert alert-success'>
        {{ session('status') }}
    </div>
@endif
@if(session('error'))
  <div class='alert alert-danger'>
      {{session('error')}}
  </div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 mb-4">
                <form action="{{ route('categories.trash') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Filter by category name"
                            value="{{ Request::get('name') }}" name="name">

                        <div class="input-group-append">
                            <input type="submit" value="Filter" class="btn btn-primary">
                        </div>
                    </div>

                </form>
            </div>
        </div>

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
                            {{-- <form action="{{ route('categories.delete', $category->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('categories.restore', $category->id) }}">
                                Restore
                            </a> |
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this item?')">
                                Delete permanent</button>
                            </form> --}}
                            <form action="{{ route('categories.delete', $category->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                            
                                <a class="btn btn-success btn-sm"
                                    href="{{ route('categories.restore', $category->id) }}">
                                    Restore
                                </a> |
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                    Delete</button>
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
           
        </table>

    </div>
</div>

@endsection

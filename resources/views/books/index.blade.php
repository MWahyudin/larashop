@extends('layouts.global')
@section('title','List Books')
@section('pageTitle','List books')

@section('content')
<div class="row justify-content-center">
    <div class="">
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th><b>Title</b></th>
                    <th><b>Author</b></th>
                    <th><b>Cover</b></th>
                    <th><b>Price</b></th>
                    <th><b>Status</b></th>
                    <th><b>Action</b></th>
                </tr>
            </thead>
            <tbody>

                @foreach($books as $item => $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                    
                        <td>
                            @if($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}"
                                    width="48px" />
                            @else
                                No image
                            @endif
                        </td>
                        <td>${{ $book->price }}</td>
                        <td>
                            @if ($book->status == "PUBLISH")
                            <span class="badge badge-primary">Publish</span>
                                @else
                            <span class="badge badge-warning">Draft</span>

                        @endif
                        <td>
                            <form action="{{ route('books.destroy', $book->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('books.edit', $book->id) }}"
                                    class="btn btn-info btn-sm">
                                    Edit</a> |
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('books.show', $book->id) }}">
                                    Detail
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
                        {{ $books->appends(Request::all())->links() }}
                    </td>
                </tr>
            </tfoot>
            <a href="{{ route('books.create') }}"" class=" btn btn-primary mt-4 mb-4">
                Add new book
            </a>
        </table>
    </div>
</div>
@endsection

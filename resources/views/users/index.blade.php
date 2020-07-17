@extends('layouts/global')
@section('title','List User')

@section('content')
@if(session('status'))
    <div class='alert alert-success'>
        {{ session('status') }}
    </div>
@endif
<form action="{{ route('user.search') }}">
    <div class="row">
        <div class="col-md-6 mb-4">
            <input name="keyword" class="form-control"
                type="text" placeholder="Enter keyword..." />
        </div>
        <div class="col-md-6">
          <input 
           value="ACTIVE" name="active" type="radio" class="form-control" id="active">
            <label for="active">Active</label>
            <input 
               
                value="INACTIVE" name="inactive" type="radio" class="form-control" id="inactive">
            <label for="inactive">Inactive</label>
            <input type="submit" value="Search" class="btn btn-primary">
        </div>
    </div>
</form>
<table class="table table-hover table-responsive-md">
    <thead class="thead-dark">
        <tr>
            <th><b>No</b></th>
            <th><b>Name</b></th>
            <th><b>Username</b></th>
            <th><b>Email</b></th>
            <th><b>Phone</b></th>
            <th><b>Avatar</b></th>
            <th>Status</th>
            <th><b>Action</b></th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $no }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td><img src="{{ asset('storage/'.$user->avatar) }}" alt="" srcset=""
                        height="60px" width="70px"></td>
                <td>
                    @if($user->status == "ACTIVE")
                        <span class="badge badge-success">
                            {{ $user->status }}
                        </span>
                    @else
                        <span class="badge badge-danger">
                            {{ $user->status }}
                        </span>
                    @endif
                </td>

                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="btn btn-info btn-sm">
                            Edit</a> |
                        <a class="btn btn-primary btn-sm"
                            href="{{ route('users.show', $user->id) }}">
                            Detail
                        </a> |
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this item?')"> Delete</button>
                    </form>
                </td>
                <?php $no++ ?>
            </tr>
        @endforeach
    </tbody>
</table>


<a href="{{ route('users.create') }}" class="btn btn-info btn-sm"><span class="oi oi-plus"></span>
    User</a>
@endsection

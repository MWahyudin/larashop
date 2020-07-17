@extends('layouts/global')
@section('title','List User')

@section('content')
@if(session('status'))
  <div class='alert alert-success'>
      {{session('status')}}
  </div>
@endif
<table class="table table-hover table-responsive-md">
    <thead class="thead-dark">
        <tr>
          <th><b>No</b></th>
          <th><b>Name</b></th>
          <th><b>Username</b></th>
          <th><b>Email</b></th>
          <th><b>Avatar</b></th>
          <th><b>Action</b></th>
         
        </tr>
    </thead>
    <tbody>
      <?php $no = 1; ?>
      @foreach ($users as $user)
        <tr>
          <th scope="row">{{ $no }}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td><img src="{{ asset('storage/'.$user->avatar) }}" alt="" srcset="" height="60px" width="70px"></td>
          <td><form action="{{ route('user.destroy', $user->id) }}" method="POST">
            @csrf 
            @method('DELETE')
            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary"> Edit</a> | 
            <a class="btn btn-primary btn-sm" href="{{ route('user.show', $user->id) }}">
              Detail
            </a>
            <button  class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')"> Delete</button>
       </form> </td>
          <?php $no++ ?>
        </tr>
        @endforeach
    </tbody>
</table>


<a href="{{ route('user.create') }}" class="btn btn-info btn-sm"><span class="oi oi-plus"></span> User</a>
@endsection



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
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Picture</th>
        </tr>
    </thead>
    <tbody>
      <?php $no = 1; ?>
      @foreach ($users as $user)
        <tr>
          <th scope="row">{{ $no }}</th>
          <td>{{ $user->email }}</td>
          <td>{{ $user->email }}</td>
          <td><img src="{{ asset('storage/'.$user->avatar) }}" alt="" srcset="" height="60px" width="70px"></td>
          <?php $no++ ?>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('user.create') }}" class="btn btn-info btn-sm"><span class="oi oi-plus"></span> User</a>
@endsection

@extends('layouts.superadmin')
@section('title', 'User Lists')
@section('content')
<!-- User Lists Start -->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User Lists</h1>
    <ol class="breadcrumb">
      {{-- <li class="breadcrumb-item"><a href="./">Home</a></li> --}}
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active" aria-current="page">User Lists</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Simple Tables -->
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Users Data Table</h6>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $key => $user)
              <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->role }}</td>
                  <td>
                      @if (auth()->user()->role == 'superadmin' && $user->role == 'superadmin')
                          <!-- Hide superadmin's name if logged in as superadmin -->
                      @else
                          @if (now()->diffInDays($user->created_at) <= 1)
                              <span class="badge badge-success">New User</span>
                          @else
                              <span class="badge badge-warning">Not New User</span>
                          @endif
                      @endif
                  </td>
              </tr>
          @endforeach
          
            </tbody>
          </table>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
  </div>
</div>
<!-- User Lists End -->
@endsection

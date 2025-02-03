@extends('layouts.superadmin')
@section('title', 'Airline Lists')
@section('content')
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Airline Lists</h1>
    <ol class="breadcrumb">
      {{-- <li class="breadcrumb-item"><a href="{{ url('superadmin/dashboard') }}">Home</a></li> --}}
      <li class="breadcrumb-item">Airlines</li>
      <li class="breadcrumb-item active" aria-current="page">Airline Lists</li>
    </ol>
  </div>
  <!-- Row -->
  <div class="row">
    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Logo</th>
                <th>Airline</th>
                <th>Prefix Flight Number</th>
                <th>Added By</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($airlines as $key => $airline)
              <tr>
                  <td>{{ $key + 1 }}</td>
                  <td><img src="{{ asset('assets/upload/airline/' .$airline->logo) }}" alt="airlinelogo" height="60"></td>
                  <td>{{ $airline->airline }}</td>
                  <td>{{ $airline->flight_number }}</td>
                  <td>
                      @if ($airline->user_id == Auth::user()->id)
                          Me
                      @else
                          {{ \App\Models\User::find($airline->user_id)->first_name }}
                          {{ \App\Models\User::find($airline->user_id)->last_name }}
                      @endif
                  </td>
                  <td>
                      @if ($airline->user_id == Auth::user()->id)
                          <a href="{{ url('superadmin/edit-airline/'.$airline->id) }}" class="btn btn-success btn-sm">Update</a>
                      @else
                          <!-- Display some information or a disabled button if not allowed to update -->
                          <span class="text-muted"><small>Only Admin Can Update</small></span>
                      @endif
                  </td>
              </tr>
              @endforeach
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--Row-->
</div>
@endsection

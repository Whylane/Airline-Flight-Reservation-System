@extends('layouts.superadmin')
@section('title', 'Airline Lists')
@section('content')
<!-- Add Flight Start -->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Airport Lists</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item">Airport</li>
      <li class="breadcrumb-item active" aria-current="page">Airport Lists</li>
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
                        <th>Code</th>
                        <th>Airport</th>
                        <th>Location</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($airports as $airport)
                      <tr>
                          <td>{{ $airport ->id }}</td>
                          <td>{{ strtoupper($airport->code) }}</td>
                          <td>{{ $airport->airport }}</td>
                          <td>{{ $airport->location }}</td>
                          <td>
                              <a href="{{ url('superadmin/edit-airport/'.$airport->id) }}" class="btn btn-success btn-sm">Update</a>
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
<!-- Add Flight End -->
@endsection

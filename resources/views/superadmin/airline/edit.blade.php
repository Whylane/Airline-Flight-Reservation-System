@extends('layouts.superadmin')
@section('title', 'Update Airline')
@section('content')
<!-- Update Airline Start -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Update Airline</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Airline</li>
        <li class="breadcrumb-item active" aria-current="page">Update Airline</li>
      </ol>
    </div>

    <form action="{{ url('superadmin/update-airline/'.$airlines->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="row">
      <div class="col-lg">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-body">
                @if ($airlines->logo)
                    <img src="{{ asset('assets/upload/airline/' .$airlines->logo) }}" class="mx-auto d-block" alt="airlinelogo" height="280">
                @endif
                <div class="form-group">
                    <label for="formFile" class="form-label">Logo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="formFile" name="logo">
                        <label class="custom-file-label logo" for="formFile" id="file-label">Choose a file</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputAirline">Airline</label>
                            <input type="text" class="form-control logo" id="inputAirline" name="airline" value="{{ $airlines->airline }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{-- @php
                            // Extract the prefix from the flight number
                            $prefix = substr($airlines->flight_number, 0, 2);
                            @endphp --}}
                            <label for="flightNumber">Flight Number</label>
                            <input type="text" class="form-control" id="flight_number" name="flight_number" maxlength="2" value="{{ $airlines->flight_number }}">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
      </div>
    </div>
    </form>
</div>
<!-- Update Airline End -->
@endsection

@extends('layouts.superadmin')
@section('title', 'Add Airline')
@section('content')
<!-- Add Airline Start -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Airlines</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Airlines</li>
            <li class="breadcrumb-item active" aria-current="page">Add Airlines</li>
        </ol>
    </div>

    <form action="{{ url('superadmin/store-airline') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="formFile" class="form-label">Logo</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="formFile" name="logo" required>
                                        <label class="custom-file-label" for="formFile" id="file-label">Choose a file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputAirline">Airline</label>
                                    <input type="text" class="form-control" id="inputAirline" name="airline" required>
                                    @error('airline')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="flightNumber">Flight Number Prefix</label>
                                    <input type="text" class="form-control" id="flightNumber" name="flight_number" maxlength="2" required>
                                    @error('flight_number')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
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
<!-- Add Airline End -->
@endsection

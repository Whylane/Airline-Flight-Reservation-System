@extends('layouts.superadmin')
@section('title', 'Add Admin')
@section('content')
<!-- Add Airline Start -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Admin</h1>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item"><a href="./">Home</a></li> --}}
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active" aria-current="page">Add Admin</li>
        </ol>
    </div>

    <form action="{{ url('superadmin/store-admin') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="airlineSelect">Airline Assign</label>
                            <select class="form-control" name="airline_id" required>
                                <option value="" disabled selected>Choose Airline</option>
                                @foreach ($airlines as $airline)
                                    <option value="{{ $airline->id }}">{{ $airline->airline }}</option>
                                @endforeach
                            </select>
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

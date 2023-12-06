@extends('layouts.superadmin')
@section('title', 'Add Airport')
@section('content')
<!-- Add Airport Start -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Add Airports</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Airports</li>
        <li class="breadcrumb-item active" aria-current="page">Add Airports</li>
      </ol>
    </div>

    <form action="{{ url('superadmin/store-airport') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="row">
      <div class="col-lg">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-body">
                  <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputLocation">Code</label>
                            <input type="text" class="form-control" id="inputCode" name="code" required>
                        </div>            
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="inputAirport">Airport</label>
                            <input type="text" class="form-control" id="inputAirport" name="airport" required>
                        </div>  
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="inputLocation">Location</label>
                            <input type="text" class="form-control" id="inputLocation" name="location" required>
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
<!-- Add Airport End -->
@endsection

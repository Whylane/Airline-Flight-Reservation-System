@extends('layouts.superadmin')
@section('title', 'Update Airport')
@section('content')
<!-- Update Airport Start -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Update Airports</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Airports</li>
        <li class="breadcrumb-item active" aria-current="page">Update Airports</li>
      </ol>
    </div>

    <form action="{{ url('superadmin/update-airport/'.$airports->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="row">
      <div class="col-lg">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-body">
                  <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputLocation">Code</label>
                            <input type="text" class="form-control" id="inputCode" name="code" value="{{ strtoupper($airports->code) }}">
                        </div>            
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="inputAirport">Airport</label>
                            <input type="text" class="form-control" id="inputAirport" name="airport" value="{{ $airports->airport }}">
                        </div>  
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="inputLocation">Location</label>
                            <input type="text" class="form-control" id="inputLocation" name="location" value="{{ $airports->location }}">
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
<!-- Update Airport End -->
@endsection

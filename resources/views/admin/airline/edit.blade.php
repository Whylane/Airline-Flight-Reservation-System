@extends('layouts.admin')
@section('title', 'Update Airline')
@section('content')
<!-- Update Airline Start -->
<div class="container pt-4 px-4">
    <div class="bg-secondary rounded p-4 text-white">
        <h5 class="mb-4">Update Airline</h5>
        <form action="{{ url('admin/update-airline/'.$airlines->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="total_seats" placeholder=" " value="{{ $airlines->total_seats }}">
                <label for="">Total Seats</label>
            </div>
            <div class="form-floating mb-3">
                @php
                    // Extract the prefix from the flight number
                    $adminFlightNumberPrefix = substr($airlines->flight_number, 0, 2);
                @endphp
                <input type="text" class="form-control bg-dark" id="flight_number" name="flight_number" maxlength="2" value="{{ $adminFlightNumberPrefix}}" readonly>
                <label for="">Flight Number</label>
            </div>
            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- Update Airline End -->
@endsection

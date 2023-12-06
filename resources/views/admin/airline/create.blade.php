@extends('layouts.admin')
@section('title', 'Add Airline')
@section('content')
<!-- Add Airline Start -->
<div class="container pt-4 px-4">
    <div class="bg-secondary rounded p-4 text-white">
        <h5 class="mb-4">Add Airline</h5>
        <form action="{{ url('admin/store-airline') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="total_seats" placeholder=" " required>
                <label for="">Total Seats</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control bg-dark" id="flight_number" name="flight_number" maxlength="2" value="{{ $completeFlightNumber }}" readonly>
            </div>
            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- Add Airline End -->
@endsection

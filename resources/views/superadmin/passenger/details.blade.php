@extends('layouts.superadmin')
@section('title', 'View Details')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View Details</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Passengers</li>
            <li class="breadcrumb-item active" aria-current="page">View Details</li>
        </ol>
    </div>


        <div class="row">
            <div class="col-md-6">
                <!-- Left Card -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Passenger Details</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($tickets as $ticket)
                        <form action="{{ url('superadmin/update-tickets/'.$ticket->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        <div class="form-group">
                            <label for="passengerName">Passenger Name</label>
                            <input type="text" class="form-control" id="passengerName" value="{{ $ticket->last_name }} , {{ $ticket->first_name }} {{ $ticket->middle_initial }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Contact Number</label>
                            <input type="text" class="form-control" id="contactNumber" value="{{ $ticket->contact_number }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" value="{{ $ticket->address }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="text" class="form-control" id="dob" value="{{ $ticket->date_of_birth }}" readonly>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Right Card -->
                <div class="card mb-5">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Reservation Details</h6>
                      </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Flight Number</label>
                                <input type="text" class="form-control" value="{{ $ticket->flight_number }}" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Airline</label>
                                <input type="text" class="form-control" value="{{ $ticket->airline }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Origin</label>
                                <input type="text" class="form-control" value="{{ $ticket->originAirportName }} ({{ $ticket->originAirportCode }})" 
                                readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Departure</label>
                                <input type="text" class="form-control" value="{{ $ticket->destinationAirportName }} ({{ $ticket->destinationAirportCode }})" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Arrival Date</label>
                                <input type="text" class="form-control" value="{{ $ticket->arrival_date ? date('d M Y', strtotime($ticket->arrival_date)) : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Arrival Time</label>
                                <input type="text" class="form-control" value="{{ $ticket->arrivalTime }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Departure Date</label>
                                <input type="text" class="form-control" value="{{ $ticket->departure_date ? date('d M Y', strtotime($ticket->departure_date)) : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Departure Time</label>
                                <input type="text" class="form-control" value="{{ $ticket->departureTime }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Seat</label>
                                <input type="text" class="form-control" value="{{ $ticket->seat }}" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Gate</label>
                                <input type="text" class="form-control" value="{{ $ticket->gate }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="statusSelect">
                            <option {{ $ticket->status == '0' ? 'selected' : '' }} value="0">Pending</option>
                            <option {{ $ticket->status == '1' ? 'selected' : '' }} value="1">Approved</option>
                            <option {{ $ticket->status == '2' ? 'selected' : '' }} value="2">Canceled</option>
                        </select>
                    </div>      
                    <div class="form-group" id="cancellationReasonField">
                        <label for="cancellation_reason" style="display: none;">Cancellation Reason</label>
                        <textarea class="form-control" name="cancellation_reason" id="cancellation_reason" style="display: none;"></textarea>
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
<script>
    // Get references to the select and input elements
    const statusSelect = document.getElementById('statusSelect');
    const cancellationReasonLabel = document.querySelector('label[for="cancellation_reason"]');
    const cancellationReasonInput = document.getElementById('cancellation_reason');

    // Add an event listener to the select element
    statusSelect.addEventListener('change', function() {
        if (statusSelect.value === '2') {
            // If "Canceled" is selected, show the "Cancellation Reason" field and label
            cancellationReasonLabel.style.display = 'block';
            cancellationReasonInput.style.display = 'block';
        } else {
            // Otherwise, hide the "Cancellation Reason" field and label
            cancellationReasonLabel.style.display = 'none';
            cancellationReasonInput.style.display = 'none';
        }
    });
</script>
@endsection

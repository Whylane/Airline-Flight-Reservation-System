@extends('layouts.admin')
@section('title', 'Update Flight')
@section('content')
<div class="container pt-4 px-4">
    <div class="bg-secondary rounded p-4 text-white">
        <h5 class="mb-4">Update Flight</h5>
        <form action="{{ url('admin/update-flight/'.$flights->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="d-flex justify-content-center mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="flight_type" id="onewayOption" value="one_way" checked>
                    <label class="form-check-label" for="onewayOption">
                        One-Way
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="flight_type" id="roundtripOption" value="round_trip">
                    <label class="form-check-label" for="roundtripOption">
                        Round-Trip
                    </label>
                </div>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" name="origin_id" required>
                    <option value="" disabled>Select Origin</option>
                    @foreach ($airports as $airport)
                    <option value="{{ $airport->id }}" {{ $flights->origin_id == $airport->id ? 'selected' : '' }}>
                        {{ $airport->location }}
                    </option>
                    @endforeach
                </select>
                <label>Origin</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" name="destination_id" required>
                    <option value="" disabled>Select Destination</option>
                    @foreach ($airports as $airport)
                    <option value="{{ $airport->id }}" {{ $flights->destination_id == $airport->id ? 'selected' : '' }}>
                        {{ $airport->location }}
                    </option>
                    @endforeach
                </select>
                <label>Destination</label>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="departure_date" value="{{ $flights->departure_date }}" required>
                        <label for="departure_date">Departure Date</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="arrival_date" value="{{ $flights->arrival_date }}" required>
                        <label for="arrival_date">Arrival Date</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <div class="form-floating">
                        <input type="time" class="form-control" name="departure_time" value="{{ $flights->departure_time }}" required>
                        <label for="departure_time">Departure Time</label>
                    </div>
                </div>

                <div class="col mb-3">
                    <div class="form-floating">
                        <input type="time" class="form-control" name="arrival_time" value="{{ $flights->arrival_time }}" required>
                        <label for="arrival_time">Arrival Time</label>
                    </div>
                </div>
            </div>
           
            <div class="row" id="onewayContent">
                <div class="col mb-3">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="departure_date_return" value="{{ $flights->departure_date_return }}" required>
                        <label for="departure_date_return">Departure Date (Return)</label>
                    </div>
                </div>

                <div class="col mb-3">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="arrival_date_return" value="{{ $flights->arrival_date_return }}" required>
                        <label for="arrival_date_return">Arrival Date (Return)</label>
                    </div>
                </div>
          
                <div class="col  mb-3">
                    <div class="form-floating">
                        <input type="time" class="form-control" name="departure_time_return" value="{{ $flights->departure_time_return }}" required>
                        <label for="departure_time_return">Departure Time (Return)</label>
                    </div>
                </div>

                <div class="col mb-3">
                    <div class="form-floating">
                        <input type="time" class="form-control" name="arrival_time_return" value="{{ $flights->arrival_time_return }}" required>
                        <label for="arrival_time_return">Arrival Time (Return)</label>
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="price" value="{{ $flights->price }}" required>
                <label for="price">Price</label>
            </div>

            {{-- <div class="form-floating mb-3">
                <select class="form-select" name="airline_id" required>
                    <option value="" disabled>Choose Flight Number</option>
                    @foreach ($airlines as $airline)
                    <option value="{{ $airline->id }}" {{ $flights->airline_id == $airline->id ? 'selected' : '' }}>
                        {{ $airline->flight_number }}
                    </option>
                    @endforeach
                </select>
                <label>Flight Number</label> --}}

            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

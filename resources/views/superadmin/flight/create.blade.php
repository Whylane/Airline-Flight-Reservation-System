@extends('layouts.superadmin')
@section('title', 'Add Flight')
@section('content')
<!-- Add Flight Start -->
 <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Add Flights</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Flights</li>
        <li class="breadcrumb-item active" aria-current="page">Add Flights</li>
      </ol>
    </div>

    <form id="search-form" action="{{ url('superadmin/store-flight') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="row">
      <div class="col-lg">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-body">
                <div class="form-group justify-content-center">
                    <label>Flight Type</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="onewayOption" name="flight_type" class="custom-control-input" value="one_way" checked>
                                <label class="custom-control-label" for="onewayOption">One-Way</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="roundtripOption" name="flight_type" class="custom-control-input" value="round_trip">
                                <label class="custom-control-label" for="roundtripOption">Round-Trip</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="originSelect">Origin</label>
                            <select class="form-control" id="originSelect" name="origin_id" required>
                                <option value="" disabled selected>Choose Origin</option>
                                @foreach ($airports as $airport)
                                    <option value="{{ $airport->id }}">{{ $airport->location }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="destinationSelect">Destination</label>
                            <select class="form-control" id="destinationSelect" name="destination_id" required>
                                <option value="" disabled selected>Choose Destination</option>
                                @foreach ($airports as $airport)
                                    <option value="{{ $airport->id }}">{{ $airport->location }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                  <div class="col">
                      <div class="form-group" id="departureDate">
                          <label for="departure_date">Departure Date</label>
                          <div class="input-group date">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                              </div>
                              <input type="text" class="form-control" name="departure_date" placeholder="dd/mm/yyyy" required>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group" id="arrivalDate">
                          <label for="arrival_date">Arrival Date</label>
                          <div class="input-group date">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                              </div>
                              <input type="text" class="form-control" name="arrival_date" placeholder="dd/mm/yyyy" required>
                          </div>
                      </div>
                  </div>
                </div>   
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="departure_time">Departure Time</label>
                            <div class="input-group clockpicker" data-placement="bottom" data-align="top" id="departureTime">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control" name="departure_time" placeholder="--:-- --" required>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="arrival_time">Arrival Time</label>
                            <div class="input-group clockpicker" data-placement="bottom" data-align="top" id="arrivalTime">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control" name="arrival_time" placeholder="--:-- --" required>
                            </div>
                        </div>
                    </div>
                </div>         
                <div class="row">
                    <div class="col">
                        <label for="price">Price</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="number" class="form-control" name="price" required>
                        </div>                       
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="airlineSelect">Airline</label>
                            <select class="form-control" name="airline_id" required>
                                <option value="" disabled selected>Choose Airline</option>
                                @foreach ($airlines as $airline)
                                    <option value="{{ $airline->id }}">{{ $airline->airline }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>       
                <div class="row" id="onewayContent">
                    <div class="col">
                        <div class="form-group" id="departureDateReturn">
                            <label for="departure_date_return">Departure Date (Return)</label>
                            <div class="input-group date">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control" name="departure_date_return" placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                        <div class="form-group" id="arrivalDateReturn">
                            <label for="arrival_date_return">Arrival Date (Return)</label>
                            <div class="input-group date">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control" name="arrival_date_return" placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="departure_time_return">Departure Time (Return)</label>
                            <div class="input-group clockpicker" data-placement="bottom" data-align="top" id="departureTimeReturn">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control" name="departure_time_return" placeholder="--:-- --">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="arrival_time_return">Arrival Time (Return)</label>
                            <div class="input-group clockpicker" data-placement="bottom" data-align="top" id="arrivalTimeReturn">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control" name="arrival_time_return" placeholder="--:-- --">
                            </div>
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
<!-- Add Flight End -->
@endsection
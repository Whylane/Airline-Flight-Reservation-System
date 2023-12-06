@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<div class="container">
    <div class="text-center mt-5">
        <h1>Let’s explore & travel</h1>
        <p class="intro">Provide the best destinations!</p>
    </div>

    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <div class="card-body">
            <form id="search-form" action="{{ route('search-flight.results') }}" method="GET">
                <div class="d-flex justify-content-center mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="flight_type" id="roundtripOption"
                            value="round_trip" checked>
                        <label class="form-check-label" for="roundtripOption">
                            Round-Trip
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="flight_type" id="onewayOption"
                            value="one_way">
                        <label class="form-check-label" for="onewayOption">
                            One-Way
                        </label>
                    </div>
                </div>

                <div>
                    <!-- Content for Roundtrip -->
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <label for="origin_id" class="mb-2">From</label>
                            <select class="form-select" id="origin_id" name="origin_id" required>
                                <option value="" disabled selected>Choose Origin</option>
                                @foreach ($airports as $airport)
                                <option value="{{ $airport->id }}">{{ $airport->location }} ({{ $airport->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="destination_id" class="mb-2">To</label>
                            <select class="form-select" name="destination_id" required>
                                <option value="" disabled selected>Choose Destination</option>
                                @foreach ($airports as $airport)
                                <option value="{{ $airport->id }}">{{ $airport->location }} ({{ $airport->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="departure_date" class="mb-2">Departure Date</label>
                            <input min="{{ $date }}" type="date" class="form-control" name="departure_date"
                                placeholder=" " required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3" id="onewayContent">
                            <label for="departure_date_return" class="mb-2">Return Date</label>
                            <input min="{{ $date }}" type="date" class="form-control" id="departure_date_return"
                                name="departure_date_return" placeholder=" ">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="seatClassRoundtrip" class="mb-2">Seat Class</label>
                            <select class="form-select" id="seatClassRoundtrip" name="seatClassRoundtrip">
                                <option value="economy">Economy</option>
                                <option value="business">Business</option>
                                <option value="first_class">First Class</option>
                            </select>
                        </div>
                    </div>

                    <div class="row flex justify-content-start mb-3">
                        <div class="col-md-4 mb-3">
                            <label for="adultPassengers" class="mb-2">Adults</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary" id="decrementAdults">
                                        <span class="fa fa-minus"></span>
                                    </button>
                                </span>
                                <input type="number" class="form-control input-number" id="adultPassengers"
                                    name="adultPassengers" value="1" min="1">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-primary" id="incrementAdults">
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="childPassengers" class="mb-2">Children</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary" id="decrementChildren">
                                        <span class="fa fa-minus"></span>
                                    </button>
                                </span>
                                <input type="number" class="form-control input-number" id="childPassengers"
                                    name="childPassengers" value="0" min="0">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-primary" id="incrementChildren">
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="infantPassengers" class="mb-2">Infants</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary" id="decrementInfants">
                                        <span class="fa fa-minus"></span>
                                    </button>
                                </span>
                                <input type="number" class="form-control input-number" id="infantPassengers"
                                    name="infantPassengers" value="0" min="0">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-primary" id="incrementInfants">
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Search Flights</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    console.log("hello world")
    document.addEventListener('DOMContentLoaded', function () {
        // Add event listener to radio buttons
        const roundtripOption = document.getElementById('roundtripOption');
        const roundtripContent = document.getElementById('roundtripContent');
        const onewayOption = document.getElementById('onewayOption');
        const onewayContent = document.getElementById('onewayContent');
        const departureDateReturn = document.getElementById('departure_date_return');



        if(onewayOption.checked === true) {
            onewayContent.style.display = 'none';
        } else {
            onewayContent.style.display = 'block';
        }

        roundtripOption.addEventListener('change', () => {
            onewayContent.style.display = 'block';
        });

        onewayOption.addEventListener('change', () => {
            onewayContent.style.display = 'none';
            departureDateReturn.value = '';

        });

        /* adults */
        const adultsBtnIncrement = document.querySelector('#incrementAdults');
            const adultsBtnDecrement = document.querySelector('#decrementAdults');
             let count = document.getElementById('adultPassengers');
             function handleIncrement() {
                count.stepUp();
            }
            function handleDecrement() {
             count.stepDown();
            }
            adultsBtnIncrement.addEventListener("click", handleIncrement);
            adultsBtnDecrement.addEventListener("click", handleDecrement);
        /* children */
        const childrenBtnIncrement = document.querySelector('#incrementChildren');
            const childrenBtnDecrement = document.querySelector('#decrementChildren');
             let countChildren = document.getElementById('childPassengers');
             function childrenhandleIncrement() {
                countChildren.stepUp();
            }
            function childrenhandleDecrement() {
             countChildren.stepDown();
            }
            childrenBtnIncrement.addEventListener("click", childrenhandleIncrement);
            childrenBtnDecrement.addEventListener("click", childrenhandleDecrement);
        /* infanrts */
        const infantBtnIncrement = document.querySelector('#incrementInfants');
            const infantBtnDecrement = document.querySelector('#decrementInfants');
             let countInfant = document.getElementById('infantPassengers');
             function infanthandleIncrement() {
                countInfant.stepUp();
            }
            function infanthandleDecrement() {
             countInfant.stepDown();
            }
            infantBtnIncrement.addEventListener("click", infanthandleIncrement);
            infantBtnDecrement.addEventListener("click", infanthandleDecrement);

            const originSelect = document.getElementById('origin_id');
            const destinationSelect = document.querySelector('[name="destination_id"]');
            const form = document.querySelector('#search-form');
            console.log(form)

            // Initialize the options
            const options = Array.from(destinationSelect.options);

            // Add event listener to origin select
            originSelect.addEventListener('change', function () {
                const selectedOrigin = this.value;

                options.forEach(option => {
                    option.style.display = 'block';
                    if (option.value === selectedOrigin) {
                        option.style.display = 'none';
                    }
                });
            });

        // Add event listener to form submission
        form.addEventListener('submit', function (event) {
            const selectedOrigin = originSelect.value;
            const selectedDestination = destinationSelect.value;

            if (selectedOrigin === selectedDestination) {
                event.preventDefault(); // Prevent form submission
                alert('Departure and Arrival must be different.')
            }
        });
    });

</script>

@endsection
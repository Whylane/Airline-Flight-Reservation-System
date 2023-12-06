<!-- Modal -->
<div class="modal modal-lg fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="exampleModalLabel">Booking Summary</h5>
                    <div class="mt-2">
                        <label style="font-size: 1.15rem;" for="booking_id">Booking ID:</label>
                        <input style="font-size: 1.15rem; border: none; outline: none;" type="text" id="booking_id"
                            name="booking_id" readonly>

                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @for ($i = 1; $i <= $numberofPassengers; $i++) <div class="mb-3">
                    <div>
                        <h5 style="font-weight: 600">
                            Personal Details
                            @if ( $i <= $adult) <h6 class="fw-bold">Adult </h6 class="fw-bold">
                                @elseif ($i <=$adult + $child && $child> 0)
                                    <h6 class="fw-bold">Child </h6 class="fw-bold">
                                    @else
                                    <h6 class="fw-bold">Infant </h6 class="fw-bold">
                                    @endif
                        </h5>
                    </div>
                    <div>
                        <span>Name:</span>
                        <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].firstName"></span>
                        <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].lastName"></span>
                        <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].middleInitial"></span>
                    </div>
                    <div>
                        <span>Contact Number:</span>
                        <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].contactNumber"></span>
                    </div>
                    <div>
                        <span>Address:</span>
                        <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].address"></span>
                    </div>
                    <div>
                        <span>Date of Birth:</span>
                        <span class="fw-semibold" x-text="inputs[{{ $i - 1 }}].dateOfBirth"></span>

                    </div>
                    <div>
                        <span id="pwd_display"></span>
                    </div>
            </div>
            @endfor
            @if ($selected_departure)

            <div class="mt-3">
                <h5 style="font-weight: 600">
                    Flight Details
                </h5>
                <div>

                    <div>
                        <span class="text-primary">
                            Departure
                        </span>
                    </div>
                    @foreach ($selected_departure as $selected_dep)
                    <div>
                        Flight No: {{ $selected_dep->airline->flight_number }}
                        {{-- {{ $originAirport }} --}}
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-between p-3">
                                    <div>
                                        <h5>
                                            {{ $originAirport->code }}
                                        </h5>
                                        <p>
                                            {{ $originAirport->location }}
                                        </p>
                                    </div>
                                    <div>
                                        <svg fill="#0000ff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px"
                                            viewBox="0 0 485.641 485.641" xml:space="preserve" stroke="#0000ff">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M467.44,109.264c-25.459-13.141-71.192-23.554-159.117,45.681c-19.059,15.009-107.356,81.918-125.079,98.352 c-17.015,15.779-33.936,31.674-50.548,47.877c-3.772,3.681-7.544,7.362-11.305,11.056l-93.623-44.961 c-8.075-3.884-18.044-1.745-23.735,5.635c-6.535,8.476-4.963,20.645,3.513,27.18l99.087,76.411 c0.309,0.235,20.145,17.165,41.042,5.167c17.429-10.007,34.815-20.109,52.005-30.521c20.242-12.258,40.359-24.715,60.4-37.299 c17.423-10.941,34.736-22.061,51.993-33.264l-4.554,54.834c-1,12.608,7.632,24.328,20.343,26.733 c13.617,2.576,26.746-6.373,29.323-19.99l19.738-104.292c1.603-1.07,3.211-2.127,4.812-3.198 c18.932-12.664,36.955-26.428,54.75-40.682C462.924,172.807,512.506,131.232,467.44,109.264z">
                                                        </path>
                                                        <path
                                                            d="M173.896,216.962l34.464,1.797c23.886-18.829,54.341-42.175,74.378-57.595l-108.842,5.676 c-12.628,0.704-23.079,10.836-23.753,23.755C149.421,204.435,160.055,216.24,173.896,216.962z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5>
                                            {{ $destinationAirport->code }}
                                        </h5>
                                        <p>
                                            {{ $destinationAirport->location }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <h6 class="fw-bold">
                                        Departure
                                        {{-- Origin --}}
                                    </h6>
                                    <li x-text="departure_date"></li>
                                    <li x-text="departureTime"></li>
                                    <li x-text="originAirportName"></li>
                                </div>
                            </div>
                            {{-- @if ($queryFlightType === "round_trip") --}}
                            <div class="col-md-4">
                                <div>
                                    <h6 class="fw-bold">
                                        Arrival
                                        {{-- Arrivak --}}
                                    </h6>
                                    <li x-text="arrival_date"></li>
                                    <li x-text="arrivalTime"></li>
                                    <li x-text="destinationAirportName"></li>

                                </div>
                            </div>
                            {{-- @endif --}}
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <h3> PHP {{ $selected_dep->price }}.00</h3>
                        </div>
                    </div>
                    @endforeach

                </div>
                @if ($queryFlightType === "round_trip")
                <div>

                    <div>
                        <span class="text-primary">
                            Return
                        </span>
                    </div>
                    <div>
                        Flight No: <span>{{ $flight->airline->flight_number }}</span>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-between p-3">

                                    <div>
                                        <h5 x-text="destinationAirportCode">
                                        </h5>
                                        <p x-text="destinationAirportLocation"></p>
                                    </div>
                                    <div>
                                        <svg fill="#0000ff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px"
                                            viewBox="0 0 485.641 485.641" xml:space="preserve" stroke="#0000ff">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M467.44,109.264c-25.459-13.141-71.192-23.554-159.117,45.681c-19.059,15.009-107.356,81.918-125.079,98.352 c-17.015,15.779-33.936,31.674-50.548,47.877c-3.772,3.681-7.544,7.362-11.305,11.056l-93.623-44.961 c-8.075-3.884-18.044-1.745-23.735,5.635c-6.535,8.476-4.963,20.645,3.513,27.18l99.087,76.411 c0.309,0.235,20.145,17.165,41.042,5.167c17.429-10.007,34.815-20.109,52.005-30.521c20.242-12.258,40.359-24.715,60.4-37.299 c17.423-10.941,34.736-22.061,51.993-33.264l-4.554,54.834c-1,12.608,7.632,24.328,20.343,26.733 c13.617,2.576,26.746-6.373,29.323-19.99l19.738-104.292c1.603-1.07,3.211-2.127,4.812-3.198 c18.932-12.664,36.955-26.428,54.75-40.682C462.924,172.807,512.506,131.232,467.44,109.264z">
                                                        </path>
                                                        <path
                                                            d="M173.896,216.962l34.464,1.797c23.886-18.829,54.341-42.175,74.378-57.595l-108.842,5.676 c-12.628,0.704-23.079,10.836-23.753,23.755C149.421,204.435,160.055,216.24,173.896,216.962z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 x-text="originAirportCode">
                                        </h5>
                                        <p x-text="originAirportLocation"></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <h6 class="fw-bold">
                                        Departure
                                        {{-- Origin --}}
                                    </h6>
                                    <li>
                                        {{ \Carbon\Carbon::parse($result->departure_date_return)->format('M d Y, D.') }}
                                    </li>
                                    <li>
                                        {{ is_string($flight->arrival_time_return) ?
                                        \Carbon\Carbon::parse($flight->departure_time_return)->format('h:i A') : '' }}
                                    </li>
                                    <li x-text="destinationAirportName"></li>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <h6 class="fw-bold">
                                        Arrival
                                    </h6>
                                    <li>
                                        {{ \Carbon\Carbon::parse($result->arrival_date_return)->format('M d Y, D.') }}
                                    </li>
                                    <li>
                                        {{ is_string($flight->arrival_time_return) ?
                                        \Carbon\Carbon::parse($departureTime)->format('h:i A') : '' }}
                                    </li>
                                    <li x-text="originAirportName"></li>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            @foreach ($selected_return as $item)
                            <h3> PHP {{ $item->price }}.00</h3>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <h6>Adds on</h6>
                <p>Baggage: <span id="baggageTotal"></span></p>
                <p>Seat Selection: <span id="totalValueElement"></span></p>

                <div class="row mt-5">
                    <div class="form-check  col-md-8">
                        <input class="form-check-input" type="checkbox" id="confirmationCheckbox">
                        <label class="form-check-label" for="confirmationCheckbox">
                            <span class="fw-bold"> I confirm that I have reviewed my reservation summary</span>, and I
                            acknowledge that the price and
                            flight details are correct. I have read and accept the cancellation policy, check-in
                            guidelines,
                            fare rules, and terms and conditions. I acknowledge that it is my responsibility to comply
                            with
                            all the regulations and requirements specified by the airline. By clicking 'Submit,' I
                            affirm
                            that I have read and understood the terms of my reservation. I am aware of the necessary
                            check-in procedures and any associated fees.
                        </label>
                    </div>
                    <div style="background:rgb(211, 211, 22); "
                        class="col md-4 d-flex flex-column  align-items-center justify-content-center">
                        <p>Grand Total</p>
                        {{-- @php
                        $total = $item->price + $selected_dep->price
                        @endphp --}}
                        {{-- <h3> PHP {{ $total }}.00</h3> --}}
                        <h3 class="font-bold"> PHP <span id="grandtotal"></span>.00</h3>
                    </div>
                </div>
            </div>
            @endif

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                <button id="confirmButton" type="submit" class="btn btn-primary">Confirm and Continue</button>
            </div>
        </div>
    </div>
</div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
@php
// Assuming $numberofPassengers is defined in your Blade template
$initialTotalAmount = 0;
@endphp

<script>
    // Wait for the DOM content to be fully loaded
    document.addEventListener('DOMContentLoaded', function () {

        function generateRandomString(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }

        // Get the input element
        const randomInput = document.getElementById('booking_id');

        // Generate a random alphanumeric string of length 10
        const randomValue = generateRandomString(10);

        // Set the generated value to the input element
        randomInput.value = randomValue;





        // Select the radio button with id="0kg{{ $i }}" and set it as checked
        const defaultRadioButton = document.getElementById('0kg{{ $i }}');
        if (defaultRadioButton) {
            defaultRadioButton.checked = true;
        }
    });

    // Get all radio buttons with class 'baggage-option'
    if (typeof totalAmount === 'undefined') {
        // Initialize a global variable to store the total amount
        var totalAmount = 0;
    }
    const radioButtons_{{ $i }} = document.querySelectorAll('.baggage-option');

    // Initialize an array to store selected seats
    var selectedSeats = [];

    // Variable to store the total value of selected seats
    var selectedSeatsValue = 0;

    // Function to handle radio button change event
    function handleRadioButtonChange(event) {
        const selectedValue = parseFloat(event.target.value); // Convert the value to a number

        // Get the parent baggage card
        const baggageCard = event.target.closest('.baggage_card');

        // Get the total amount element for the specific card
        const totalAmountElement = baggageCard.querySelector('#amount');

        // Get the current total amount for the specific card
        const currentTotalAmount = parseFloat(totalAmountElement.textContent);

        // Subtract the previous selected value from the total amount
        totalAmount -= currentTotalAmount;

        // Update the amount for the specific card
        totalAmountElement.textContent = selectedValue.toFixed(2); // Display the value with two decimal places

        // const totalP = {{ $item->price ?? 0  + $selected_dep->price  }};
        const totalP =  {{ $item->price ?? 0 }} +  {{ $selected_dep->price }} ;
        console.log(totalP);

        // Add the new selected value to the total amount
        totalAmount += selectedValue;

        // Update the grand total
        updateGrandTotal();
    }

    // Attach change event listener to each radio button
    radioButtons_{{ $i }}.forEach(radioButton => {
        radioButton.addEventListener('change', handleRadioButtonChange);
    });

    // Get all the checkboxes
    var checkboxes = document.querySelectorAll('input[name="seat[]"]');

    checkboxes.forEach(function (checkbox) {
        // Add an event listener to each checkbox
        checkbox.addEventListener('change', function () {
            // Check if the checkbox is checked
            if (this.checked) {
                // Determine the value based on the seat index
                var seatValue = getSeatValue(this.value);

                // Add the seat value to the selectedSeats array
                selectedSeats.push({ seat: this.value, value: seatValue });

                // Update the total value of selected seats
                selectedSeatsValue = calculateTotalValue(selectedSeats);

                // Update the grand total
                updateGrandTotal();

                // Log the current selected seats and total value after each change event
                logSelectedSeatsAndTotal(selectedSeats, selectedSeatsValue);
            } else {
                // Remove the seat value from the selectedSeats array
                var index = selectedSeats.findIndex(function (seat) {
                    return seat.seat === this.value;
                }.bind(this));

                if (index !== -1) {
                    selectedSeats.splice(index, 1);
                }

                // Update the total value of selected seats
                selectedSeatsValue = calculateTotalValue(selectedSeats);

                // Update the grand total
                updateGrandTotal();

                // Log the current selected seats and total value after each change event
                logSelectedSeatsAndTotal(selectedSeats, selectedSeatsValue);
            }
        });
    });

    // Function to determine the value based on the seat index
    function getSeatValue(seat) {
        var row = seat.charAt(0);
        var column = parseInt(seat.substring(1));

        if ((row === 'A' && column >= 1 && column <= 5)) {
            return 390;
        } else if(row === 'B' && column >= 1 && column <= 6) {
            return 245;
        }  else if (row === 'C' && column >= 1 && column <= 5 ||
            row === 'D' && column >= 1 && column <= 5) {
            return 200;
        } else {
            return 0; // Default value if seat does not match any criteria
        }
    }

    // Function to calculate the total value of selected seats
    function calculateTotalValue(seats) {
        return seats.reduce(function (total, seat) {
            return total + seat.value;
        }, 0);
    }

    // Function to display the total value on the screen
    function displayTotalValue(value) {
        // Update the content of the totalValueElement with the calculated total value
        // totalValueElement.textContent = 'Total Value: ' + value;
    }

    // Function to log the current selected seats and total value
    function logSelectedSeatsAndTotal(seats, total) {
        console.log('Selected Seats:', seats);
        console.log('Total Value:', total);
        totalValueElement.textContent = total;
    }

    // Function to update the grand total
    function updateGrandTotal() {
        // const totalP = {{ $item->price ?? 0  + $selected_dep->price  }};
        const totalP =  {{ $item->price ?? 0 }} +  {{ $selected_dep->price }} ;
        const gtotal = totalAmount + selectedSeatsValue + totalP;


        document.getElementById("grandtotal").textContent = gtotal.toFixed(2); // Display the value with two decimal places
        document.getElementById("baggageTotal").textContent = totalAmount.toFixed(2);
    }


    // const fback = {{ $item->price ?? 0  + $selected_dep->price  }}
    const fback = {{ $item->price ?? 0 }} +  {{ $selected_dep->price }} ;
        const fbackB= 0
        document.getElementById("grandtotal").textContent = fback;
        document.getElementById("baggageTotal").textContent = fbackB;

    // Get the checkbox and the button
    const confirmationCheckbox = document.getElementById('confirmationCheckbox');
    const confirmButton = document.getElementById('confirmButton');

    confirmButton.disabled = !confirmationCheckbox.checked;

    // Add an event listener to the checkbox
    confirmationCheckbox.addEventListener('change', function () {
        // Toggle the 'disabled' attribute of the button based on checkbox state
        confirmButton.disabled = !confirmationCheckbox.checked;
    });
</script>
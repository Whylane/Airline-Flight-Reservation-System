@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
@php $numberofPassengers = $adult + $child + $infant; @endphp
<form class="form" action="{{ route('booking.store') }}" method="POST" x-data="{
    ...formData({
        'inputs': {{ @json_encode(array_fill(0, $numberofPassengers, ['firstName' => '', 'middleInitial' => '', 'lastName' => '', 'contactNumber' => '', 'address' => '', 'dateOfBirth' => ''])) }},
    }),
    'flight_number': '{{ $result->flight_number }}',
    'departure_date':  '{{ \Carbon\Carbon::parse($result->departure_date)->format('M d Y, D.') }}',
    'departure_date_return':  '{{ \Carbon\Carbon::parse($result->departure_date_return)->format('M d Y, D.') }}',
    'arrival_date':  '{{ \Carbon\Carbon::parse($result->arrival_date)->format('M d Y, D.') }}',
    'arrival_date_return':  '{{ \Carbon\Carbon::parse($result->arrival_date_return)->format('M d Y, D.') }}',
    'originAirportCode': '{{  $originAirportCode}}',
    'destinationAirportCode': '{{  $destinationAirportCode}}',
    'destinationAirportLocation': '{{  $destinationAirportLocation}}',
    'originAirportLocation': '{{  $originAirportLocation}}',
    'departureTime': '{{ is_string($departureTime) ? \Carbon\Carbon::parse($departureTime)->format('h:i A') : '' }}',
    'departureTimeReturn': '{{ is_string($result->departure_time_return) ? \Carbon\Carbon::parse($result->departure_time_return)->format('h:i A') : '' }}',
    'arrivalTime': '{{ is_string($arrivalTime) ? \Carbon\Carbon::parse($arrivalTime)->format('h:i A') : '' }}',
    'arrivalTimeReturn': '{{ is_string($result->arrival_time_return) ? \Carbon\Carbon::parse($result->arrival_time_return)->format('h:i A') : '' }}',
    'destinationAirportName': '{{  $destinationAirportName}}',
    'originAirportName': '{{  $originAirportName}}',
}">
    @csrf
    <!-- This inputs is need to store after booking (submitting the form) -->
    <input name="flight_type" id="flight_type" type="hidden" value="{{ $queryFlightType }}">
    <input name="airline" id="airline" type="hidden" value="{{ $result->airline->airline }}">
    <input name="airline_id" id="airline_id" type="hidden" value="{{ $result->airline->id }}">
    <input x-model="flight_number" name="flight_no" id="flight_no" type="hidden">
    <input x-model="departure_date" name="departure_date" id="departure_date" type="hidden">
    <input x-model="departure_date_return" name="departure_date_return" id="departure_date_return" type="hidden">
    <input x-model="arrival_date" name="arrival_date" id="arrival_date" type="hidden">
    <input x-model="arrival_date_return" name="arrival_date_return" id="arrival_date_return" type="hidden">
    <input name="duration" id="duration" type="hidden" value="{{ $result->duration }}">
    <input name="price" id="price" type="hidden" value="{{ $result->price }}">
    <input name="adultPassengers" id="adultPassengers" type="hidden" value="{{ $adult }}">
    <input name="childPassengers" id="childPassengers" type="hidden" value="{{ $child }}">
    <input name="infantPassengers" id="infantPassengers" type="hidden" value="{{ $infant }}">
    <input name="seatClass" id="seatClass" type="hidden" value="{{ $querySeatClass }}">

    <input x-model="originAirportCode" name="originAirportCode" id="originAirportCode" type="hidden">
    <input x-model="destinationAirportCode" name="destinationAirportCode" id="destinationAirportCode" type="hidden">
    <input x-model="destinationAirportLocation" name="destinationAirportLocation" id="destinationAirportLocation"
        type="hidden">
    <input x-model="originAirportName" name="originAirportName" id="originAirportName" type="hidden">
    <input x-model="destinationAirportName" name="destinationAirportName" id="destinationAirportName" type="hidden">
    <input x-model="departureTimeReturn" name="departureTimeReturn" id="departureTimeReturn" type="hidden">

    <input x-model="originAirportLocation" name="originAirportLocation" id="originAirportLocation" type="hidden">
    <input x-model="departureTime" name="departureTime" id="departureTime" type="hidden">
    <input x-model="arrivalTime" name="arrivalTime" id="arrivalTime" type="hidden">
    <input x-model="arrivalTimeReturn" name="arrivalTimeReturn" id="arrivalTimeReturn" type="hidden">

    <div class="container step" id="step1">

        @for ($i = 1; $i <= $numberofPassengers; $i++) <div class="card" style="max-width: 800px; margin: 1rem auto;">
            <div class="card-body">

                <div>
                    <style>
                        .styled-h2 {
                            color: #0050FF;
                            font-weight: bold;
                            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
                            /* Adjust the shadow values as needed */
                            -webkit-text-stroke: 1px white;
                            /* Webkit browsers (Chrome, Safari) */
                            text-stroke: 1px white;
                            /* Standard CSS */
                        }
                    </style>

                    <h2 class="text-center mb-2 mt-2 styled-h2">
                        Passenger Details
                    </h2>
                    <div class="text-center" style="width: 60%; margin: 0 auto;">
                        <hr style="border-color: #59595B;">
                    </div>
                    @if ( $i <= $adult) <h4>Adult </h4>
                        @elseif ($i <=$adult + $child && $child> 0)
                            <h4>Child </h4>
                            @else
                            <h4>Infant </h4>
                            @endif
                </div>
                <div>
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <label for="last_name{{ $i }}" class="mb-2">Last Name</label>
                            <input type="text" x-model="inputs[{{ $i - 1 }}].lastName" id="last_name{{ $i }}"
                                class="form-control" name="last_name[]" required placeholder="Enter Last Name"
                                pattern="[A-Za-z]+" title="Only letters are allowed" p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="first_name{{ $i }}" class="mb-2">First Name</label>
                            <input type="text" x-model="inputs[{{ $i - 1 }}].firstName" id="first_name{{ $i }}"
                                class="form-control" name="first_name[]" required placeholder="Enter First Name"
                                pattern="[A-Za-z]+" title="Only letters are allowed">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middle_initial{{ $i }}" class="mb-2">Middle Initial</label>
                            <input type="text" x-model="inputs[{{ $i - 1 }}].middleInitial" id="middle_initial{{ $i }}"
                                class="form-control" name="middle_initial[]" required
                                placeholder="Enter Middle Initial">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="contact_number{{ $i }}" class="mb-2">Contact Number</label>
                            <input type="text" x-model="inputs[{{ $i - 1 }}].contactNumber" id="contact_number{{ $i }}"
                                class="form-control" name="contact_number[]" required placeholder="+63 123 456 7890"
                                pattern="\+?\d{1,3} ?\d{1,4} ?\d{1,4} ?\d{1,4}"
                                title="Invalid format. Use +63 XXX YYY ZZZZ or XXX YYY ZZZZ">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="address{{ $i }}" class="mb-2">Address</label>
                            <input type="text" x-model="inputs[{{ $i - 1 }}].address" id=" address{{ $i }}"
                                class="form-control" name="address[]" required placeholder="Enter Address">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="date_of_birth{{ $i }}" class="mb-2">Date of Birth</label>
                            <input type="date" x-model="inputs[{{ $i - 1 }}].dateOfBirth" id="date_of_birth{{ $i }}"
                                class="form-control" name="date_of_birth[]" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 border-bottom  pb-2">
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" name="pwd" id="pwd{{ $i }}" value="yes">
                        <label class="ms-2" for="pwd{{ $i }}">I am a Person with disability(PWD)</label for="pwd">
                    </div>
                </div>
                {{-- <div class="row mb-3 ">
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <label class="ms-2" for="special_asssitance">Do you need special assistance?</label
                            for="special_asssitance">
                        <div class="ms-4">
                            <input type="radio" name="special_asssitance{{ $i }}[]" value="yes"
                                id="special_asssitance_yes{{ $i }}">
                            <label for="special_asssitance_yes{{ $i }}">Yes</label>
                        </div>
                        <div class="ms-4">
                            <input type="radio" name="special_asssitance{{ $i }}[]" value="no"
                                id="special_asssitance_no{{ $i }}">
                            <label for="special_asssitance_no{{ $i }}">No</label>
                        </div>
                    </div>
                </div>
                --}}

                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    <label class="ms-2" for="special_assistance">Do you need special assistance?</label
                        for="special_assistance">
                    <div class="ms-4">
                        <input type="radio" name="special_assistance{{ $i }}[]" value="yes"
                            id="special_assistance_yes{{ $i }}" x-model="inputs[{{ $i - 1 }}].specialAssistance">
                        <label for="special_assistance_yes{{ $i }}">Yes</label>
                    </div>
                    <div class="ms-4">
                        <input type="radio" name="special_assistance{{ $i }}[]" value="no"
                            id="special_assistance_no{{ $i }}" x-model="inputs[{{ $i - 1 }}].specialAssistance">
                        <label for="special_assistance_no{{ $i }}">No</label>
                    </div>
                </div>

                <div x-show="inputs[{{ $i - 1 }}].specialAssistance === 'yes'"
                    x-init="inputs[{{ $i - 1 }}].specialAssistanceType = inputs[{{ $i - 1 }}].specialAssistanceType || ''">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="mb-2">Type of Special Assistance</label>
                            <div class="form-check">
                                <input type="radio" x-model="inputs[{{ $i - 1 }}].specialAssistanceType"
                                    value="mobility_assistance" class="form-check-input"
                                    id="mobility_assistance{{ $i }}">
                                <label class="form-check-label" for="mobility_assistance{{ $i }}">Mobility
                                    Assistance</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" x-model="inputs[{{ $i - 1 }}].specialAssistanceType"
                                    value="elderly_assistance" class="form-check-input" id="elderly_assistance{{ $i }}">
                                <label class="form-check-label" for="elderly_assistance{{ $i }}">Assistance for Elderly
                                    Passengers</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" x-model="inputs[{{ $i - 1 }}].specialAssistanceType"
                                    value="priority_boarding" class="form-check-input" id="priority_boarding{{ $i }}">
                                <label class="form-check-label" for="priority_boarding{{ $i }}">Priority
                                    Boarding</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" x-model="inputs[{{ $i - 1 }}].specialAssistanceType"
                                    value="extra_space" class="form-check-input" id="extra_space{{ $i }}">
                                <label class="form-check-label" for="extra_space{{ $i }}">Extra Space</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" x-model="inputs[{{ $i - 1 }}].specialAssistanceType"
                                    value="medical_equipment_assistance" class="form-check-input"
                                    id="medical_equipment_assistance{{ $i }}">
                                <label class="form-check-label" for="medical_equipment_assistance{{ $i }}">Assistance
                                    With Medical Equipment</label>
                            </div>
                            <!-- Add more radio buttons as needed -->
                        </div>
                        <!-- Add more fields as needed -->
                    </div>
                </div>

                <input type="hidden" x-model="inputs[{{ $i - 1 }}].specialAssistanceType"
                    name="special_assistance_type">
                <!-- ... (previous code) ... -->
                {{--
                <div x-show="inputs[{{ $i - 1 }}].specialAssistance === 'yes'"
                    x-init="inputs[{{ $i - 1 }}].specialAssistanceType = inputs[{{ $i - 1 }}].specialAssistanceType || ''">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="mb-2">Type of Special Assistance</label>
                            <div class="form-check">
                                <input type="radio" x-model="inputs[{{ $i - 1 }}].specialAssistanceType"
                                    value="mobility_assistance" class="form-check-input"
                                    id="mobility_assistance{{ $i }}">
                                <label class="form-check-label" for="mobility_assistance{{ $i }}">Mobility
                                    Assistance</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" x-model="inputs[{{ $i - 1 }}].specialAssistanceType"
                                    value="elderly_assistance" class="form-check-input" id="elderly_assistance{{ $i }}">
                                <label class="form-check-label" for="elderly_assistance{{ $i }}">Assistance for Elderly
                                    Passengers</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" x-model="inputs[{{ $i - 1 }}].specialAssistanceType"
                                    value="priority_boarding" class="form-check-input" id="priority_boarding{{ $i }}">
                                <label class="form-check-label" for="priority_boarding{{ $i }}">Priority
                                    Boarding</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" x-model="inputs[{{ $i - 1 }}].specialAssistanceType"
                                    value="extra_space" class="form-check-input" id="extra_space{{ $i }}">
                                <label class="form-check-label" for="extra_space{{ $i }}">Extra Space</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" x-model="inputs[{{ $i - 1 }}].specialAssistanceType"
                                    value="medical_equipment_assistance" class="form-check-input"
                                    id="medical_equipment_assistance{{ $i }}">
                                <label class="form-check-label" for="medical_equipment_assistance{{ $i }}">Assistance
                                    With Medical Equipment</label>
                            </div>
                            <!-- Add more radio buttons as needed -->
                        </div>
                        <!-- Add more fields as needed -->
                    </div>
                </div>
                --}}

            </div>
    </div>
    @endfor
    <div class="mt-4 d-flex justify-content-center align-items-center" style="max-width: 800px; margin: 80 auto;">
        <button type="button" onclick="nextStep(2)" class="btn  btn-primary w-100">Proceed</button>
    </div>
    </div>
    @include('user.booking-steps.add-ons')
</form>
@endsection

<style>
    .step {
        display: none;
    }
</style>

<script>
    function formData(data) {
    console.log(data.inputs); // Check the received data structure
    return {
        inputs: data.inputs || [
                {
                    firstName: '',
                    middleInitial: '',
                    lastName: '',
                    contactNumber: '',
                    address: '',
                    dateOfBirth: '',
                }
            ]
    };
}
    // Initialize currentStep from local storage or default to 1
        let currentStep = parseInt(localStorage.getItem('currentStep')) || 1;

        // Function to update the step and store in local storage
        function updateStep(step) {
            // Hide the current step
            document.getElementById('step' + currentStep).style.display = 'none';

            // Show the next/previous step
            document.getElementById('step' + step).style.display = 'block';

            // Update the current step
            currentStep = step;

            // Store the current step in local storage
            localStorage.setItem('currentStep', currentStep.toString());
        }

        // Function to go to the next step
        function nextStep(step) {
                // Validate name and contact number
        if (!validateName() || !validateContactNumber()) {
            alert("Please correct the input fields before proceeding.");
            return;
        }
            updateStep(step);
            history.pushState({ step: currentStep }, '', window.location.href);
        }

        // Function to go to the previous step and clear local storage
        function prevStep(step) {
            // Clear the currentStep from local storage
            localStorage.removeItem('currentStep');
            // Update the step
            updateStep(step);
            history.pushState({ step: currentStep }, '', window.location.href);
        }

            // Validation function for name fields
    function validateName() {
        const nameInputs = document.querySelectorAll('[id^="last_name"], [id^="first_name"]');
        for (const input of nameInputs) {
            if (!/^[A-Za-z]+$/.test(input.value)) {
                alert("Invalid name. Only letters are allowed.");
                return false;
            }
        }
        return true;
    }

    // Validation function for contact number field
    function validateContactNumber() {
        const contactNumberInput = document.getElementById('contact_number' + currentStep);
        if (!/\+?\d{1,3} ?\d{1,4} ?\d{1,4} ?\d{1,4}/.test(contactNumberInput.value)) {
            alert("Invalid contact number format. Use +63 XXX YYY ZZZZ or XXX YYY ZZZZ");
            return false;
        }
        return true;
    }

        // When the page loads, set the initial step
        document.addEventListener('DOMContentLoaded', function() {
            updateStep(currentStep);
            // Handle popstate event
            window.addEventListener('popstate', function(event) {
                // Reset the step to 1 if the user navigates back
                currentStep = 1;
                updateStep(currentStep);
            });
        });
</script>
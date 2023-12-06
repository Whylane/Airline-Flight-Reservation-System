<div class="container text-center mt-5 step" id="step2">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="mb-2 text-primary">ADD-ONS</h2>
                    <p>Add these add-ons to your bookings</p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                        data-bs-target="#myModal">Proceed without add-ons</button>
                </div>
            </div>
        </div>
        <div class="col-md-12">

            @for ($i = 1; $i <= $numberofPassengers; $i++) <div class="px-3  mt-4 py-3"
                style="background-color: #0050FF; border-radius: 20px;">
                <div class="card  rounded-2">
                    @if ( $i <= $adult) <h4 class="p-2">Adult </h4>
                        @elseif ($i <=$adult + $child && $child> 0)
                            <h4 class="p-2">Child </h4>
                            @else
                            <h4 class="p-2">Infant </h4>
                            @endif
                </div>
                <div class="mt-4 baggage_container">
                    <div class="d-flex mb-4">
                        {{-- adds on form --}}
                        <input type="checkbox" class="d-none baggage-checkbox" id="baggage-checkbox-{{ $i }}"
                            name="baggage_adds_on">
                        <div class="card rounded" style="width: 100%">
                            <div class="card-body d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <svg fill="#FAFF00" height="75px" width="75px" version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 512 512" xml:space="preserve" stroke="#d5b72b">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M473.517,109.116c-16.735,0-115.851,0-130.478,0V57.208c0-10.626-8.615-19.241-19.241-19.241H188.202 c-10.626,0-19.241,8.615-19.241,19.241v51.907c-14.953,0-111.804,0-130.478,0C17.263,109.115,0,126.378,0,147.597v287.953 c0,21.219,17.263,38.483,38.483,38.483c13.923,0,420.371,0,435.035,0c21.219,0,38.483-17.263,38.483-38.483V147.597 C512,126.379,494.737,109.116,473.517,109.116z M116,147.597h20.87v155.137H116V147.597z M136.87,435.551H116v-33.493h20.87 V435.551z M150.403,363.575h-47.937v-22.358h47.937V363.575z M198.726,196.531c0-15.815,12.82-28.635,28.635-28.635 s28.635,12.82,28.635,28.635c0,15.815-12.82,28.635-28.635,28.635S198.726,212.346,198.726,196.531z M298.536,334.3 l-19.476,72.684c-1.278,4.769-7.24,6.366-10.73,2.876l-53.209-53.209c-3.492-3.492-1.893-9.453,2.875-10.73l72.684-19.476 C295.45,325.167,299.814,329.531,298.536,334.3z M304.555,109.112h-97.111V76.449h97.111V109.112z M375.13,147.597H396v155.137 h-20.87V147.597z M396,435.551h-20.87v-33.493H396V435.551z M409.533,363.575h-47.937v-22.358h47.937V363.575z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <h4 class="m-4 text-primary">
                                        Baggage
                                    </h4>
                                </div>
                                <p class="card-text m-4">
                                    Choose your baggage allowance now, to steer clear of airport excess baggage fees!
                                </p>
                            </div>
                        </div>
                        <button id="baggage_button_add" type="button" data-target="baggage_card-{{ $i }}"
                            data-target-checkbox="baggage-checkbox-{{ $i }}"
                            class="baggage-button btn px-5 btn-info text-white">ADD</button>
                    </div>

                    @include('user.booking-steps.adds-on.baggage')
                </div>

                <div>

                    <div class="d-flex ">
                        {{-- adds on form --}}
                        <input type="checkbox" class="d-none seat-checkbox" id="seat-checkbox-{{ $i }}"
                            name="selector_adds_on">
                        <div class="card rounded" style="width: 100%">
                            <div class="card-body d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <svg fill="#FAFF00" width="75px" height="75px" viewBox="0 0 512 512"
                                        enable-background="new 0 0 512 512" id="seat_x5F_class" version="1.1"
                                        xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M355.604,312.941c2.415,0,4.373-1.959,4.373-4.375v-17.08c0-2.416-1.958-4.375-4.373-4.375h-43.736l11.973,25.83H355.604z">
                                            </path>
                                            <path
                                                d="M138.159,461.049c0,4.919,3.988,8.906,8.907,8.906H357.85c4.92,0,8.907-3.987,8.907-8.906v-14.945H138.159V461.049z">
                                            </path>
                                            <path
                                                d="M147.34,121.659l-13.479-0.049l32.257,83.041l10.591-3.958c5.783-2.161,8.719-8.601,6.557-14.384l-20.021-53.571 C160.763,126.096,154.429,121.684,147.34,121.659z">
                                            </path>
                                            <path
                                                d="M374.184,366.359c-1.084-6.89-6.309-12.395-13.132-13.839l-26.825-5.675c-5.186-1.097-9.551-4.574-11.779-9.385 l-10.309-22.259l-1.049-2.261l-11.973-25.83l-4.778-10.308c-4.811-10.047-14.958-16.464-26.12-16.464h-80.542 c-7.519,0-14.263-4.628-16.968-11.644l-14.56-37.766l-33.67-86.679c-2.702-4.527-7.605-7.397-13.002-7.397l-33.275,3.856 c-7.531,0-12.891,7.32-10.617,14.5l46.017,141.405c3.121,9.85,4.708,20.12,4.708,30.453v105.4c0,12.073,9.787,21.859,21.86,21.859 h-0.011v0.209h228.598v-0.209h2.82c8.034,0,14.169-7.175,12.921-15.112L374.184,366.359z">
                                            </path>
                                            <path
                                                d="M412.709,62.423c-35.895-29.134-88.77-26.764-121.973,5.403c-33.387,32.343-36.835,82.997-11.472,119.151l-10.259,34.611 c-0.763,2.572,1.738,4.91,4.253,3.977l33.844-12.56c36.499,22.105,84.696,16.467,114.998-15.942 C458.366,158.275,454.667,96.479,412.709,62.423z M363.922,103.157l38.786,4.253c1.726-0.08,3.424,0.442,4.807,1.475l4.753,3.551 c1.281,0.958,0.85,2.977-0.711,3.328l-32.169,1.512c-2.468,0.116-4.884-0.74-6.729-2.383l-9.997-8.904 C361.48,104.935,362.348,102.984,363.922,103.157z M416.471,153.134l-11.579,7.558c-7.087,4.626-16.292,4.409-23.151-0.547 l-30.059-21.717l-0.357,44.326c-0.016,1.918-2.273,2.936-3.721,1.676l-5.367-4.671c-1.562-1.36-2.604-3.219-2.947-5.261 l-8.639-51.264l-30.149-21.783c-0.762-0.551-1.426-1.241-1.918-2.042c-0.038-0.063-0.076-0.125-0.112-0.187 c-2.501-4.193-0.453-9.5,4.217-10.923c2.594-0.791,5.205-1.121,7.7-1.156c7.842-0.112,15.417,2.865,21.394,7.942l61.346,52.111 l13.238-2.525c3.455-0.66,7.004,0.545,9.344,3.173l1.275,1.431C418.029,150.448,417.785,152.275,416.471,153.134z">
                                            </path>
                                        </g>
                                    </svg>
                                    <h4 class="m-4 text-primary">
                                        Selector
                                    </h4>
                                </div>
                                <p class="card-text m-4">
                                    Window or aisle seat? Want to sit with your group or get extra legroom? Select a
                                    seat
                                    now!
                                </p>
                            </div>
                        </div>
                        <button id="selector_button_add" type="button" data-target="seat_card-{{ $i }}"
                            data-target-checkbox="seat-checkbox-{{ $i }}"
                            class="seat-button btn px-5 btn-info text-white">ADD</button>
                    </div>

                    @include('user.booking-steps.adds-on.seat-selection')
                </div>
        </div>
        @endfor

        <div class="mt-4 mb-5 d-flex justify-content-end">
            <button type="button" onclick="prevStep(1)" class="btn btn-lg btn-danger m-2">Back</button>
            <button type="button" class="btn btn-lg m-2 btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                Proceed
            </button>

        </div>
    </div>
</div>
</div>

@include('user.booking-summary')

<script>
    const baggageCheckboxes = document.querySelectorAll('.baggage-checkbox');
    const baggageButtons = document.querySelectorAll('.baggage-button');
    const seatCheckboxes = document.querySelectorAll('.seat-checkbox');
    const seatButtons = document.querySelectorAll('.seat-button');
    const baggageCard = document.getElementById('baggage_card');
    const seatCard = document.getElementById('seat_card');

    /* Baggage adds on */

    baggageButtons.forEach((bButton) => {
        bButton.addEventListener('click', function() {
            // Get the associated checkbox using the data-target attribute of the clicked button
            const targetCheckboxId = bButton.getAttribute('data-target-checkbox');
            const targetCheckbox = document.getElementById(targetCheckboxId);

            if (targetCheckbox) {
                // Toggle the state of the associated checkbox
                targetCheckbox.checked = !targetCheckbox.checked;

                // Get the associated div using the data-target attribute of the clicked button
                const targetDivId = bButton.getAttribute('data-target');
                const targetDiv = document.getElementById(targetDivId);

                if (targetCheckbox.checked) {
                    // console.log('checked');
                    bButton.textContent = 'ADDED ✓';
                    if (targetDiv) {
                        targetDiv.style.display = 'block';
                    }
                } else {
                    // console.log('unchecked');
                    bButton.textContent = 'ADD';
                    if (targetDiv) {
                        targetDiv.style.display = 'none';
                    }
                }
            }
        });
    });


    /* Seat seletion */

    seatButtons.forEach((sButton) => {
        sButton.addEventListener('click', function() {
            // Get the associated checkbox using the data-target attribute of the clicked button
            const targetCheckboxId = sButton.getAttribute('data-target-checkbox');
            const targetCheckbox = document.getElementById(targetCheckboxId);

            if (targetCheckbox) {
                // Toggle the state of the associated checkbox
                targetCheckbox.checked = !targetCheckbox.checked;

                // Get the associated div using the data-target attribute of the clicked button
                const targetDivId = sButton.getAttribute('data-target');
                const targetDiv = document.getElementById(targetDivId);

                if (targetCheckbox.checked) {
                    // console.log('checked');
                    sButton.textContent = 'ADDED ✓';
                    if (targetDiv) {
                        targetDiv.style.display = 'block';
                    }
                } else {
                    // console.log('unchecked');
                    sButton.textContent = 'ADD';
                    if (targetDiv) {
                        targetDiv.style.display = 'none';
                    }
                }
            }
        });
    });
</script>
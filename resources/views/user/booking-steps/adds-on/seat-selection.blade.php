<div id="seat_card-{{ $i }}" class="card py-4 mt-4 mx-auto rounded-1 container" style="display: none;">
    <h2 class="pb-4">Seat Selection</h2>

    <div class="row parent">
        <!-- Legends (Left Side) -->
        <div class="col-md-3 legend mx-auto">
            <h5>Guide to selection seat</h5>
            <div class="card mb-2 rounded-2 bg-yellow">
                <div class="card-body">
                    <span>Premium Seat</span>
                    <p>PHP 390.00</p>
                </div>
            </div>
            <div class="card mb-2 rounded-2 bg-blue">
                <div class="card-body">
                    <span>Standard Plus Seat</span>
                    <p>PHP 245.00</p>
                </div>
            </div>
            <div class="card mb-2 rounded-2 bg-gray">
                <div class="card-body">
                    <span>Standard Seat</span>
                    <p>PHP 200.00</p>
                </div>
            </div>
        </div>

        <!-- Seat Selection (Right Side) -->
        <div class="col-md-9 seats">
            @foreach(array_chunk($seats, 6) as $index => $chunk)
            <div class="row">
                @foreach($chunk as $seat)
                <div class="col-md-2 mx-auto">
                    <label for="{{ $seat }}{{ $i }}"
                        class="card mb-2 rounded-2 seat-card {{ $index % 4 == 0 ? 'bg-yellow' : ($index % 4 == 1 ? 'bg-blue' : ($index % 4 == 2 || $index % 4 == 3 ? 'bg-gray' : 'bg-blue')) }}">
                        <div class="card-body">
                            <input value="{{ $seat }}" name="seat[]" type="checkbox" id="{{ $seat }}{{ $i }}" {{
                                in_array($seat, $acquiredSeats) ? 'checked' : '' }} {{ in_array($seat, $acquiredSeats)
                                ? 'disabled' : '' }}>


                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="user-placeholder w-3 h-3">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                    clip-rule="evenodd" />
                            </svg>


                            {{-- <span class="user-placeholder" aria-hidden="true">&#x1F464;</span> --}}
                            <span>{{ $seat }}</span>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .bg-yellow {
        background: #FAFF00;
    }

    .bg-blue {
        background: #00A3FF;
    }

    .bg-gray {
        background: #D9D9D9;
    }

    .seat-card {
        height: 70px;
        width: 100px;
        /* Adjust the height as needed */
        position: relative;
    }

    .seat-card input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .user-placeholder {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 3rem;
        /* Adjust the font size as needed */
        color: #000000;
        /* Default color */
    }

    .seat-card input:checked+.user-placeholder {
        display: block;
        color: #00f !important;
        /* Change color when checked */
    }
</style>
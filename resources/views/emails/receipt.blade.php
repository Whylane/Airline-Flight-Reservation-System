<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: "Lato", sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            align-content: justify;
        }

        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #007bff;
            border-radius: 5px;
        }

        .navbar {
            text-align: center;
            background-color: #007bff;
            padding: 10px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .brand-letter {
            font-size: 1.6em;
            font-weight: bold;
        }

        .brand-letter-a {
            color: #faff00;
        }

        .brand-letter-f {
            color: #ffffff;
        }

        .brand-letter-r {
            color: #faff00;
        }

        .brand-letter-s {
            color: #ffffff;
        }

        /* Add styles for the receipt heading */
        .receipt-heading {
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .content {
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .receipt-heading .head {
            display: flex;
            align-items: center;
            margin: 12px 0;
            font-weight: bold;
        }

        .receipt-heading p {
            padding-left: 10 px;
        }

        /* Add styles for the two-column layout */
        .receipt-heading .columns {
            display: flex;
            justify-content: space-between;
        }

        .receipt-heading .column {
            width: 48%;
            /* Adjust the width as needed */
        }

        .receipt-heading .column .title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .check-icon {
            fill: #00ff00;
            /* Change the color as needed */
            margin-right: 10px;
            width: 24px;
            /* Adjust the size as needed */
            height: 24px;
        }

        /* Add styles for the two-column layout */
        .columns {
            display: flex;
            justify-content: space-between;
            margin: 16px;
        }

        .column {
            width: 48%;
            /* Adjust the width as needed */
        }

        .title {
            font-weight: bold;
        }

        .dep_arr {
            color: blue;
        }

        .dep_arr_child {
            margin-top: 3px;
        }

        .row2 {
            margin-top: 16px;
        }

        .dep_arr_tit {
            font-weight: bold;
        }

        .three-columns {
            display: flex;
            justify-content: space-between;
        }

        .three-column {
            width: 30%;
            /* Adjust the width as needed */
        }

        .bold {
            font-weight: bold;
        }

        .gray {
            color: gray;
        }
    </style>
</head>

<body>
    {{-- {{ $data["name"] }} --}}
    <div class="container">
        <div class="navbar">
            <span class="brand-letter brand-letter-a">A</span>
            <span class="brand-letter brand-letter-f">F</span>
            <span class="brand-letter brand-letter-r">R</span>
            <span class="brand-letter brand-letter-s">S</span>
        </div>
        <div class="receipt-heading">
            <div>
                <div class="head">
                    <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.41 1.41L9 18 21 6l-1.41-1.41L9 16.17z" />
                    </svg>
                    Confirmed
                </div>
                <p>Your transaction was successful. See you on board!</p>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="title">Booking Date</div>
                    {{ $data["booking_date"] }}
                </div>
                <div class="column">
                    <div class="title">Booking Reference No.</div>
                    {{ $data["booking_id"] }}
                </div>
            </div>
        </div>
        <div style="font-size: 16px; line-height: 1.6; padding: 10px">
            <div class="title">Flight Details</div>
            <div class="content">
                <div class="columns">
                    <div class="column">
                        <div class="row1">
                            <div class="dep_arr">{{ $data["origin_code"] }} - {{ $data["destination_code"] }}</div>
                            <div class="dep_arr_child">
                                {{ $data["departure_date"] }}
                            </div>
                            <div class="dep_arr_child">{{ $data["departureTime"] }}</div>
                        </div>
                        <div class="row2">
                            <div>{{ $data["arrival_date"] }}</div>
                            <div>{{ $data["arrivalTime"] }}</div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="row1">
                            <div class="dep_arr_tit">Departure</div>
                            <div>{{ $data["originAirportLocation"] }} - {{ $data["originAirportName"] }}</div>
                        </div>
                        <div class="row2">
                            <div class="dep_arr_tit">Arrival</div>
                            <div>{{ $data["destinationAirportLocation"] }} - {{ $data["destinationAirportName"] }}</div>
                        </div>
                    </div>
                </div>
                @if ($data["flightType"] === 'round_trip')

                <div class="columns">
                    <div class="column">
                        <div class="row1">
                            <div class="dep_arr"> {{ $data["destination_code"] }} - {{ $data["origin_code"] }}</div>
                            <div class="dep_arr_child">{{ $data["departure_date_return"] }}</div>
                            <div class="dep_arr_child">{{ $data["departureTimeReturn"] }}</div>
                        </div>
                        <div class="row2">
                            <div>{{ $data["arrival_date_return"] }}</div>
                            <div>{{ $data["arrivalTimeReturn"] }}</div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="row1">
                            <div class="dep_arr_tit">Departure</div>
                            <div>{{ $data["destinationAirportLocation"] }} - {{ $data["destinationAirportName"] }}</div>
                        </div>
                        <div class="row2">
                            <div class="dep_arr_tit">Arrival</div>
                            <div>{{ $data["originAirportLocation"] }} - {{ $data["originAirportName"] }}</div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
            <div class="three-columns content">
                <div class="three-column">
                    <p>Flight Operated by:</p>
                </div>
                <div class="three-column">
                    <!-- Second three-column content goes here -->
                    <p>{{ $data["originAirportName"] }}</p>
                </div>
                <div class="three-column">
                    <!-- Third column content goes here -->
                    <p>{{ $data["destinationAirportName"] }}</p>
                </div>
            </div>
            <div>
                <div class="title">Guest Details</div>
                @for ($i = 1; $i <= $data["numberofPassengers"]; $i++) <div class="three-columns">
                    <div class="three-column">
                        <div class="gray bold">Name</div>
                        <div class="bold">{{ $data["firstNames"][$i - 1] }} {{ $data["lastNames"][$i - 1] }}</div>
                    </div>
                    <div class="three-column">
                        <div class="gray bold">Flight</div>
                        <div class="bold">{{ $data["origin_code"] }} - {{ $data["destination_code"] }}</div>
                    </div>
            </div>
            @endfor

        </div>
    </div>
    </div>
</body>

</html>
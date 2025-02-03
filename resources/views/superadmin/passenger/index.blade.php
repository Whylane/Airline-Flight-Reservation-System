@extends('layouts.superadmin')
@section('title', 'Passenger Lists')
@section('content')
<!-- Passenger Lists Start -->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Passenger Lists</h1>
    <ol class="breadcrumb">
      {{-- <li class="breadcrumb-item"><a href="./">Home</a></li> --}}
      <li class="breadcrumb-item">Passengers</li>
      <li class="breadcrumb-item active" aria-current="page">Passenger Lists</li>
    </ol>
  </div>
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Flight Number</th>
                        <th>Name</th>
                        <th>Ticket Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($tickets as $ticket)
                      @php
                          $seat_prices = [];
                          $numberofPassengers = $ticket->adultPassengers + $ticket->childPassengers + $ticket->infantPassengers;
                          $baggage_array = explode('|', $ticket->adds_on_baggage);
                          $baggage_sum = array_sum($baggage_array);
                      @endphp
  
                      @for ($i = 1; $i <= $numberofPassengers; $i++)
                          @php
                              $seat = explode('|', $ticket->seat);
                          @endphp
  
                          @if (in_array($seat[$i - 1], ["A1", "A2", "A3", "A4", "A5", "A6"]))
                              @php
                                  $seat_prices[] = 390;
                              @endphp
                          @elseif (in_array($seat[$i - 1], ["B1", "B2", "B3", "B4", "B5", "B6"]))
                              @php
                                  $seat_prices[] = 245;
                              @endphpz
                          @else
                              @php
                                  $seat_prices[] = 200;
                              @endphp
                          @endif
                      @endfor
  
                      @php
                          $total_seat_price = array_sum($seat_prices);
                      @endphp
  
                      <tr>
                        {{-- <pre>
                          {{ print_r($ticket->toArray(), true) }}
                      </pre> --}}
                          <td>{{ $ticket->flight_number }}</td>
                          <td>{{ $ticket->last_name }} , {{ $ticket->first_name }} {{ $ticket->middle_initial }}</td>
                          <td>₱{{ $ticket->price * $numberofPassengers + $baggage_sum + $total_seat_price }}</td>
                          <td>{{ $ticket->status == '0' ? 'Pending' : ($ticket->status == '1' ? 'Approved' : 'Canceled') }}</td>
                          <td>
                              <a href="{{ url('superadmin/view-details/'.$ticket->id) }}" class="btn btn-primary btn-sm">Details</a>
                          </td>
                      </tr>
                     @endforeach
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
</div>
<!-- Passenger lists End -->
@endsection

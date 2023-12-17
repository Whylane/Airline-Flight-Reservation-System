<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'flight_type',
        'airline',
        'airline_id',
        'flight_number',
        'departure_date',
        'arrival_date',
        'duration',
        'price',
        'status',
        'adultPassengers',
        'childPassengers',
        'infantPassengers',
        'originAirportCode',
        'destinationAirportCode',
        'destinationAirportLocation',
        'originAirportName',
        'destinationAirportName',
        'originAirportLocation',
        'departureTime',
        'arrivalTime',
        'seat',
        'last_name',
        'first_name',
        'middle_initial',
        'contact_number',
        'address',
        'date_of_birth',
        'pwd',
        'special_asssitance',
        'adds_on_baggage',
        'seatClass',
        'gate',
        'ticket_id',
        'booking_id',
        'special_assistance_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline_id');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('flight_type')->nullable();
            $table->string('airline')->nullable();
            $table->string('flight_number')->nullable();
            $table->string('arrival_date')->nullable();
            $table->string('departure_date')->nullable();
            $table->string('duration')->nullable();
            $table->string('price')->nullable();
            $table->string('adultPassengers')->nullable();
            $table->string('childPassengers')->nullable();
            $table->string('infantPassengers')->nullable();
            $table->string('originAirportCode')->nullable();
            $table->string('destinationAirportCode')->nullable();
            $table->string('destinationAirportLocation')->nullable();
            $table->string('originAirportName')->nullable();
            $table->string('destinationAirportName')->nullable();
            $table->string('originAirportLocation')->nullable();
            $table->string('departureTime')->nullable();
            $table->string('arrivalTime')->nullable();
            $table->string('seat')->nullable(); //  random if no adds on
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_initial')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('pwd')->nullable();
            $table->string('special_asssitance')->nullable();
            $table->string('adds_on_baggage')->nullable();
            $table->string('status')->default(0);
            $table->string('seatClass')->nullable();
            $table->string('gate')->nullable();
            $table->string('ticket_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

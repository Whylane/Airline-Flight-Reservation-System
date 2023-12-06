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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->enum('flight_type', ['one_way', 'round_trip'])->default('one_way');
            $table->string('origin_id');
            $table->string('destination_id');
            $table->date('departure_date');
            $table->date('arrival_date');
            $table->time('departure_time')->default(now()->format('H:i'));
            $table->time('arrival_time')->default(now()->format('H:i'));
            // return
            $table->date('departure_date_return')->nullable();
            $table->date('arrival_date_return')->nullable();
            $table->time('departure_time_return')->nullable();
            $table->time('arrival_time_return')->nullable();
            $table->string('duration');
            $table->string('flight_number')->nullable();
            $table->string('return_flight_number')->nullable();
            $table->string('price');
            $table->foreignId('airline_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};

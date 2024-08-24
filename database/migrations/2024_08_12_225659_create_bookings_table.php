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
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('check_in'); // Use date type for check-in date
            $table->date('check_out'); // Use date type for check-out date
            $table->integer('days'); // Integer for number of days
            $table->integer('price'); // Decimal for price with 2 decimal places
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('apartment_id')->constrained('apartments');
            $table->foreignId('hotel_id')->constrained('hotels');
            $table->string('booking_status')->default('pending');
            $table->string('payment_status')->default('pending');
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

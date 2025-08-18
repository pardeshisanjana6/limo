<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade'); 

            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_address')->nullable();
            $table->string('customer_mobile')->nullable();

            $table->date('pickup_date');
            $table->date('dropoff_date');
            $table->time('pickup_time');
            $table->decimal('total_amount', 10, 2); 
            $table->string('status')->default('pending'); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

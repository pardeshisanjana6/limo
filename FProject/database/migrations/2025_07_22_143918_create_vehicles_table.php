<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_title');
            $table->unsignedBigInteger('brand_id'); // Foreign key to brands table
            $table->text('vehicle_overview');
            $table->decimal('price_per_day', 8, 2);
            $table->string('fuel_type');
            $table->integer('model_year');
            $table->integer('seating_capacity');
            $table->string('image_path')->nullable(); // Path to the uploaded image
            $table->json('accessories')->nullable(); // Store accessories as JSON
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
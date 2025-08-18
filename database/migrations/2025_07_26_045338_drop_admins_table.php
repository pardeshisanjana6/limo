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
        Schema::dropIfExists('admins'); // <-- THIS IS THE CRITICAL LINE
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // If you need to rollback this particular migration, Laravel would attempt to recreate the table.
        // You would place the original 'create_admins_table' schema here if you intended to allow rollback.
        // For a simple table drop where you don't intend to recreate it, you can leave it empty or comment it out.
        // Example if you wanted to recreate it on rollback:
        /*
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
        */
    }
};
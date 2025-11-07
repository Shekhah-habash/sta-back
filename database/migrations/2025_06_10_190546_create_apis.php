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
        Schema::create('apis', function (Blueprint $table) {
            $table->id();
            $table->string('service_timetable_url',1000); // return schedule for certain services - pass service identifier
            $table->string('service_available_url',1000); // return true with price if sevice availbale or false - pass service identifier/start_date/end_date/quantity
            $table->string('service_book_url',1000); // return true if booking ok &  booking details pass service identifier - quantity
            $table->foreignId('provider_id')->unique()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apis');
    }
};

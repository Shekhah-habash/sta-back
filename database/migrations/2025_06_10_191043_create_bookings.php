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
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('quantity' )->default(1);            
            $table->decimal('price', 10, 2);
            
            $table->json('booking_details')->nullable();
            $table->json('booking_response')->nullable();
            $table->string('note' , 1000)->nullable();
            

            $table->enum('status', [ 'accepted' , 'canceled' ])->default('accepted');
            
            $table->enum('evaluate', [1, 2, 3, 4, 5])->nullable();
            $table->foreignId('service_id')->constrained();
            $table->foreignId('tourist_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_requests');
    }
};

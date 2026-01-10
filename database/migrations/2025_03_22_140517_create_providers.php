<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->index();
            $table->string('title', 100)->index();
            $table->string('description', 500)->nullable();;
        
            $table->boolean('accepted')->default(false);
            
            $table->foreignId('province_id')->constrained();
            $table->foreignId('user_id')->unique()->constrained();
            $table->foreignId('image_id')->nullable()->constrained()->onDelete('set null');;
            
            $table->timestamps();
        });
        DB::statement("ALTER TABLE providers ADD location POINT after accepted");
        // Add spatial index to the location column for faster geospatial queries
        // Schema::table('providers', function (Blueprint $table) {
        //     $table->spatialIndex('location');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};

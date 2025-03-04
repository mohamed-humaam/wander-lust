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
        Schema::create('amenity_link_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('amenity_id')->references('id')->on('amenities')->onDelete('cascade');
            $table->foreignUlid('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignUlid('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->foreignUlid('location_id')->references('id')->on('locations')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenity_link_pivots');
    }
};

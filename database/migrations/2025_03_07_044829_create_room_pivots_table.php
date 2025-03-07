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
        Schema::create('room_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('room_id')->references('id')->on('rooms')->cascadeOnDelete();
            $table->foreignUlid('package_id')->references('id')->on('packages')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_pivots');
    }
};

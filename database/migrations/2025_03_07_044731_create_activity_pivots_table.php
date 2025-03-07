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
        Schema::create('activity_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('activity_id')->references('id')->on('activities')->cascadeOnDelete();
            $table->foreignUlid('package_id')->references('id')->on('packages')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_pivots');
    }
};

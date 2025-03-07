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
        Schema::create('feature_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('feature_id')->references('id')->on('features')->cascadeOnDelete();
            $table->foreignUlid('package_id')->references('id')->on('packages')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_pivots');
    }
};

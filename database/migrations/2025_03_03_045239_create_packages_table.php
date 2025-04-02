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
        Schema::create('packages', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->json('images')->nullable();
            $table->json('gallery')->nullable();
            $table->foreignUlid('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreignUlid('location_id')->references('id')->on('locations')->cascadeOnDelete();
            $table->json('description')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->integer('duration')->nullable()->default(0);
            $table->integer('max_guests')->nullable()->default(0);
            $table->integer('min_age')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

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
        Schema::table('room_links', function (Blueprint $table) {
            $table->ulid('amenity_id')->nullable();
            $table->ulid('activity_id')->nullable();
            $table->ulid('feature_id')->nullable();
        });

        Schema::table('room_links', function (Blueprint $table) {
            $table->foreign('amenity_id')->references('id')->on('amenities')->cascadeOnDelete();
            $table->foreign('activity_id')->references('id')->on('activities')->cascadeOnDelete();
            $table->foreign('feature_id')->references('id')->on('features')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('room_links', function (Blueprint $table) {
            $table->dropColumn(['amenity_id']);
            $table->dropColumn(['activity_id']);
            $table->dropColumn(['feature_id']);
        });
    }
};

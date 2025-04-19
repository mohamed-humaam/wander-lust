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
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('size');
            $table->dropColumn('price');
            $table->decimal('price_per_night',  8, 2)->default(0)->after('description');
            $table->integer('capacity')->default(0)->after('price_per_night');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->decimal('size', 8, 2)->default(0);
            $table->decimal('price', 8, 2)->default(0);
            $table->dropColumn('price_per_night');
            $table->dropColumn('capacity');
        });
    }
};

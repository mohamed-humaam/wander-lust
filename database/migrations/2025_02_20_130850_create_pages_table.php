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
        Schema::create('pages', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('order')->default(0)->nullable();
            $table->boolean('show_in_nav')->default(true);
            $table->boolean('accessible')->default(true);
            $table->timestamps();

            $table->foreignUlid('parent_id')->nullable()->references('id')->on('pages')->onDelete('cascade');

            $table->index(['parent_id', 'order']);
            $table->index('show_in_nav');
            $table->index('accessible');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};

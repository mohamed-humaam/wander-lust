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
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('footer_logo_path')->nullable();
            $table->text('company_description')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();

            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();

            $table->string('copyright_text')->nullable();
            $table->boolean('show_newsletter_signup')->default(false);
            $table->string('newsletter_title')->nullable();
            $table->string('newsletter_description')->nullable();

            $table->string('quick_links_title')->default('Quick Links');
            $table->boolean('show_quick_links')->default(true);

            $table->integer('columns_count')->default(4);
            $table->boolean('show_social_icons')->default(true);
            $table->boolean('show_payment_icons')->default(false);

            $table->json('accepted_payment_methods')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};

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
        Schema::create('actualites', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('chapo')->nullable();
            $table->longText('content');
            $table->foreignId('featured_media_id')->nullable()->constrained('media_items')->onDelete('set null');
            $table->enum('media_type', ['image', 'video'])->nullable();
            $table->string('status')->default('draft');
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            $table->json('tags')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actualites');
    }
};

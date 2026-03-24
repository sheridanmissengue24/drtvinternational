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
        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['video', 'podcast', 'live', 'radio', 'image']);
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('poster_path')->nullable();
            $table->string('duration')->nullable();
            $table->string('mime')->nullable(); 
            $table->string('status')->default('draft');
            $table->string('visibility')->default('public');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_items');
    }
};

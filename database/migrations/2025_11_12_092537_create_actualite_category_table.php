<?php
// filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/database/migrations/2026_03_22_000003_create_actualite_category_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('actualite_category', function (Blueprint $table) {
            $table->foreignId('actualite_id')->constrained('actualites')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->primary(['actualite_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actualite_category');
    }
};
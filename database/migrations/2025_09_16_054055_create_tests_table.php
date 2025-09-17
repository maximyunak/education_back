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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->integer('max_attempts');
            $table->integer('passing_score');
            $table->integer('duration');
            $table->integer('popularity_count')->default(0);

            $table->enum('status', ['DRAFT', 'PUBLISHED', 'ARCHIVED'])->default('PUBLISHED');
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('theme_id')->constrained('themes')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};

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
        // コーステーブル
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->tinyInteger('difficulty_level')->default(1);
            $table->integer('total_lessons')->default(0);
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
            
            $table->index('slug');
        });

        // レッスンテーブル
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->integer('lesson_number');
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->string('route_name')->nullable();
            $table->string('exercise_route_name')->nullable();
            $table->timestamps();
            
            $table->unique(['course_id', 'lesson_number']);
            $table->index('course_id');
        });

        // 進捗テーブル
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'lesson_id']);
            $table->index(['user_id', 'is_completed']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_progress');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('courses');
    }
};

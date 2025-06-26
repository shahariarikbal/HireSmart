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
        Schema::create('job_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('employer_id');
            $table->string('title');
            $table->string('image')->nullable()->comment('job listing image');
            $table->text('description');
            $table->string('location');
            $table->enum('job_type', ['full_time', 'remote', 'part_time', 'contract', 'temporary', 'internship'])->default('full_time');
            $table->enum('experience_level', ['entry_level', 'mid_level', 'senior_level', 'executive'])->default('entry_level');
            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_lists');
    }
};

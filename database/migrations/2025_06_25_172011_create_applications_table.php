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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('candidate id');
            $table->foreignId('job_list_id')->constrained('job_lists')->onDelete('cascade')->comment('job list id');
            $table->text('cover_letter')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending')->comment('application status');
            $table->timestamp('applied_at')->useCurrent()->comment('application submission time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};

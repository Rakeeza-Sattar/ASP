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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_id')->constrained()->onDelete('cascade');
            $table->foreignId('assigned_officer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->datetime('scheduled_at');
            $table->datetime('completed_at')->nullable();
            $table->enum('status', ['scheduled', 'confirmed', 'in_progress', 'completed', 'cancelled', 'no_show'])->default('scheduled');
            $table->text('special_instructions')->nullable();
            $table->text('officer_notes')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->timestamps();

            $table->index(['scheduled_at', 'status']);
            $table->index(['assigned_officer_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

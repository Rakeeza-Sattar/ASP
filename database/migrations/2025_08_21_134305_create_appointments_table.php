<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_id')->constrained()->onDelete('cascade');
            $table->foreignId('officer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->dateTime('scheduled_at');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled', 'rescheduled'])
                ->default('scheduled');
            $table->text('special_instructions')->nullable();
            $table->text('officer_notes')->nullable();
            $table->decimal('estimated_duration', 3, 1)->default(2.0); // hours
            $table->json('preparation_checklist')->nullable();
            $table->timestamps();

            $table->index(['officer_id', 'scheduled_at']);
            $table->index(['status', 'scheduled_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
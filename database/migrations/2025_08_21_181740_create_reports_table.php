<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_id')->constrained()->onDelete('cascade');
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            $table->foreignId('generated_by')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['audit', 'incident', 'inventory']);
            $table->string('report_number')->unique();
            $table->text('summary');
            $table->decimal('total_estimated_value', 12, 2)->default(0);
            $table->integer('total_items_count')->default(0);
            $table->string('pdf_path')->nullable();
            $table->json('homeowner_signature')->nullable();
            $table->json('officer_signature')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();

            $table->index(['home_id', 'type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
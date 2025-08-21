<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('title_monitoring', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_id')->constrained()->onDelete('cascade');
            $table->string('provider')->default('internal');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('inactive');
            $table->timestamp('last_check_at')->nullable();
            $table->timestamp('next_check_at')->nullable();
            $table->json('alerts')->nullable();
            $table->integer('alert_count')->default(0);
            $table->text('monitoring_notes')->nullable();
            $table->timestamps();

            $table->index(['status', 'next_check_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('title_monitoring');
    }
};
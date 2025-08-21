<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_id')->constrained()->onDelete('cascade');
            $table->foreignId('documented_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('category');
            $table->string('description');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->decimal('estimated_value', 10, 2);
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('condition')->default('good');
            $table->string('location_in_home')->nullable();
            $table->text('notes')->nullable();
            $table->json('custom_fields')->nullable();
            $table->timestamps();

            $table->index(['home_id', 'category']);
            $table->index('serial_number');
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
};

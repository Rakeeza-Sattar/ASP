<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('item_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['photo', 'receipt', 'warranty', 'appraisal', 'other']);
            $table->string('filename');
            $table->string('original_name');
            $table->string('mime_type');
            $table->bigInteger('file_size');
            $table->string('storage_path');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['item_id', 'type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_files');
    }
};
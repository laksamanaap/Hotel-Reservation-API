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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('rooms_id');
            $table->integer('capacity');
            $table->double('price');
            $table->longText('facilities');
            // $table->integer('rooms_number');
            $table->unsignedBigInteger('categories_id')->references('categories_id')->on('categories');
            $table->unsignedBigInteger('room_status_id')->references('room_status_id')->on('room_statuses')->default('1');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

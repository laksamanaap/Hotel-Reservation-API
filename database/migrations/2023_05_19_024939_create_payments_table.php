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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->dateTime('date');
            $table->unsignedBigInteger('rooms_id')->references('rooms_id')->on('rooms');
            $table->unsignedBigInteger('hotel_id')->references('hotel_id')->on('hotels');
            $table->unsignedBigInteger('payment_type_id')->references('payment_type_id')->on('payments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

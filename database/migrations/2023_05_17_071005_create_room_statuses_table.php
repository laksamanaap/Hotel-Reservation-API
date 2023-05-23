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
        Schema::create('room_statuses', function (Blueprint $table) {
            $table->id('rooms_id')->references('rooms_id')->on('rooms');
            $table->unsignedBigInteger('hotel_id')->references('hotel_id')->on('hotels');
            $table->unsignedBigInteger('room_status_id');
            $table->string('room_status');
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('room_statuses', function (Blueprint $table) {
            $table->dropColumn('hotel_id');
        });
    }
};

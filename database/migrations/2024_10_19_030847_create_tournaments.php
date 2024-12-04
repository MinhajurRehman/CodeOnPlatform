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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('t_email');
            $table->unsignedBigInteger('organizer_id');
            $table->string('t_name');
            $table->string('t_poster_image');
            $table->string('t_date_time');
            $table->string('t_board_time');
            $table->string('t_end_date_time');
            $table->string('t_Plang');
            $table->string('t_description');
            $table->string('Status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
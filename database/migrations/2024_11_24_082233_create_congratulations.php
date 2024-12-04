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
        Schema::create('congratulations', function (Blueprint $table) {
            $table->id();
            $table->string('announced_tname');
            $table->string('winner_name');
            $table->string('winner_points');
            $table->string('Text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('congratulations');
    }
};
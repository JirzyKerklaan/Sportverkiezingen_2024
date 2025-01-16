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
        Schema::create('vote_progress', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->enum('vote-cat1_status', ['pending', 'completed', 'null'])->default('pending');
            $table->enum('vote-cat2_status', ['pending', 'completed', 'null'])->default('pending');
            $table->enum('vote-cat3_status', ['pending', 'completed', 'null'])->default('pending');
            $table->string('token')->unique();
            $table->string('voter_uuid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vote_progress');
    }
};

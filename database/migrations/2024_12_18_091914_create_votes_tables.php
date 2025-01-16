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
        Schema::create('vote-cat1', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('voted_person')->nullable();
            $table->string('voted_sport')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('token')->unique();
            $table->string('voter_uuid')->unique();
            $table->string('expires_at');
            $table->string('created_at');
            $table->string('verified_at')->nullable();
        });

        Schema::create('vote-cat2', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('voted_person')->nullable();
            $table->string('voted_sport')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('token')->unique();
            $table->string('voter_uuid')->unique();
            $table->string('expires_at');
            $table->string('created_at');
            $table->string('verified_at')->nullable();
        });

        Schema::create('vote-cat3', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('voted_person')->nullable();
            $table->string('voted_sport')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('token')->unique();
            $table->string('voter_uuid')->unique();
            $table->string('expires_at');
            $table->string('created_at');
            $table->string('verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vote-cat1');
        Schema::dropIfExists('vote-cat2');
        Schema::dropIfExists('vote-cat3');
    }
};

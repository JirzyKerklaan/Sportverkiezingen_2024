<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sub-cat1', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('sportperson');
            $table->string('sportperson_sport');
            $table->string('sportperson_uuid')->unique();
            $table->string('submissions')->integer()->default(1);
            $table->timestamps();
        });

        Schema::create('sub-cat2', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('sportperson');
            $table->string('sportperson_sport');
            $table->string('sportperson_uuid')->unique();
            $table->string('submissions')->integer()->default(1);
            $table->timestamps();
        });

        Schema::create('sub-cat3', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('sportperson');
            $table->string('sportperson_sport');
            $table->string('sportperson_uuid')->unique();
            $table->string('submissions')->integer()->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub-cat1');
        Schema::dropIfExists('sub-cat2');
        Schema::dropIfExists('sub-cat3');
    }
};

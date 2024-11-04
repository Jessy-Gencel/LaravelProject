<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTowersTable extends Migration
{
    public function up()
    {
        Schema::create('towers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('damage');
            $table->integer('hitpoints');           
            $table->integer('fire_rate');           
            $table->integer('price');
            $table->float('rotation_angle')->default(0);
            $table->string('sprite_image');
            $table->string('projectile_image');
            $table->float('range')->nullable();
            $table->float('projectile_speed')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('towers');
    }
}

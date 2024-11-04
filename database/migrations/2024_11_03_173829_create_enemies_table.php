<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnemiesTable extends Migration
{
    public function up()
    {
        Schema::create('enemies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('health');
            $table->float('speed');
            $table->integer('damage');
            $table->integer('score');
            $table->string('sprite')->nullable();
            $table->string('sound')->nullable();
            $table->string('projectile_sprite')->nullable();
            $table->string('projectile_sound')->nullable();
            $table->float('projectile_speed')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('enemies');
    }
}

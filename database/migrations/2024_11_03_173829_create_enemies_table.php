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
            $table->string('type');
            $table->string('name');
            $table->integer('health');
            $table->float('speed');
            $table->integer('damage');
            $table->integer('score');
            $table->float('attack_speed');
            $table->string('sprite')->nullable();
            $table->string('sound')->nullable();
            $table->string('projectile_sprite')->nullable();
            $table->string('projectile_sound')->nullable();
            $table->float('projectile_speed')->nullable();
            $table->float('range')->nullable();
            $table->integer('fire_rate')->nullable();
            $table->integer('heal_amount')->nullable();
            $table->float('heal_rate')->nullable();
            $table->float('heal_range')->nullable();
            $table->float('barrier_health')->nullable();
            $table->float('barrier_cooldown') ->nullable();
            $table->float('barrier_regen') ->nullable();
            $table->float('barrier_regen_cooldown') ->nullable();
            $table->integer('barrier_radius') ->nullable();
            $table->float('spawn_rate') ->nullable();
            $table->float('cloak_duration') ->nullable();
            $table->float('cloak_radius') ->nullable();
            $table->float('cloak_cooldown') ->nullable();
            $table->boolean('timer_based') ->nullable();
            $table->boolean('proximity_based') ->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('enemies');
    }
}

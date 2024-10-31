<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('content');
            $table->timestamps(); // This will add `created_at` and `updated_at` columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('news');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->index();
            $table->string('title');
            $table->text('description');
            $table->string('thumbnail')->nullable();
            $table->timestamp('published_at');
            $table->timestamps();
        });
    }
};

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->unsignedBigInteger('featured_image')->nullable();
            $table->unsignedInteger('author');
            $table->timestamps();
            $table->foreign('featured_image')->references('id')->on('media')->onDelete('SET NULL');
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

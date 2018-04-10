<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigables', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('method', ['GET', 'POST', 'PATCH', 'PUT', 'DELETE'])->default('GET');
            $table->string('route');
            $table->longText('template')->nullable();
            $table->string('controller')->nullable();
            $table->json('settings')->nullable();
            $table->boolean('active')->default(true);
            $table->string('privileges', '512')->nullable();
            $table->string('middleware', '512')->nullable();
            $table->enum('usage', ['WEB', 'API'])->default('WEB');
            $table->unsignedInteger('priority')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navigable');
    }
}

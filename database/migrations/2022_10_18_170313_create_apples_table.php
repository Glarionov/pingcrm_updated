<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('apples');
        Schema::create('apples', function (Blueprint $table) {
            $table->id();
            $table->string('color')->nullable();
            $table->float('size')->nullable();
            $table->float('weight')->nullable();
            $table->boolean('is_eaten')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('quality_id')->nullable();
            $table->foreign('quality_id')->references('id')->on('apple_qualities');
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
        Schema::dropIfExists('apples');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradelistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradelists', function (Blueprint $table) {
          $table->increments('id');
          $table->string('grade');
          $table->integer('qualification_id')->unsigned()->nullable();
          $table->foreign('qualification_id')->references('id')->on('qualifications')->onDelete('cascade');
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
        Schema::dropIfExists('gradelists');
    }
}

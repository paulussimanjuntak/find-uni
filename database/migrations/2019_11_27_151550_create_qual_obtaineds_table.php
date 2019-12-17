<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualObtainedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qual_obtaineds', function (Blueprint $table) {
          $table->increments('id');
          $table->string('overallScore');
          
          $table->integer('application_id')->unsigned()->nullable();
          $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
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
        Schema::dropIfExists('qual_obtaineds');
    }
}

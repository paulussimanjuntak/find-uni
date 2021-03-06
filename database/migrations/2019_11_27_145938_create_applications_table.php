<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
          $table->increments('id');
          $table->string('status');
          
          $table->integer('applicant_id')->unsigned()->nullable();
          $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');
          $table->integer('programme_id')->unsigned()->nullable();
          $table->foreign('programme_id')->references('id')->on('programmes')->onDelete('cascade');
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
        Schema::dropIfExists('applications');
    }
}

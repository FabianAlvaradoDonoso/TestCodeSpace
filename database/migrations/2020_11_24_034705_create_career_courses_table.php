<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareerCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_course', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('career_id');
            $table->foreign('career_id')->references('id')->on('careers');

            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');

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
        Schema::dropIfExists('career_course');   
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('academic_id')->nullable();
            $table->unsignedInteger('grade_id')->nullable();
            $table->unsignedInteger('subject_id')->nullable();
            $table->unsignedInteger('teacher_id')->nullable();
            $table->foreign('academic_id')->references('id')->on('academics')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('set null');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('set null');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_teachers');
    }
}

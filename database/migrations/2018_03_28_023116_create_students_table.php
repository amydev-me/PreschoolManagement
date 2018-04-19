<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('academic_id')->nullable();
            $table->unsignedInteger('grade_id')->nullable();
            $table->mediumText('profile')->nullable();
            $table->string('studentCode', 255)->nullable();
            $table->string('fullName', 500)->nullable();
            $table->string('otherName', 500)->nullable();
            $table->date('join_date')->nullable();
            //Emergency Contact
            $table->string('em_name', 255)->nullable();
            $table->string('em_relation', 255)->nullable();
            $table->string('em_contact', 255)->nullable();

            $table->mediumText('student_live')->nullable();
            $table->foreign('academic_id')->references('id')->on('academics')->onDelete('SET NULL');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('SET NULL');
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
        Schema::dropIfExists('students');
    }
}

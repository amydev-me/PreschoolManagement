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
            $table->unsignedInteger('guardian_id')->nullable();
            $table->unsignedInteger('academic_id')->nullable();
            $table->unsignedInteger('grade_id')->nullable();
            $table->mediumText('profile')->nullable();
            $table->string('studentCode', 255)->nullable();
            $table->string('firstName', 255)->nullable();
            $table->string('lastName', 255)->nullable();
            $table->string('fullName', 255)->nullable();
            $table->date('dateofbirth')->nullable();
            $table->string('gender', 6);
            $table->string('email', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('nrc', 255)->nullable();
            $table->string('nationality', 255)->nullable();
            $table->mediumText('address')->nullable();
            $table->date('join_date')->nullable();
            $table->mediumText('benefit')->nullable();
            $table->mediumText('meal_preferences')->nullable();
            $table->mediumText('allergies')->nullable();
            $table->mediumText('history')->nullable();
            $table->foreign('guardian_id')->references('id')->on('guardians')->onDelete('set null');
            $table->foreign('academic_id')->references('id')->on('academics')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
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

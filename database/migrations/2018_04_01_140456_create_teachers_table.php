<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('profile')->nullable();
            $table->string('teacherCode', 255)->nullable();
            $table->string('firstName', 255)->nullable();
            $table->string('lastName', 255)->nullable();
            $table->string('fullName', 255)->nullable();
            $table->string('gender', 6);
            $table->string('personal_email',255);
            $table->string('nrc', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('nationality', 255)->nullable();
            $table->date('dateofbirth')->nullable();
            $table->mediumText('address')->nullable();
            $table->date('join_date')->nullable();
            $table->string('position', 255)->nullable();
            $table->string('degree', 255)->nullable();
            $table->double('salary')->default(0);
            $table->mediumText('benefit')->nullable();
            $table->mediumText('biography')->nullable();
            $table->string('contactFirstName')->nullable();
            $table->string('contactLastName')->nullable();
            $table->string('contactEmail')->nullable();
            $table->string('contactphone', 255)->nullable();
            $table->string('contactrelation', 255)->nullable();
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
        Schema::dropIfExists('teachers');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPersonalInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_personal_informations', function (Blueprint $table) {
            $table->unsignedInteger('student_id');
            $table->date('dateofbirth')->nullable();
            $table->string('gender', 6);
            $table->string('placeofbirth', 500)->nullable();
            $table->string('nationality', 255)->nullable();
            $table->string('langhome', 500)->nullable();
            $table->string('religion', 255)->nullable();
            $table->primary('student_id');
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_personal_informations');
    }
}

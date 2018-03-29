<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_term', function (Blueprint $table) {
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('term_id');
            $table->primary(['student_id', 'term_id']);
            $table->foreign('student_id')->references('id')->on('students')->onDelete('RESTRICT');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_term');
    }
}

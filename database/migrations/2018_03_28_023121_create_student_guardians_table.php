<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_guardians', function (Blueprint $table) {
            $table->unsignedInteger('student_id');
            $table->string('g_one_name',500)->nullable();
            $table->string('g_one_relation',500)->nullable();
            $table->string('g_one_email',500)->nullable();
            $table->string('g_one_occupation',500)->nullable();
            $table->mediumText('g_one_address')->nullable();
            $table->string('g_one_mobile',255)->nullable();
            $table->string('g_one_home',255)->nullable();
            $table->string('g_one_work',255)->nullable();

            $table->string('g_two_name',500)->nullable();
            $table->string('g_two_relation',500)->nullable();
            $table->string('g_two_email',500)->nullable();
            $table->string('g_two_occupation',500)->nullable();
            $table->mediumText('g_two_address')->nullable();
            $table->string('g_two_mobile',255)->nullable();
            $table->string('g_two_home',255)->nullable();
            $table->string('g_two_work',255)->nullable();
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
        Schema::dropIfExists('student_guardians');
    }
}

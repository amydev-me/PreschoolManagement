<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_backgrounds', function (Blueprint $table) {
            $table->unsignedInteger('student_id');
            $table->string('previous_one', 500)->nullable();
            $table->string('one_date', 255)->nullable();
            $table->mediumText('one_file')->nullable();
            $table->string('previous_two', 500)->nullable();
            $table->string('two_date', 255)->nullable();
            $table->mediumText('two_file')->nullable();
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
        Schema::dropIfExists('student_backgrounds');
    }
}

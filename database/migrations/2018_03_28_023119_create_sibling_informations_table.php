<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiblingInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sibling_informations', function (Blueprint $table) {
            $table->unsignedInteger('student_id');
            $table->string('sb_one_name', 500)->nullable();
            $table->string('sb_one_gender', 6)->nullable();
            $table->string('sb_one_dob',255)->nullable();
            $table->mediumText('sb_one_school')->nullable();

            $table->string('sb_two_name', 500)->nullable();
            $table->string('sb_two_gender', 6)->nullable();
            $table->string('sb_two_dob',255)->nullable();
            $table->mediumText('sb_two_school')->nullable();

            $table->string('sb_three_name', 500)->nullable();
            $table->string('sb_three_gender', 6)->nullable();
            $table->string('sb_three_dob',255)->nullable();
            $table->mediumText('sb_three_school')->nullable();
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
        Schema::dropIfExists('sibling_informations');
    }
}

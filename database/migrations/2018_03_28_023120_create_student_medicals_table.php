<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentMedicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_medicals', function (Blueprint $table) {
            $table->unsignedInteger('student_id');
            $table->boolean('asthma')->default(0);
            $table->mediumText('asthma_remark')->nullable();

            $table->boolean('allergies')->default(0);
            $table->mediumText('allergies_remark')->nullable();

            $table->boolean('diabetes')->default(0);
            $table->mediumText('diabetes_remark')->nullable();

            $table->boolean('epilepsy')->default(0);
            $table->mediumText('epilepsy_remark')->nullable();

            $table->boolean('tuberculosis')->default(0);
            $table->mediumText('tuberculosis_remark')->nullable();

            $table->mediumText('others')->nullable();


            $table->mediumText('medication')->nullable();

            $table->string('immunized',500)->nullable();
                $table->mediumText('immunized_remark')->nullable();
            $table->mediumText('immunized_file')->nullable();

            $table->mediumText('emotional')->nullable();
            $table->mediumText('disabilities')->nullable();
            $table->mediumText('behavioral')->nullable();
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
        Schema::dropIfExists('student_medicals');
    }
}

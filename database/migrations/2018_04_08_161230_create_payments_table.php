<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('grade_id')->nullable();
            $table->unsignedInteger('term_id')->nullable();
            $table->double('amount')->nullable();
            $table->double('receipt_amount')->nullable();
            $table->double('fine')->nullable();
            $table->string('invoice', 255)->nullable();
            $table->date('payment_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('status')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('set null');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('set null');
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
        Schema::dropIfExists('payments');
    }
}

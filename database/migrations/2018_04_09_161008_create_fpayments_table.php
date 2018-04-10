<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_payment', function (Blueprint $table) {
            $table->unsignedInteger('payment_id')->nullable();
            $table->unsignedInteger('fee_id')->nullable();
            $table->double('amount')->default(0);
            $table->primary(['payment_id','fee_id']);
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('fee_id')->references('id')->on('fees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_payment');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName',255)->nullable();
            $table->string('lastName',255)->nullable();
            $table->string('fullName',255)->nullable();
            $table->string('email',50)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('realation',255)->nullable();
            $table->string('occupation',255)->nullable();
            $table->mediumText('address')->nullable();
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
        Schema::dropIfExists('guardians');
    }
}

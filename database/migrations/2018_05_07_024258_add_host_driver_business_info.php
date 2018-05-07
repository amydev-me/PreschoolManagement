<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHostDriverBusinessInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_infos', function (Blueprint $table) {

            $table->string('email_host', 255)->nullable();
            $table->integer('email_port')->default(0);
            $table->string('email_encryption', 255)->nullable();
            $table->string('email_password', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_infos', function (Blueprint $table) {
            //
        });
    }
}

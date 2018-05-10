<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->string('business_type', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->mediumText('address')->nullable();
            $table->string('website', 255)->nullable();
            $table->string('facebook', 500)->nullable();
            $table->string('fax', 255)->nullable();
            $table->string('footer', 255)->nullable();
            $table->mediumText('note')->nullable();
            $table->string('login_text', 500)->nullable();
            $table->string('logo', 500)->nullable();
            $table->string('invoice_logo', 500)->nullable();
            $table->mediumText('instruction')->nullable();

            $table->string('email', 255)->nullable();
            $table->string('email_subject', 500)->nullable();
            $table->string('email_host', 255)->nullable();
            $table->integer('email_port')->default(0);
            $table->string('email_encryption', 255)->nullable();
            $table->string('email_password', 255)->nullable();
            $table->mediumText('email_text')->nullable();

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
        Schema::dropIfExists('business_infos');
    }
}

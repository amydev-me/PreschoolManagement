<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubjectEmailPassInBusinessInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_infos', function (Blueprint $table) {
            $table->string('email_subject', 500)->nullable();
            $table->string('email_password', 255)->nullable();
            $table->mediumText('email_text')->nullable();
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

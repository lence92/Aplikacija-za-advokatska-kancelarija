<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cases', function (Blueprint $table){
            $table->increments('id');
            $table->string('broj_na_predmet');
            $table->string('tuzitel');
            $table->string('tuzen');
            $table->string('osnov');
            $table->integer('vrednost');
            $table->string('sudija');
            $table->string('advokat_dr_strana');
            $table->rememberToken();
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
        //
        Schema::drop('cases');
    }
}

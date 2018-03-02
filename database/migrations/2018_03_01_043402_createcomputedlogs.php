<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createcomputedlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::create('computedlogs', function (Blueprint $table) {
            $table->increments('cnt');
            $table->date('radiodate');
            $table->time('radiotime');
            $table->string('batteryvolt');
            $table->string('wlevel');
            $table->string('rvalue');
            $table->string('site_id');
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
    }
}

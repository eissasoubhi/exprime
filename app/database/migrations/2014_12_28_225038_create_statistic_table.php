<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('statistic', function($table)
		{
		    $table->increments('id');
		    $table->string('city');
		    $table->string('country');
		    $table->string('url');
		    $table->string('flag');
		    $table->timestamp('time');
		    $table->integer('count');
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

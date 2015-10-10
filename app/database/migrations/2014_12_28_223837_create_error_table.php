<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErrorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('error', function($table)
		{
		    $table->increments('id');
		    $table->string('type');
		    $table->tinyInteger('fatal');
		    $table->longText('msg');
		    $table->string('file');
		    $table->string('code');
		    $table->integer('line');
		    $table->string('url');
		    $table->unique(array('file', 'code','line', 'url'));
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

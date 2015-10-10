<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('keyword', function($table)
		{
		    $table->increments('id');
		    $table->string('keyword')->unique();
		    $table->integer('user_id')->unsigned();
		    $table->timestamps();
		    $table->foreign('user_id')
		      ->references('id')->on('user')
		      ->onDelete('cascade');
		});	}

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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('like', function($table)
		{
		    $table->increments('id');
		    $table->integer('user_id')->unsigned();
		    $table->integer('picture_id')->unsigned();
		    $table->unique(array("user_id", "picture_id"));
		    $table->timestamps();
		    $table->foreign('picture_id')
		      ->references('id')->on('picture')
		      ->onDelete('cascade');
		    $table->foreign('user_id')
		      ->references('id')->on('user')
		      ->onDelete('cascade');
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

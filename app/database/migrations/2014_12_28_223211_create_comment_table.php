<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment', function($table)
		{
		    $table->increments('id');
		    $table->integer('user_id')->unsigned();
		    $table->integer('picture_id')->unsigned();
		    $table->longText('content');
		    $table->timestamps();
		    $table->foreign('user_id')
		      ->references('id')->on('user')
		      ->onDelete('cascade');
		    $table->foreign('picture_id')
		      ->references('id')->on('picture')
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

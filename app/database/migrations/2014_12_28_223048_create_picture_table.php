<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePictureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('picture', function($table)
		{
		    $table->increments('id');
		    $table->integer('user_id')->unsigned();
		    $table->string('name');
		    $table->string('size');
		    $table->string('dimension');
		    $table->string('url_origin');
		    $table->string('url_with_txt');
		    $table->dateTime('date_last_modif');
		    $table->integer('validated');
		    $table->timestamps();
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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePictureTextTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('picture_text', function($table)
		{
		    $table->increments('id');
		    $table->integer('picture_id')->unsigned();
		    $table->string('content');
		    $table->string('color');
		    $table->string('font-size');
		    $table->string('font-family');
		    $table->string('x');
		    $table->string('y');
		    $table->timestamps();
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

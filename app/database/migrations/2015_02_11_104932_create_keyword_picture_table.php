<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordPictureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('keyword_picture', function($table)
		{   
			$table->integer('picture_id')->unsigned();
			$table->integer('keyword_id')->unsigned();
			$table->primary(array('keyword_id', 'picture_id'));
		    $table->foreign('picture_id')
		      ->references('id')->on('picture')
		      ->onDelete('cascade');
		    $table->foreign('keyword_id')
		      ->references('id')->on('keyword')
		      ->onDelete('cascade');
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

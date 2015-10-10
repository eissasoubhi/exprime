<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugSuggTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bug_sugg', function($table)
		{
		    $table->increments('id');
		    $table->longText('content');
		    $table->string('type');
		    $table->integer('user_id')->unsigned();
		    $table->string('subject');
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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugSuggCommentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bug_sugg_comment', function($table)
		{
		    $table->increments('id');
		    $table->longText('content');
		    $table->integer('user_id')->unsigned();
		    $table->integer('bug_sugg_id')->unsigned();
		    $table->timestamps();
		    $table->foreign('user_id')
		      ->references('id')->on('user')
		      ->onDelete('cascade');
		    $table->foreign('bug_sugg_id')
		      ->references('id')->on('bug_sugg')
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

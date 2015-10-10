<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permission', function($table)
		{
		    $table->increments('id');
		    $table->integer('role_id')->unsigned();
		    $table->string('name')->unique();
		    $table->timestamps();
		    $table->foreign('role_id')
		      ->references('id')->on('role')
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

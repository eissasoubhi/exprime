<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function($table)
		{
		    $table->increments('id');
		    $table->string('login')->unique();
		    $table->string('password');
		    $table->string('email')->unique();
		    $table->timestamp('last_sign_in');
		    $table->integer('role_id')->unsigned();
		    $table->string('f_name');
		    $table->string('l_name');
		    $table->integer('count_sign_in');
		    $table->string('country');
		    $table->string('city');
		    $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
            $table->string('password_reset_token')->nullable();
		    $table->rememberToken();
		    $table->timestamps();
		    $table->foreign('role_id')
			      ->references('id')->on('role')
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

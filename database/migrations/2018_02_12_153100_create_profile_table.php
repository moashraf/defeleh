<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profile', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('userid');
			$table->string('fullname', 300);
			$table->string('cellphone', 20);
			$table->string('profileimage', 400)->nullable($value = true);
			$table->string('address', 400);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profile');
	}

}

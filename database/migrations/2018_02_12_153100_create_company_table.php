<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('ownerid');
			$table->string('name', 400);
			$table->text('image', 65535);
			$table->integer('categoryid');
			$table->text('address', 65535);
			$table->text('phones', 65535);
			$table->text('description', 65535);
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
		Schema::drop('company');
	}

}

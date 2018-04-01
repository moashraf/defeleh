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
			$table->increments('id');
			$table->integer('ownerid');
			$table->string('name', 400);
			$table->text('image', 65535);
			$table->integer('categoryid');
			$table->text('address', 65535);
			$table->text('phones', 65535);
			$table->text('description', 65535);
			$table->integer('popular', 400);
			$table->integer('company_code', 100);
			$table->string('website_company', 400);
			$table->string('facebook_page', 400);
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

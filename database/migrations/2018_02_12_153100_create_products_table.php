<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 400);
			$table->text('image', 65535);
			$table->text('description', 65535);
			$table->integer('companyid');
			$table->integer('price');
			$table->string('fabric', 400);
			$table->string('least', 400);
			$table->string('colors', 400);
			$table->integer('images_id');
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
		Schema::drop('products');
	}

}

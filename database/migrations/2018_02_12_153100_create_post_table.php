<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 400);
			$table->text('content', 65535);
			$table->text('image', 65535);
			$table->integer('ownerid')->nullable($value = true);
			$table->integer('companyid')->nullable($value = true);
			$table->string('ownertype', 100)->nullable($value = true);
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
		Schema::drop('post');
	}

}

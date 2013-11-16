<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entries', function(Blueprint $table)
		{
			$table->increments('id');

			// Documentation Item
			$table->string('page');
			$table->integer('key');

			// User Information
			$table->string('name');
			$table->string('email');

			// Entry Information
			$table->string('title');
			$table->string('href');

			// Votes
			$table->integer('ups');
			$table->integer('downs');

			// Timestamps
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
		Schema::drop('entries');
	}

}
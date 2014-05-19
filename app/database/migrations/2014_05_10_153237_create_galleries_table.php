<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('galleries', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('event_id');
            $table->integer('category_id');
            $table->string('title');
            $table->string('title_en');
            $table->text('description');
            $table->text('description_en');
            $table->timestamp('date_start'); // here also
            $table->string('name');
            $table->string('name_en');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('galleries');
	}

}

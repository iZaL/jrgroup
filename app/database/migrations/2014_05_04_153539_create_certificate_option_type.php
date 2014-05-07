<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificateOptionType extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certificate_option_type', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('type_id')->unsigned()->index();
            $table->integer('option_id')->unsigned()->index();
            $table->float('price');
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
		Schema::drop('certificate_option_type');
	}

}

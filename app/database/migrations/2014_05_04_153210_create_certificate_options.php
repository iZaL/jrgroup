<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificateOptions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certificate_options', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('meta_id')->unsigned()->index();
            $table->string('name');
			$table->timestamps();
            $table->foreign('meta_id')->references('id')->on('certificate_metas')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('certificate_options');
	}

}

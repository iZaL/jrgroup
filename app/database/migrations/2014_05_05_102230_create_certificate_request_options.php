<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificateRequestOptions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certificate_request_options', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('request_id')->unsigned()->index();
            $table->integer('option_id')->unsigned()->index();
            $table->float('price');
			$table->timestamps();
            $table->foreign('request_id')->references('id')->on('certificate_requests')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('certificate_options')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('certificate_request_options');
	}

}

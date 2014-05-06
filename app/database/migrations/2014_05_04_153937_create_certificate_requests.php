<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificateRequests extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certificate_statuses', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('request_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->string('status');
			$table->timestamps();
            $table->foreign('request_id')->references('id')->on('certificate_requests')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('certificate_statuses');
	}

}

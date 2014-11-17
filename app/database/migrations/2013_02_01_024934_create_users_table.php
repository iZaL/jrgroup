<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->integer('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->bigInteger('civilid')->nullable();
            $table->string('country_id')->nullable();
            $table->text('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->boolean('member')->default(0);
            $table->boolean('confirmed')->default(false);
            $table->timestamp('expires_at');
            $table->string('remember_token',100)->nullable();
            $table->timestamp('last_logged_at')->nullable();
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
        Schema::table('users', function(Blueprint $table)
        {
            Schema::drop('users');
        });
    }

}

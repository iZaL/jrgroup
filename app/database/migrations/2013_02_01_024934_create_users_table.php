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
            $table->string('name_en');
            $table->string('name_ar');
            $table->integer('mobile');
            $table->integer('phone');
            $table->integer('civilid');
            $table->string('country_id');
            $table->text('address');
            $table->string('gender');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('confirmation_code');
            $table->boolean('member')->default(0);
            $table->boolean('confirmed')->default(false);
            $table->timestamp('expires_at');
            $table->string('remember_token',100)->nullable();
            $table->timestamps();
        });
        // Creates password reminders table
        Schema::create('password_reminders', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('email');
            $table->string('token');
            $table->timestamp('created_at');
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
            Schema::drop('password_reminders');
            Schema::drop('users');
        });
    }

}

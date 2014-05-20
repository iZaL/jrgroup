<?php

use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $dt = Carbon::now();
        $faker = Faker\Factory::create();
        $dateNow = $dt->toDateTimeString();

        $users = array(
            array(
                'username'      => 'ad_user',
                'email'      => 'z4ls@live.com',
                'password'   => Hash::make('admin'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'expires_at' => $dt->addYear()->toDateTimeString(),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
                'member' => $faker->boolean()
            ),
            array(
                'username'      => 'mo_user',
                'email'      => 'uusa35@gmail.com',
                'password'   => Hash::make('abc'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'expires_at' => $dt->addYear()->toDateTimeString(),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
                'member' => $faker->boolean()
            ),
            array(
                'username'      => 'au_user',
                'email'      => 'user@example.org',
                'password'   => Hash::make('abc'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'expires_at' => $dt->addYear()->toDateTimeString(),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
                'member' => $faker->boolean()
            ),
            array(
                'username'      => 'ad_user1',
                'email'      => 'admin@example.org',
                'password'   => Hash::make('admin'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'expires_at' => $dt->addYear()->toDateTimeString(),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
                'member' => $faker->boolean()
            ),
            array(
                'username'      => 'mo_user1',
                'email'      => 'user@example.org',
                'password'   => Hash::make('abc'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'expires_at' => $dt->addYear()->toDateTimeString(),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
                'member' => $faker->boolean()
            ),
            array(
                'username'      => 'au_user1',
                'email'      => 'user@example.org',
                'password'   => Hash::make('abc'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'expires_at' => $dt->addYear()->toDateTimeString(),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
                'member' => $faker->boolean()
            ),
            array(
                'username'      => 'no_user',
                'email'      => 'user@example.org',
                'password'   => Hash::make('abc'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'expires_at' => $dt->addYear()->toDateTimeString(),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
                'member' => $faker->boolean()
            ),
            array(
                'username'      => 'no_user1',
                'email'      => 'user@example.org',
                'password'   => Hash::make('abc'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'expires_at' => $dt->addYear()->toDateTimeString(),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
                'member' => $faker->boolean()
            )
        );

        DB::table('users')->insert( $users );

//        $faker = Faker\Factory::create();
//        for ($i = 0; $i < 5; $i++)
//        {
//            $users = array([
//                'username' => $faker->userName,
//                'email' => $faker->email,
//                'password'=> Hash::make('123'),
//                'first_name'=> $faker->firstName,
//                'second_name'=>$faker->lastName,
//                'last_name' =>$faker->lastName,
//                'phone' => $faker->phoneNumber,
//                'mobile'=> $faker->phoneNumber,
//                'gender' => $faker->randomElement(['male', 'female']),
//                'created_at' => $dateNow,
//                'updated_at' => $dateNow
//            ]);
//            DB::table('users')->insert( $users );
//        }

    }

}

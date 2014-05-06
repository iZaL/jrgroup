<?php

class CertificateTypesTableSeeder extends Seeder {

	public function run()
	{

        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 40; $i++)
        {
            $datas = array(
                [
                    'name'=> $faker->name(),
                    'price' => $faker->numberBetween(10,100),
                    'created_at' => $dateNow,
                    'updated_at' => $dateNow
                ]
            );
            DB::table('certificate_types')->insert($datas);
        }

		// Uncomment the below to run the seeder
	}

}

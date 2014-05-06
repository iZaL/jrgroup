<?php

class CertificateOptionsTableSeeder extends Seeder {

	public function run()
	{
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 40; $i++)
        {
            $meta = CertificateMeta::orderBy(DB::raw('RAND()'))->first()->id;
            $followers = array(
                [
                    'meta_id'=> $meta,
                    'name' => $faker->name,
                    'created_at' => $dateNow,
                    'updated_at' => $dateNow
                ]
            );
            DB::table('certificate_options')->insert($followers);

        }


	}


}

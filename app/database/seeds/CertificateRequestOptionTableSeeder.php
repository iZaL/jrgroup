<?php

class CertificateRequestOptionTableSeeder extends Seeder {

	public function run()
	{
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 40; $i++)
        {
            $meta = CertificateRequest::orderBy(DB::raw('RAND()'))->first()->id;
            $option = CertificateOption::orderBy(DB::raw('RAND()'))->first()->id;

            $followers = array(
                [
                    'request_id'=> $meta,
                    'option_id' => $option,
                    'price' => $faker->randomFloat(),
                    'created_at' => $dateNow,
                    'updated_at' => $dateNow
                ]
            );
            DB::table('certificate_request_options')->insert($followers);

        }


	}


}

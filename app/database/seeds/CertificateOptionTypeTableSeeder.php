<?php

class CertificateOptionTypeTableSeeder extends Seeder {

	public function run()
	{
        DB::table('certificate_option_type')->truncate();

        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 2; $i++)
        {
            $meta = CertificateType::orderBy(DB::raw('RAND()'))->first()->id;
            $option = CertificateOption::orderBy(DB::raw('RAND()'))->first()->id;

            $followers = array(
                [
                    'type_id'=> $meta,
                    'option_id' => $option,
                    'price' => $faker->randomFloat(),
                    'created_at' => $dateNow,
                    'updated_at' => $dateNow
                ]
            );
//            DB::table('certificate_option_type')->insert($followers);

        }


	}


}

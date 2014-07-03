
<?php

class CertificateStatusesTableSeeder extends Seeder {


	public function run()
	{
        DB::table('certificate_statuses')->truncate();

//        $dt = Carbon::now();
//        $dateNow = $dt->toDateTimeString();
//        $faker = Faker\Factory::create();
//        for ($i = 0; $i < 40; $i++)
//        {
//
//            $event = CertificateRequest::orderBy(DB::raw('RAND()'))->first()->id;
//            $user = User::orderBy(DB::raw('RAND()'))->first()->id;
//
//            $subscriptions = array(
//                [
//                    'user_id'=> $user,
//                    'request_id' => $event,
//                    'status' =>$faker->randomElement(['PENDING','APPROVED','CONFIRMED','REJECTED']),
//                    'created_at' =>  $dateNow,
//                    'updated_at' =>  $dateNow
//                ]
//            );
////            DB::table('certificate_statuses')->insert($subscriptions);
//        }
		// Uncomment the below to run the seeder
	}


}

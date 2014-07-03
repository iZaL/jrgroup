
<?php

class CertificateRequestsTableSeeder extends Seeder {
    protected $user;

	public function run()
	{
        DB::table('certificate_requests')->truncate();

//        $dt = Carbon::now();
//        $dateNow = $dt->toDateTimeString();
//        $faker = Faker\Factory::create();
//        for ($i = 0; $i < 40; $i++)
//        {
//            $user = User::orderBy(DB::raw('RAND()'))->first()->id;
//            $request = CertificateRequest::orderBy(DB::raw('RAND()'))->first()->id;
//            $option = CertificateStatus::orderBy(DB::raw('RAND()'))->first()->id;
//
//            $followers = array(
//                [
//                    'request_id'=> $user,
//                    'user_id' => $request,
//                    'status' => $option,
//                    'quantity' => $faker->numberBetween(10,20),
//                    'created_at' => $dateNow,
//                    'updated_at' => $dateNow
//                ]
//            );
//            DB::table('certificate_requests')->insert($followers);

//        }
	}

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $user
     * @internal param mixed $date_start
     */
    public function setUser($user)
    {
        $this->user = $user;
    }



}

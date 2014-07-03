
<?php

class CertificatesTableSeeder extends Seeder {
    protected $user;

	public function run()
	{
        DB::table('certificates')->truncate();

        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 40; $i++)
        {
            $user = User::orderBy(DB::raw('RAND()'))->first()->id;
            $type = CertificateType::orderBy(DB::raw('RAND()'))->first()->id;
            $option = CertificateOption::orderBy(DB::raw('RAND()'))->first()->id;

            $followers = array(
                [
                    'user_id'=> $user,
                    'type_id' => $type,
                    'amount' => $faker->randomFloat(),
                    'quantity' => $faker->numberBetween(10,20),
                    'created_at' => $dateNow,
                    'updated_at' => $dateNow
                ]
            );
//            DB::table('certificates')->insert($followers);

        }
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

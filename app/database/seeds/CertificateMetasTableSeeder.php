<?php

class CertificateMetasTableSeeder extends Seeder {

    protected $event;
    protected $user;

	public function run()
	{
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 5; $i++)
        {
            $datas = array(
                [
                    'name'=> $faker->name(),
                    'created_at' => $dateNow,
                    'updated_at' => $dateNow
                ]
            );
            DB::table('certificate_metas')->insert($datas);

        }

		// Uncomment the below to run the seeder
	}

    private function checkUnique()
    {
        $query = Follower::where('event_id',$this->getEvent())->where('user_id',$this->getUser())->first();
        if(!$query) {
            return $this->setEvent($this->getEvent());
        } else {
            return $this->checkUnique();
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
     * @param mixed $date_start
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $date_end
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }



}

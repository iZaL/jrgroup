<?php

class GalleriesTableSeeder extends Seeder {
    public function run()
    {
//        DB::table('posts')->truncate();
        $faker = Faker\Factory::create();
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();
        for ($i = 0; $i < 30; $i++)
        {
            ;
            $event = EventModel::orderBy(DB::raw('RAND()'))->first()->id;
            $category = Category::orderBy(DB::raw('RAND()'))->first()->id;
            $posts = array(
                [
                'event_id'    => $event,
                'category_id'=> $category,
                'title'      => $faker->sentence(5),
                'title_en'      => $faker->sentence(5),
                'title'    => $faker->sentence(10),
                'description'    => $faker->sentence(10),
                'description_en'    => $faker->sentence(10),
                'name'    => $faker->sentence(50),
                'name_en'    => $faker->sentence(50),
                'date_start'    => $dateNow,
                'created_at' => $dateNow,
                'updated_at' => $dateNow
                ]
            );
            DB::table('galleries')->insert($posts);
        }
    }

}

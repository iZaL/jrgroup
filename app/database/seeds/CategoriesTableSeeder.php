<?php


class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
        DB::table('categories')->truncate();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++)
        {
            $categories = array(
                [
                    'name_ar' => $faker->name,
                    'name_en' => $faker->name,
                    'type'=>$faker->randomElement(['EventModel','Blog','Gallery']),
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime
                ]
            );
            DB::table('categories')->insert($categories);
        }
		// Uncomment the below to run the seeder

	}

}

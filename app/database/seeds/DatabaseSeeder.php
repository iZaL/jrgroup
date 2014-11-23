<?php

class DatabaseSeeder extends Seeder {

    private $tables = [
        'assigned_roles',
        'authors',
        'categories',
        'comments',
        'contacts',
        'countries',
        'events',
        'failed_jobs',
        'favorites',
        'followers',
        'locations',
        'migrations',
        'password_reminders',
        'roles',
        'permission_role',
        'permissions',
        'photos',
        'posts',
        'subscriptions',
        'users',
        'types',
        'statuses',
        'certificate_types',
        'certificate_metas',
        'certificate_options',
        'certificate_requests',
        'certificate_statuses',
        'certificate_option_type',
        'certificate_request_options',
        'galleries'

    ];
    public function run()
    {
        Eloquent::unguard();
//        $this->cleanDatabase();
        // Add calls to Seeders here
        $this->call('UsersTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('PermissionsTableSeeder');

        $this->call('CountriesTableSeeder');
        $this->call('LocationsTableSeeder');
        $this->call('CategoriesTableSeeder');
//        $this->call('PostsTableSeeder');
//		$this->call('EventsTableSeeder');
//        $this->call('CommentsTableSeeder');
////        $this->call('FollowersTableSeeder');
////		$this->call('FavoritesTableSeeder');
////		$this->call('SubscriptionsTableSeeder');
////		$this->call('PhotosTableSeeder');
////		$this->call('AuthorsTableSeeder');
//        $this->call('ContactsTableSeeder');
//        $this->call('StatusesTableSeeder');
//        $this->call('TypesTableSeeder');
//        $this->call('CertificateTypesTableSeeder');
//        $this->call('CertificateMetasTableSeeder');
//        $this->call('CertificateOptionsTableSeeder');
//        $this->call('CertificateOptionTypeTableSeeder');
//        $this->call('CertificateRequestsTableSeeder');
//        $this->call('CertificateStatusesTableSeeder');
//        $this->call('CertificateRequestOptionTableSeeder');
//        $this->call('GalleriesTableSeeder');
	}

    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

}
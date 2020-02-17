<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(RequestedDocumentsSeeder::class);
        $this->call(EmailTemplatesSeeder::class);
    }
}

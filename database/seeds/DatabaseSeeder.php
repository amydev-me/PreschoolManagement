<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(CategorySeeder::class);
//        $this->call(FeeSeeder::class);
//        $this->call(SubjectSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}

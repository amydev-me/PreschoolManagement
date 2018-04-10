<?php

use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('fees')->insert(
            [
                ['feeName'=>'Uniform','description'=>'4 PCS','amount'=>60],
                ['feeName'=>'Meals','description'=>'','amount'=>50000],
                ['feeName'=>'Fine','description'=>'','amount'=>300],

            ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('terms')->insert(
            [
                ['termName'=>'Term-1',
                    'start_date'=>'2018-01-01',
                    'end_date'=>'2018-04-30',
                    'due_date'=>'2018-05-30'],

                ['termName'=>'Term-2',
                    'start_date'=>'2018-01-01',
                    'end_date'=>'2018-04-30',
                    'due_date'=>'2018-05-30'],
                ['termName'=>'Summer',
                    'start_date'=>'2018-01-01',
                    'end_date'=>'2018-04-30',
                    'due_date'=>'2018-05-30'],

            ]);
    }
}

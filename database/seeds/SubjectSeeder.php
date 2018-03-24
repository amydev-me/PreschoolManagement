<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('subjects')->insert(
        [
            ['subjectName'=>'SHAPES & COLORS','description'=>'2 YEARS+'],
            ['subjectName'=>'PUZLES','description'=>'2 YEARS+'],
            ['subjectName'=>'MEMORY','description'=>'3 YEARS+'],
            ['subjectName'=>'LETTERS','description'=>'3 YEARS+'],
            ['subjectName'=>'COUNTING','description'=>'3 YEARS+'],
            ['subjectName'=>'ALPHABET','description'=>'4 YEARS+'],
            ['subjectName'=>'ADD & SUBTRACT','description'=>'4 YEARS+'],
            ['subjectName'=>'PATTERNS','description'=>'5 YEARS+'],
            ['subjectName'=>'PHONICS','description'=>'5 YEARS+'],
            ['subjectName'=>'SPELLING','description'=>'5 YEARS+'],
        ]);
    }
}

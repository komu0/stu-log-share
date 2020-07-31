<?php

use Illuminate\Database\Seeder;

class StulogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 1000; $i++) {
            $check = rand(1,5);
            $userNo = rand(1,20);
            if ($check == 1) {
                DB::table('stulogs')->insert([
                    'user_id' => 'testkun' . $userNo,
                    'content' => 'test content ' . $i,
                    'thought' => 'test thought ' . $i,
                    'log_date' => '2020-07-' . ($i % 31 + 1),
                    'study_time' => $i % 10 + 1 .':' . $i % 4 * 15 . ':00'
                ]);
            } elseif ($check == 2) {
                DB::table('stulogs')->insert([
                    'user_id' => 'testkun' . $userNo,
                    'content' => 'test content ' . $i,
                    'log_date' => '2020-07-' . ($i % 31 + 1),
                    'study_time' => $i % 10 + 1 .':' . $i % 4 * 15 . ':00'
                ]);
            } elseif ($check == 3) {
                DB::table('stulogs')->insert([
                    'user_id' => 'testkun' . $userNo,
                    'thought' => 'test thought ' . $i,
                    'log_date' => '2020-07-' . ($i % 31 + 1),
                    'study_time' => $i % 10 + 1 .':' . $i % 4 * 15 . ':00'
                ]);
            } else {
                DB::table('stulogs')->insert([
                    'user_id' => 'testkun' . $userNo,
                    'log_date' => '2020-07-' . ($i % 31 + 1),
                    'study_time' => $i % 10 + 1 .':' . $i % 4 * 15 . ':00'
                ]);
            }
        }
    }
}

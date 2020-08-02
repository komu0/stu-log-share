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
            $createH = rand(21,23);
            $createM = rand(0,59);
            $createS = rand(0,59);
            if ($check == 1) {
                DB::table('stulogs')->insert([
                    'user_id' => 'testkun' . $userNo,
                    'content' => 'test content ' . $i,
                    'thought' => 'test thought ' . $i,
                    'log_date' => '2020-07-' . ($i % 31 + 1),
                    'study_time_H' => $i % 10 + 1,
                    'study_time_M' => $i % 4 * 15,
                    'created_at' => '2020-07-' . ($i % 31 + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                    'updated_at' => '2020-07-' . ($i % 31 + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                ]);
            } elseif ($check == 2) {
                DB::table('stulogs')->insert([
                    'user_id' => 'testkun' . $userNo,
                    'content' => 'test content ' . $i,
                    'log_date' => '2020-07-' . ($i % 31 + 1),
                    'study_time_H' => $i % 10 + 1,
                    'study_time_M' => $i % 4 * 15,
                    'created_at' => '2020-07-' . ($i % 31 + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                    'updated_at' => '2020-07-' . ($i % 31 + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                ]);
            } elseif ($check == 3) {
                DB::table('stulogs')->insert([
                    'user_id' => 'testkun' . $userNo,
                    'thought' => 'test thought ' . $i,
                    'log_date' => '2020-07-' . ($i % 31 + 1),
                    'study_time_H' => $i % 10 + 1,
                    'study_time_M' => $i % 4 * 15,
                    'created_at' => '2020-07-' . ($i % 31 + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                    'updated_at' => '2020-07-' . ($i % 31 + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                ]);
            } else {
                DB::table('stulogs')->insert([
                    'user_id' => 'testkun' . $userNo,
                    'log_date' => '2020-07-' . ($i % 31 + 1),
                    'study_time_H' => $i % 10 + 1,
                    'study_time_M' => $i % 4 * 15,
                    'created_at' => '2020-07-' . ($i % 31 + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                    'updated_at' => '2020-07-' . ($i % 31 + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                ]);
            }
        }
    }
}

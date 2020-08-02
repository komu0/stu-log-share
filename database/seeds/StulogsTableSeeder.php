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
        for($userNo = 1; $userNo <= 100; $userNo++) {
            for($day = 1; $day <=30; $day++) {
                $check = rand(1,5);
                $checkNextDay = rand(1,4);
                $createH = rand(12,23);
                if($checkNextDay == 1){
                    $createH = rand(0,21);
                }
                $createM = rand(0,59);
                $createS = rand(0,59);
                $studyH = rand(0,10);
                if($studyH == 0){
                    $studyM = rand(1,3) * 15;
                } else {
                    $studyM = rand(0,3) * 15;
                }
                
                
                if($checkNextDay == 1) {
                    if ($check == 1) {
                        DB::table('stulogs')->insert([
                            'user_id' => 'testkun' . $userNo,
                            'content' => 'test content ' . $userNo . '_' . $day,
                            'thought' => 'test thought ' . $userNo . '_' . $day,
                            'log_date' => '2020-07-' . ($day),
                            'study_time_H' => $studyH,
                            'study_time_M' => $studyM,
                            'created_at' => '2020-07-' . ($day + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                            'updated_at' => '2020-07-' . ($day + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                        ]);
                    } elseif ($check == 2) {
                        DB::table('stulogs')->insert([
                            'user_id' => 'testkun' . $userNo,
                            'content' => 'test content ' . $userNo . '_' . $day,
                            'log_date' => '2020-07-' . ($day),
                            'study_time_H' => $studyH,
                            'study_time_M' => $studyM,
                            'created_at' => '2020-07-' . ($day + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                            'updated_at' => '2020-07-' . ($day + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                        ]);
                    } elseif ($check == 3) {
                        DB::table('stulogs')->insert([
                            'user_id' => 'testkun' . $userNo,
                            'thought' => 'test thought ' . $userNo . '_' . $day,
                            'log_date' => '2020-07-' . ($day),
                            'study_time_H' => $studyH,
                            'study_time_M' => $studyM,
                            'created_at' => '2020-07-' . ($day + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                            'updated_at' => '2020-07-' . ($day + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                        ]);
                    } else {
                        DB::table('stulogs')->insert([
                            'user_id' => 'testkun' . $userNo,
                            'log_date' => '2020-07-' . ($day),
                            'study_time_H' => $studyH,
                            'study_time_M' => $studyM,
                            'created_at' => '2020-07-' . ($day + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                            'updated_at' => '2020-07-' . ($day + 1) . ' ' . $createH . ':' . $createM . ':' . $createS,
                        ]);
                    }
                } else {
                    if ($check == 1) {
                        DB::table('stulogs')->insert([
                            'user_id' => 'testkun' . $userNo,
                            'content' => 'test content ' . $userNo . '_' . $day,
                            'thought' => 'test thought ' . $userNo . '_' . $day,
                            'log_date' => '2020-07-' . ($day),
                            'study_time_H' => $studyH,
                            'study_time_M' => $studyM,
                            'created_at' => '2020-07-' . ($day) . ' ' . $createH . ':' . $createM . ':' . $createS,
                            'updated_at' => '2020-07-' . ($day) . ' ' . $createH . ':' . $createM . ':' . $createS,
                        ]);
                    } elseif ($check == 2) {
                        DB::table('stulogs')->insert([
                            'user_id' => 'testkun' . $userNo,
                            'content' => 'test content ' . $userNo . '_' . $day,
                            'log_date' => '2020-07-' . ($day),
                            'study_time_H' => $studyH,
                            'study_time_M' => $studyM,
                            'created_at' => '2020-07-' . ($day) . ' ' . $createH . ':' . $createM . ':' . $createS,
                            'updated_at' => '2020-07-' . ($day) . ' ' . $createH . ':' . $createM . ':' . $createS,
                        ]);
                    } elseif ($check == 3) {
                        DB::table('stulogs')->insert([
                            'user_id' => 'testkun' . $userNo,
                            'thought' => 'test thought ' . $userNo . '_' . $day,
                            'log_date' => '2020-07-' . ($day),
                            'study_time_H' => $studyH,
                            'study_time_M' => $studyM,
                            'created_at' => '2020-07-' . ($day) . ' ' . $createH . ':' . $createM . ':' . $createS,
                            'updated_at' => '2020-07-' . ($day) . ' ' . $createH . ':' . $createM . ':' . $createS,
                        ]);
                    } else {
                        DB::table('stulogs')->insert([
                            'user_id' => 'testkun' . $userNo,
                            'log_date' => '2020-07-' . ($day),
                            'study_time_H' => $studyH,
                            'study_time_M' => $studyM,
                            'created_at' => '2020-07-' . ($day) . ' ' . $createH . ':' . $createM . ':' . $createS,
                            'updated_at' => '2020-07-' . ($day) . ' ' . $createH . ':' . $createM . ':' . $createS,
                        ]);
                    }
                }
                    
            }
        }
   }
}

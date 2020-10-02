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

        $thoughts = [ "楽しかったです！", "難しかった。" ,'大変でした。', "簡単でした！", "肩が凝りました……。", 
        "成長が実感できました！", "いっぱい勉強できてよかったです！", "明日も頑張ろう！", "しんどい……。", "眠いので寝ます。明日は頑張る！"];
        
        $endDate = strToTime('-2 day', strToTime(date('Y-m-d')));
        $startDate = strToTime('-32 day', strToTime(date('Y-m-d')));
        
        for($userNo = 1; $userNo <= 20; $userNo++) {
            for($date = $startDate; $date <= $endDate; $date = strToTime('+1 day', $date)) {
                $user_id = 'testkun' . $userNo;
                
                $thought = '';
                
                if (rand(1,2) == 1) {
                    $thought = $thoughts[ array_rand( $thoughts ) ];
                }
                
                $log_date = date('Y-m-d', $date);
                $created_at = $log_date . ' ' . rand(12,23) . ':' . rand(0,59) . ':' . rand(0,59);
                $updated_at = $created_at;
                
                DB::table('stulogs')->insert([
                    'user_id' => $user_id,
                    'thought' => $thought,
                    'log_date' => $log_date,
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ]);
            }
        }
   }
}

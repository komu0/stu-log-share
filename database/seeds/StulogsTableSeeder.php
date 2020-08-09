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
        
        for($userNo = 1; $userNo <= 20; $userNo++) {
            for($day = 1; $day <=30; $day++) {
                $user_id = 'testkun' . $userNo;
                
                $thought = '';
                
                if (rand(1,2) == 1) {
                    $thought = $thoughts[ array_rand( $thoughts ) ];
                }
                
                $log_date = '2020-07-' . ($day);
                
                $createH;
                $createD = $day;
                
                if(rand(1,3) == 1){
                    $createH = rand(0,21);
                    $createD++;
                } else {
                    $createH = rand(12,23);
                }
                
                $createM = rand(0,59);
                $createS = rand(0,59);
                
                $created_at = '2020-07-' . $createD . ' ' . $createH . ':' . $createM . ':' . $createS;
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

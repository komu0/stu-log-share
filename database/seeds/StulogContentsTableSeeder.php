<?php

use Illuminate\Database\Seeder;

class StulogContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_at = '2020-07-09 00:00:00';
        $updated_at = $created_at;
        for($stulog_id = 1; $stulog_id <= 600; $stulog_id++) {
            $stulog = \App\Stulog::findOrFail($stulog_id);
            $user_id = $stulog->user_id;
            $user = App\User::findOrFail($user_id);
            $tags = $user->tags()->get();
            
            foreach($tags as $tag) {
                if(rand(1,2) ==1){
                    $tag_id = $tag->id;
                    $study_time_H = rand(0,5);
                    if($study_time_H == 0){
                        $study_time_M = rand(1,3) * 15;
                    } else {
                        $study_time_M = rand(0,3) * 15;
                    }
                    if( $tag->category->name == '習い事') {
                        $comment = $tag->name . 'の練習';
                    } elseif ( $tag->category->name == '未設定') {
                        $comment = '寝る前に' . $tag->name;
                    } else {
                        if(rand(1,2) ==1){
                            $comment = $tag->name . 'の予習';
                        } else {
                            $comment = $tag->name . 'の復習';
                        }
                    }
                    
                    DB::table('stulog_contents')->insert([
                        'stulog_id' => $stulog_id,
                        'tag_id' => $tag_id,
                        'study_time_H' => $study_time_H,
                        'study_time_M' => $study_time_M,
                        'comment' => $comment,
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ]);
                }
            }
        }
    }
}
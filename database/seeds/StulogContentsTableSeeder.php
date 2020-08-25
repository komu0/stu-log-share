<?php

use Illuminate\Database\Seeder;
use App\Stulog;

class StulogContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($stulog_id = 1; $stulog_id <= 600; $stulog_id++) {
            $stulog = \App\Stulog::findOrFail($stulog_id);
            $created_at = $stulog->created_at;
            $updated_at = $stulog->updated_at;
            $user_id = $stulog->user_id;
            $user = App\User::findOrFail($user_id);
            $tags = $user->tags()->get();
            
            foreach($tags as $tag) {
                if(rand(1,3) <=1 ){
                    $tag_id = $tag->id;
                    $study_time = rand(1,8) * 0.25;
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
                        'study_time' => $study_time,
                        'comment' => $comment,
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ]);
                }
            }
        }
        
        foreach(Stulog::all() as $stulog) {
            if(count($stulog->contents)){
                continue;
            } else {
                $stulog->delete();
            }
        }   
    }
}
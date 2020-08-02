<?php

use Illuminate\Database\Seeder;

class UserFollowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 20; $i++) {
            for($j = 1; $j <= 20; $j++){
                if ($i == $j) {
                    continue;
                }
                if (rand(1,3) <= 2) {
                    DB::table('user_follow')->insert([
                        'user_id' => 'testkun' . $i,
                        'follow_id' => 'testkun' . $j,
                        'created_at' => '2020-07-01 00:00:00',
                        'updated_at' => '2020-07-01 00:00:00',
                    ]);
                }
            }
        }
    }
}

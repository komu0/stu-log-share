<?php

use Illuminate\Database\Seeder;

class UserMuteTableSeeder extends Seeder
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
                if (rand(1,3) <= 1) {
                    DB::table('user_mute')->insert([
                        'user_id' => 'testkun' . $i,
                        'mute_id' => 'testkun' . $j,
                        'created_at' => '2020-07-05 00:00:00',
                        'updated_at' => '2020-07-05 00:00:00',
                    ]);
                }
            }
        }
    }
}

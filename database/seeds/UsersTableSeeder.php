<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 20; $i++) {
            DB::table('users')->insert([
                'id' => 'testkun' . $i,
                'password' => bcrypt('password'),
                'profile' => $i . '番目のテストユーザです。よろしくお願いします。',
                'created_at' => '2020-07-01 00:00:00',
                'updated_at' => '2020-07-01 00:00:00',
                'image_path' => 'init/testkun' . $i . '_init.png'
            ]);
        }
    }
}

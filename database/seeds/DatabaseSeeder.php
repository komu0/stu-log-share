<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(StulogsTableSeeder::class);
        $this->call(UserFollowTableSeeder::class);
        $this->call(UserMuteTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(StulogContentsTableSeeder::class);
    }
}

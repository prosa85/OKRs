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
//        $this->call(OKRsTableSeeder::class);
//        $this->call(KRsTableSeeder::class);
        $okrs = factory(App\User::class,10)->create();
        $okrs = factory(App\Okr::class,10)->create();
        $okrs = factory(App\Kr::class,20)->create();
        $okrs = factory(App\Task::class,60)->create();
    }
}

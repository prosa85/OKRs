<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users['aseal'] = [ 'first_name' => "Alan", 'last_name' => "Seal", 'supervisor_id'=>0 ,'title' => "VP", 'email' => "aseal@vxchnge.com", 'role' => 1, 'department' => 1, 'password' => bcrypt("test"), 'api_token' => Str::random(60)] ;
        $users['prosa'] = [ 'first_name' => "Pablo", 'last_name' => "Rosa", 'supervisor_id'=>1 ,'title' => "Developer", 'email' => "prosa@vxchnge.com", 'role' => 1, 'department' => 1, 'password' => bcrypt("test"), 'api_token' => Str::random(60),] ;

          foreach($users as $user){
            User::create($user);

            Log::info('Create user '. $user['email']);
          }

    }
}

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
//        $users['amarashi'] = [ 'first_name' => "Ali", 'last_name' => "Marashi", 'supervisor_id'=>0 ,'title' => "CTO", 'email' => "aseal@vxchnge.com", 'role' => 1, 'department' => 1, 'password' => bcrypt("test"), 'api_token' => Str::random(60)] ;
//        $users['aseal'] = [ 'first_name' => "Alan", 'last_name' => "Seal", 'supervisor_id'=>1 ,'title' => "VP", 'email' => "amarashi@vxchnge.com", 'role' => 1, 'department' => 1, 'password' => bcrypt("test"), 'api_token' => Str::random(60)] ;
//        $users['famoon'] = [ 'first_name' => "Foad", 'last_name' => "Amoon", 'supervisor_id'=>1 ,'title' => "Director", 'email' => "famoon@vxchnge.com", 'role' => 1, 'department' => 1, 'password' => bcrypt("test"), 'api_token' => Str::random(60)] ;
        $users['prosaAdmin'] = [ 'first_name' => "PabloAdmin", 'last_name' => "RosaAdmin", 'supervisor_id'=>0 ,'title' => "Dev", 'email' => "prosa85@yahoo.com", 'role' => 1, 'department' => 1, 'password' => bcrypt("test"), 'api_token' => Str::random(60),] ;
        $users['prosa'] = [ 'first_name' => "Pablo", 'last_name' => "Rosa", 'supervisor_id'=>1 ,'title' => "Developer", 'email' => "prosa@vxchnge.com", 'role' => 1, 'department' => 1, 'password' => bcrypt("test"), 'api_token' => Str::random(60),] ;
        $users['mike'] = [ 'first_name' => "Mike", 'last_name' => "Burn", 'supervisor_id'=>1 ,'title' => "Developer", 'email' => "mike@immertec.com", 'role' => 1, 'department' => 1, 'password' => bcrypt("test"), 'api_token' => Str::random(60),] ;
        $users['john'] = [ 'first_name' => "Joh", 'last_name' => "Test", 'supervisor_id'=>1 ,'title' => "CTO", 'email' => "Jon@Immertec.com", 'role' => 1, 'department' => 1, 'password' => bcrypt("test"), 'api_token' => Str::random(60),] ;


          foreach($users as $user){
            User::create($user);

            Log::info('Create user '. $user['email']);
          }

    }
}

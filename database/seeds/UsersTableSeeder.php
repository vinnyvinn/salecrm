<?php

use App\User;
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
    	User::truncate();
    	$user = User::create([
    		'name' => 'Admin',
    		'email' => 'admin@sales.com',
    		'password' => 'password'
    	]);


    	\App\Team::create([
    	    'user_id' => $user->id,
            'job_title' => 'Admin',
            'employee_id' => 'ESL - 001',
            'phone_no' => '0722000000',
        ]);
    }
}

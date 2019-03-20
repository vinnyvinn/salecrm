<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'name' => "Laravel Personal Access Client",
            'secret' => "W1j2saGz4WDJmDgjFSVrN1olj7CY33iTzZCm1fxU",
            'redirect' => 'http://localhost',
            'personal_access_client'=>1,
            'password_client'=>0,
            'revoked'=>0
        ]);
        DB::table('oauth_clients')->insert([
            'name' => 'Laravel Password Grant Client',
            'secret' => 'avFy6u0W4aBKmQFdI2TmdOXzvjhKX9RxCO72YW9H',
            'redirect' => 'http://localhost',
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' =>0
        ]);
    }
}

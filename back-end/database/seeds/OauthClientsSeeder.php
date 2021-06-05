<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OauthClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Personal Access Client',
                'secret' => 'XTQ7lhF7CvmNNHBGGMAVy1S7oJTcBgtHrmD3lI7a',
                'provider' => '',
                'redirect' => '',
                'personal_access_client' => true,
                'password_client' => false,
                'revoked' => false,
                'created_at' => \Carbon\Carbon::now()->toIso8601String(),
                'updated_at' => \Carbon\Carbon::now()->toIso8601String(),
            ],
            [
                'id' => 2,
                'name' => 'Password Grant Client',
                'secret' => '937vXRO090liJPmvDhuJxMZSRIfcdmKnu2VXjzd8',
                'provider' => 'users',
                'redirect' => '',
                'personal_access_client' => false,
                'password_client' => true,
                'revoked' => false,
                'created_at' => \Carbon\Carbon::now()->toIso8601String(),
                'updated_at' => \Carbon\Carbon::now()->toIso8601String(),
            ],
        ];

        foreach ($data as $arr) {
            DB::table('oauth_clients')->insert($arr);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'id' => 1,
            'full_name' => "demo",
            'email' => "a@a.se",
            'username' => "a@a.se",
            'status' => true,
            'password' => Hash::make("123123"),
            'created' => \Carbon\Carbon::now()->toIso8601String(),
            'updated' => \Carbon\Carbon::now()->toIso8601String(),
        ];

        DB::table('user')->insert($data);
    }
}

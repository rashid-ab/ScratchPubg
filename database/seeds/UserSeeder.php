<?php

use Illuminate\Database\Seeder;
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
        $admins = array(
            array(
                "name" => "System Admin",
                "email" => "2k9140@gmail.com",
                "password" => Hash::make('respecteduc'),
            ),
        );
        foreach ($admins as $admin) {
            \App\User::create($admin);
        }
    }
}

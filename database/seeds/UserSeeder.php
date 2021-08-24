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
                "name" => "Client",
                "email" => "abc@a.com",
                "password" => Hash::make('12341234'),
                "name" => "Client",
                "email" => "abc@a1.com",
                "password" => Hash::make('12341234'),
                "name" => "Client",
                "email" => "abc@a2.com",
                "password" => Hash::make('12341234'),
                "name" => "Client",
                "email" => "abc@a3.com",
                "password" => Hash::make('12341234'),
                "name" => "Client",
                "email" => "abc@a4.com",
                "password" => Hash::make('12341234'),
                "name" => "Client",
                "email" => "abc@a5.com",
                "password" => Hash::make('12341234'),
                "name" => "Client",
                "email" => "abc@a6.com",
                "password" => Hash::make('12341234'),
            ),
        );
        foreach ($admins as $admin) {
            \App\User::create($admin);
        }
    }
}

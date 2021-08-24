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
            array(
                "name" => "Client",
                "email" => "rashidbuttuog@gmail.com",
                "password" => Hash::make('respecteduc'),
                
            ),
            array(
                "name" => "Client",
                "email" => "rashidbuttuog12121212@gmail.com",
                "password" => Hash::make('respecteduc'),
                
            ),
            array(
                "name" => "Client",
                "email" => "rashidbuttuog21212@gmail.com",
                "password" => Hash::make('respecteduc'),
                
            ),
            array(
                "name" => "Client",
                "email" => "rashidbuttuog221@gmail.com",
                "password" => Hash::make('respecteduc'),
                
            ),
            array(
                "name" => "Client",
                "email" => "rashidbuttuog122@gmail.com",
                "password" => Hash::make('respecteduc'),
                
            ),
            array(
                "name" => "Client",
                "email" => "rashidbuttuog121@gmail.com",
                "password" => Hash::make('respecteduc'),
                
            ),
            array(
                "name" => "Client",
                "email" => "rashidbuttuog21@gmail.com",
                "password" => Hash::make('respecteduc'),
                
            ),
            array(
                "name" => "Client",
                "email" => "rashidbuttuog11@gmail.com",
                "password" => Hash::make('respecteduc'),
                
            ),
            array(
                "name" => "Client",
                "email" => "rashidbuttuog12@gmail.com",
                "password" => Hash::make('respecteduc'),
                
            ),
        );
        foreach ($admins as $admin) {
            \App\User::create($admin);
        }
    }
}

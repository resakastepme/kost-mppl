<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Room;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();

        User::factory()->createMany([
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => 'admin', 'isAdmin' => true],
            ['name' => 'Resa Komara', 'email' => 'resa@gmail.com', 'password' => 'user123', 'isAdmin' => false],
            ['name' => 'Pudidi', 'email' => 'didi@gmail.com', 'password' => 'user123', 'isAdmin' => false],
            ['name' => 'Kautsar Teguh Dwi Putra', 'email' => 'kautsar@gmail.com', 'password' => 'user123', 'isAdmin' => false],
        ]);

        Room::factory()->createMany([
            ['room_number' => 1, 'price' => '1400000'],
            ['room_number' => 2, 'price' => '1400000'],
            ['room_number' => 3, 'price' => '850000'],
            ['room_number' => 4, 'price' => '1400000'],
            ['room_number' => 5, 'price' => '1400000'],
            ['room_number' => 6, 'price' => '850000'],
            ['room_number' => 7, 'price' => '850000'],
            ['room_number' => 8, 'price' => '850000'],
            ['room_number' => 9, 'price' => '1400000'],
            ['room_number' => 10, 'price' => '800000'],
            ['room_number' => 11, 'price' => '800000'],
            ['room_number' => 12, 'price' => '1400000'],
            ['room_number' => 13, 'price' => '1400000'],
        ]);
    }
}

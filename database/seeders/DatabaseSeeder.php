<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(1)->create();
         \App\Models\Organization::factory(100)->create();
         \App\Models\Bot::factory(100)->create();
         \App\Models\Pharmacies::factory(100)->create();

    }
}

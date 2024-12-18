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
        // generate 1 user default
        \App\Models\User::factory(1)->create();
        $this->call([

            SelectSeeder::class,
        ]);
    }
}

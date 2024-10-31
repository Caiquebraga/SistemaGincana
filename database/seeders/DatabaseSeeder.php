<?php

namespace Database\Seeders;
use App\Models\Equipe;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    

        Equipe::factory()->create();

        Equipe::factory()->count(10)->create();

    }
}

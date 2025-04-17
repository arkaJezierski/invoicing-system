<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        if ($this->command->option('prod')) {
            $this->call(ProductionSeeder::class);
        } elseif ($this->command->option('local')) {
        $this->call(LocalSeeder::class);
        }

    }
}

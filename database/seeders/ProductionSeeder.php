<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create(
            [
                'name' => 'ajezierski',
                'email' => 'kontakt@ajezierski.pl',
                'password' => Hash::make('password')
            ]
        );

        //TODO Complete Seeders
        $this->call([
            CountrySeeder::class,
        ]);

    }
}

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
                'image' => 'mqaQBLyOQTPQVbxtAhPgRMCcufpmmweW.png',
                'password' => Hash::make('password')
            ]
        );

//        $this->call([
            // TODO
//        ]);

    }
}

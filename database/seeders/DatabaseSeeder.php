<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        try {
            User::factory()->create([
                'name' => 'Filament Admin',
                'email' => 'admin@filament.test',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]);

        } catch (\Exception $e) {
        }
        $this->call([\Database\Seeders\DemoSeeder::class]);
    }
}

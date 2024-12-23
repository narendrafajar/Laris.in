<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Adinda',
            'email' => 'adinda@rndweb.my.id',
            'password' => Hash::make('adinda'), // password yang sudah di-hash
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // $this->call(UserSeeder::class);
    }
}

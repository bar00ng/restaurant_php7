<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(KategoriMenuSeeder::class);

        User::create([
            'name' => 'SUPERADMIN',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('superadmin')
        ])->attachRole('superadmin');

        User::create([
            'name' => 'OWNER',
            'email' => 'owner@example.com',
            'password' => Hash::make('owner')
        ])->attachRole('owner');

        User::create([
            'name' => 'KASIR',
            'email' => 'kasir@example.com',
            'password' => Hash::make('kasir')
        ])->attachRole('kasir');
    }
}

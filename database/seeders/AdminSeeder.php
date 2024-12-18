<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstName' => 'Nour',
            'lastName' => 'Shaheen',
            'phone' => '0933453123',
            'password' => Hash::make('nour1234'),
            'role' => true,
        ]);

        User::create([
            'firstName' => 'Khalil',
            'lastName' => 'Salha',
            'phone' => '0937582883',
            'password' => Hash::make('khalil1234'),
            'role' => true,
        ]);
    }
}

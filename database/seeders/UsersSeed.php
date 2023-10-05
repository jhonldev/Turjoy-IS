<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ítalo Donoso Barraza',
            'email' => 'italo.donoso@ucn.cl',
            'password' => 'Turjoy91',
            'role' => true

        ]);
    }
}

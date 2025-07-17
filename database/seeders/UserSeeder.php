<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Usuario Teste',
            'email' => 'usuario@alwaysfit.com',
            'password' => bcrypt('123456'),
            'weight' => 68.5,
            'height' => 1.71,
            'gender' => 'masculino',
            'activity_level' => 'moderado',
        ]);
    }
}

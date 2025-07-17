<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Training;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Training::create([
            'user_id' => 1,
            'name' => 'Treino de Musculação',
            'description' => 'Treino para aumentar a massa muscular',
            'level' => 'iniciante',
            'duration_minutes' => 60,
        ]);
    }
}

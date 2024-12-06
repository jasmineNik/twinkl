<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::factory()
            ->count(4)
            ->sequence(
                ['name' => 'Student'],
                ['name' => 'Teacher'],
                ['name' => 'Parent'],
                ['name' => 'Private tutor']
            )->create();
    }
}

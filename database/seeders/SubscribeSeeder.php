<?php

namespace Database\Seeders;

use App\Models\Subscribe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscribeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscribe::factory()
            ->count(4)
            ->sequence(
                ['name' => 'student'],
                ['name' => 'teacher'],
                ['name' => 'parent'],
                ['name' => 'private tutor']
            )->create();
    }
}

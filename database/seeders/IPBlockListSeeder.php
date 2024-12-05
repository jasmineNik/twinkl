<?php

namespace Database\Seeders;

use App\Models\IPBlockList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IPBlockListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IPBlockList::factory(10)->create();
    }
}

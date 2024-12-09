<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::factory()
            ->count(4)
            ->sequence(
                ['name' => 'Free'],
                ['name' => 'Monthly'],
                ['name' => '3 months'],
                ['name' => 'Yearly']
            )->create();
    }
}

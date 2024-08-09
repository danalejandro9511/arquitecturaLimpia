<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Retention;

class RetentionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $retentions = [
            ['name' => 'Retención 5.2%', 'percentage' => 5.20],
            ['name' => 'Retención 0%', 'percentage' => 0.00],
        ];

        foreach ($retentions as $retention) {
            Retention::create($retention);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaxRate;

class TaxRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taxRates = [
            ['name' => 'IVA 21%', 'percentage' => 21.00],
            ['name' => 'IVA 10%', 'percentage' => 10.00],
            ['name' => 'IVA 0%', 'percentage' => 0.00],
        ];

        foreach ($taxRates as $rate) {
            TaxRate::create($rate);
        }
    }
}

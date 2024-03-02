<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = ['feature1', 'feature2', 'feature3'];

        foreach ($features as $feature) {
            Feature::create([
                'name' => $feature
            ]);
        }
    }
}

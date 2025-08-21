<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            ['name' => 'Haircut', 'description' => 'Basic haircut', 'min_price' => 15, 'max_price' => 30],
            ['name' => 'Beard Trim', 'description' => 'Beard trimming and shaping', 'min_price' => 10, 'max_price' => 20],
            ['name' => 'Shave', 'description' => 'Traditional straight razor shave', 'min_price' => 20, 'max_price' => 40],
            ['name' => 'Hair Coloring', 'description' => 'Full hair coloring service', 'min_price' => 50, 'max_price' => 100],
            ['name' => 'Styling', 'description' => 'Hair styling for special occasions', 'min_price' => 25, 'max_price' => 50],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}

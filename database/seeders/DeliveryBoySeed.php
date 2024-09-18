<?php

namespace Database\Seeders;

use App\Models\DeliveryBoy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryBoySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryBoy::create(['name' => 'A', 'max_order_capacity' => 2]);
        DeliveryBoy::create(['name' => 'B', 'max_order_capacity' => 4]);
        DeliveryBoy::create(['name' => 'C', 'max_order_capacity' => 5]);
        DeliveryBoy::create(['name' => 'D', 'max_order_capacity' => 3]);
    }
}

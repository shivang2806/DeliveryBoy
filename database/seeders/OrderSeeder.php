<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Insert sample orders into the orders table
        Order::insert([
            [
                'status' => 'pending',
                'delivery_boy_id' => null, // not assigned yet
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'status' => 'pending',
                'delivery_boy_id' => null,
                'delivery_start_time' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}

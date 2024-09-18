<?php
namespace App\Repositories\Eloquent;

use App\Models\DeliveryBoy;
use App\Repositories\Contracts\DeliveryBoyRepositoryInterface;

class DeliveryBoyRepository implements DeliveryBoyRepositoryInterface {

    public function getAllDeliveryBoys() {
        return DeliveryBoy::all();
    }

    public function getAvailableDeliveryBoys($currentTime) {
        // Fetch a delivery boy who is not currently delivering
        return DeliveryBoy::whereDoesntHave('orders', function ($query) use ($currentTime) {
            $query->where('delivery_start_time', '>', $currentTime->subMinutes( DeliveryBoy::DeliveryDuration ));
        })
        ->whereHas('orders', function ($query) {
            // Only select delivery boys who are under capacity
            $query->havingRaw('COUNT(orders.id) < delivery_boys.max_order_capacity');
        }, '<=', 5) // Using a limit of 1 to filter boys based on capacity
        ->get();
    }

}

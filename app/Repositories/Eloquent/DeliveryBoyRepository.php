<?php
namespace App\Repositories\Eloquent;

use App\Models\DeliveryBoy;
use App\Repositories\Contracts\DeliveryBoyRepositoryInterface;

class DeliveryBoyRepository implements DeliveryBoyRepositoryInterface {

    public function getAllDeliveryBoys() {
        return DeliveryBoy::all();
    }

    public function getAvailableDeliveryBoys($currentTime) {
        return DeliveryBoy::whereHas('orders', function ($query) use ($currentTime) {
            $query->where('delivery_start_time', '>', $currentTime->subMinutes(DeliveryBoy::DeliveryDuration))
                  ->where('status', '!=', 'completed'); // Filter out completed orders
        }, '<', function ($query) {
            // Use a subquery to get the max order capacity for each delivery boy
            $query->select(DB::raw('MAX(delivery_boys.max_order_capacity)'));
        })
        ->where(function ($query) use ($currentTime) {
            // Check if the delivery boy has completed orders within the last hour
            $query->whereDoesntHave('orders', function ($subQuery) use ($currentTime) {
                $subQuery->where('status', 'completed')
                        ->where('delivery_start_time', '<', $currentTime->subMinutes(DeliveryBoy::DeliveryDuration));
            });
        })
        ->get();
    }

}

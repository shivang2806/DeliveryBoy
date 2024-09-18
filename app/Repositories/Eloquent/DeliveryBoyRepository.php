<?php
namespace App\Repositories\Eloquent;

use App\Models\DeliveryBoy;
use App\Repositories\Contracts\DeliveryBoyRepositoryInterface;

class DeliveryBoyRepository implements DeliveryBoyRepositoryInterface {

    public function getAllDeliveryBoys() {
        return DeliveryBoy::all();
    }

    public function getAvailableDeliveryBoys($currentTime) {
        // Get delivery boys who are not busy for the next 30 minutes and who have not reached their capacity
        $busyDeliveryBoys = DeliveryBoy::whereHas('orders', function($query) use ($currentTime) {
            $query->where('delivery_start_time', '>', $currentTime->subMinutes( DeliveryBoy::DeliveryDuration )); // Orders active in the next 30 minutes
        })->pluck('id');

        return DeliveryBoy::whereNotIn('id', $busyDeliveryBoys) // Exclude busy delivery boys
            ->where(function ($query) {
                $query->whereHas('orders', function($query) {
                    // Ensure delivery boys with capacity left
                    $query->havingRaw('COUNT(orders.id) < delivery_boys.max_order_capacity');
                }, '<=', 1);
            })
            ->get();
    }

}

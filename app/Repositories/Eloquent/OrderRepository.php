<?php
namespace App\Repositories\Eloquent;

use App\Models\DeliveryBoy;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Carbon\Carbon;

class OrderRepository implements OrderRepositoryInterface {

    public function getUnassignedOrders() {
        return Order::whereNull('delivery_boy_id')
                    ->where('status', 'pending') // Only fetch pending unassigned orders
                    ->get();
    }

    public function assignOrderToDeliveryBoy($orderId, $deliveryBoyId) {
        $order = Order::find($orderId);
        $order->delivery_boy_id = $deliveryBoyId;
        $order->delivery_start_time = Carbon::now();
        $order->status = 'pending'; // Set status to pending when assigned
        $order->save();

        return $order;
    }

    public function countOrdersForDeliveryBoy($deliveryBoyId) {
        // Count how many active orders the delivery boy currently has
        return Order::where('delivery_boy_id', $deliveryBoyId)
                    ->where('delivery_start_time', '>', Carbon::now()->subMinutes( DeliveryBoy::DeliveryDuration )) // Only consider active deliveries
                    ->count();
    }

    public function updateCompletedOrders() {
        // Update orders where delivery time exceeds 30 minutes and mark them as completed
        return Order::where('status', 'pending')
                    ->where('delivery_start_time', '<', Carbon::now()->subMinutes(DeliveryBoy::DeliveryDuration)) // Orders older than 30 minutes
                    ->update(['status' => 'completed']);
    }
}

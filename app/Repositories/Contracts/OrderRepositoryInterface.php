<?php
namespace App\Repositories\Contracts;

interface OrderRepositoryInterface {
    public function getUnassignedOrders();
    public function assignOrderToDeliveryBoy($orderId, $deliveryBoyId);
    public function countOrdersForDeliveryBoy($deliveryBoyId);
    public function updateCompletedOrders();
}

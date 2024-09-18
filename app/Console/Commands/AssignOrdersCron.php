<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Contracts\DeliveryBoyRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Carbon\Carbon;

class AssignOrdersCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-orders-cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $deliveryBoyRepository;
    protected $orderRepository;

    public function __construct(DeliveryBoyRepositoryInterface $deliveryBoyRepository, OrderRepositoryInterface $orderRepository) {
        parent::__construct();
        $this->deliveryBoyRepository = $deliveryBoyRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $currentTime = Carbon::now();

        // 1. Update order statuses to completed if delivery duration exceeds 30 minutes
        $updatedOrdersCount = $this->orderRepository->updateCompletedOrders();
        if ($updatedOrdersCount > 0) {
            $this->info($updatedOrdersCount . ' orders marked as completed.');
        }

        // 2. Get all unassigned orders
        $unassignedOrders = $this->orderRepository->getUnassignedOrders();

        if ($unassignedOrders->isEmpty()) {
            $this->info('No unassigned orders found.');
            return;
        }

        // 3. Assign each unassigned order to an available delivery boy
        foreach ($unassignedOrders as $order) {
            $availableDeliveryBoys = $this->deliveryBoyRepository->getAvailableDeliveryBoys($currentTime);

            if ($availableDeliveryBoys->isEmpty()) {
                $this->error('No available delivery boys for order ID: ' . $order->id);
                continue;
            }


            // Try to assign order to available delivery boy under capacity
            foreach ($availableDeliveryBoys as $deliveryBoy) {

                $currentOrderCount = $this->orderRepository->countOrdersForDeliveryBoy($deliveryBoy->id);

                // Check if the delivery boy has room for more orders
                if ($currentOrderCount < $deliveryBoy->max_order_capacity) {
                    $this->orderRepository->assignOrderToDeliveryBoy($order->id, $deliveryBoy->id);
                    $this->info('Assigned order ID ' . $order->id . ' to delivery boy ID ' . $deliveryBoy->id);
                    break; // Move to the next order after assigning
                } else {
                    $this->info('Delivery boy ID ' . $deliveryBoy->id . ' is at max capacity.');
                }
            }
        }

    }
}

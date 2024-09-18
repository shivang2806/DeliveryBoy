<?php
namespace App\Repositories\Contracts;

interface DeliveryBoyRepositoryInterface {
    public function getAllDeliveryBoys();
    public function getAvailableDeliveryBoys($currentTime);
}
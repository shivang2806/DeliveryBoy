<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryBoy extends Model
{
    use HasFactory;
    const DeliveryDuration = 2; //min

    protected $fillable = ['name', 'capacity']; // Assuming delivery boys have name and capacity

    // Define the one-to-many relationship with orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

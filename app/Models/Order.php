<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'delivery_boy_id', 'delivery_start_time'];

    // Define the inverse of the one-to-many relationship
    public function deliveryBoy()
    {
        return $this->belongsTo(DeliveryBoy::class);
    }
    
}

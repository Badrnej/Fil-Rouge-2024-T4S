<?php


// app/Models/Delivery.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'package_id', 'delivery_service_id', 'deliverer_id', 'status', 'estimated_delivery', 'actual_delivery'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function deliveryService()
    {
        return $this->belongsTo(DeliveryService::class);
    }

    public function deliverer()
    {
        return $this->belongsTo(User::class, 'deliverer_id');
    }
}

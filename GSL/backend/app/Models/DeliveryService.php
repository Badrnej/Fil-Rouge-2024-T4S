<?php

// app/Models/DeliveryService.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryService extends Model
{
    protected $fillable = [
        'name', 'description', 'created_by'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
}

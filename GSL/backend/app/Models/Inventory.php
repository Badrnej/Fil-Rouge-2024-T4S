<?php

// app/Models/Inventory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'item_name', 'quantity', 'location', 'managed_by', 'last_updated'
    ];

    public function managedBy()
    {
        return $this->belongsTo(User::class, 'managed_by');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    //
     protected $fillable = [
        'item_id','warehouse_id','operation_id',
        'quantity_change','balance_after'
    ];

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }

    // 🔹 الصنف
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // 🔹 المخزن
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    
}

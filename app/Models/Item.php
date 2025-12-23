<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
     protected $fillable = ['name', 'barcode', 'category_id', 'unit_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function operationDetails()
{
    return $this->hasMany(OperationDetail::class);
}

public function stockMovements()
{
    return $this->hasMany(StockMovement::class);
}

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}

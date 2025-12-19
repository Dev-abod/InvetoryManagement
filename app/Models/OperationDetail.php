<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperationDetail extends Model
{
    //
    protected $fillable = ['operation_id','item_id','quantity'];

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

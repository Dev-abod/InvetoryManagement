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
    // السطر الأصلي
    public function originalDetail()
    {
        return $this->belongsTo(OperationDetail::class, 'related_detail_id');
    }

    // الأسطر التي تصحح هذا السطر
    public function corrections()
    {
        return $this->hasMany(OperationDetail::class, 'related_detail_id');
    }
}

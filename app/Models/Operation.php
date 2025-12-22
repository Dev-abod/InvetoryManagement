<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    //
     protected $fillable = [
        'operation_type','number','date','status',
        'warehouse_id','partner_id','user_id','related_operation_id'
    ];

    public function details()
    {
        return $this->hasMany(OperationDetail::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // العملية الأصلية (إذا كانت هذه تصحيح)
    public function originalOperation()
    {
        return $this->belongsTo(Operation::class, 'related_operation_id');
    }

    public function corrections()
    {
        return $this->hasMany(Operation::class, 'related_operation_id');
    }
}

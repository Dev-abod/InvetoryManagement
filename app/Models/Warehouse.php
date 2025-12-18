<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    //
     protected $fillable = ['name', 'location'];
    // in second realation
    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}

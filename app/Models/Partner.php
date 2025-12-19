<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    //
    protected $fillable = ['name', 'type'];

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
}

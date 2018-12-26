<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Courier extends Model
{
    protected $guarded = [];

    public function supervisor(){
        return $this->belongsTo(User::class);
    }

    public function shipments(){
        return $this->hasMany(ShipmentInfo::class);
    }
}

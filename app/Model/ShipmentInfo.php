<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ShipmentInfo extends Model
{
    
    protected $guarded = [];

    public function supervisor(){
        return $this->belongsTo(User::class);
    }

    public function courier(){
        return $this->belongsTo(Courier::class);
    }

    
}

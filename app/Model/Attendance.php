<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Attendance extends Model
{
    protected $guarded = [];

    public function courier(){
        return $this->belongsTo(Courier::class);
    }

    public function supervisor(){
        return $this->belongsTo(User::class);
    }
}

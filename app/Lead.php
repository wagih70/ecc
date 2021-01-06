<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public $fillable = ['request','status_id','user_id'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}

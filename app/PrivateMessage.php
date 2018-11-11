<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}

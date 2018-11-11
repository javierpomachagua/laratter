<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Message extends Model
{
    use Searchable;

    // Columnas protegidas
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageAttribute($image)
    {
        if (!$image || starts_with($image, 'http')) {
            return $image;
        } 

        return \Storage::disk('public')->url($image);
    }
}

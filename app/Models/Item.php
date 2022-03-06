<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function currency()
    {
        return $this->belongsTo(
            Currency::class,
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
        );
    }

    public function getPriceAttribute()
    {
        return optional($this->currency)->toString($this->cost);
    }
}

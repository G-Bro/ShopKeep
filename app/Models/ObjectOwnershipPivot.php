<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ObjectOwnershipPivot extends Pivot
{
    public function access_level()
    {
        return $this->belongsTo(AccessLevel::class);
    }
}

<?php

namespace App\Models;

use App\Traits\FindByTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    use FindByTrait;

    public $timestamps = false;

    public function convert(int $value, Currency $to): float
    {
        return $value / ($to->base_value / $this->base_value);
    }
}

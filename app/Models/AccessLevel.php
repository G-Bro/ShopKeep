<?php

namespace App\Models;

use App\Traits\FindByTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    use HasFactory;
    use FindByTrait;
}

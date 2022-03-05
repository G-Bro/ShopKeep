<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait FindByTrait
{
    public static function findBy(string $column, $value): Model
    {
        return static::where($column, $value)->first();
    }
}
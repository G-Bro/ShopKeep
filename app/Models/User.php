<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function objects()
    {
        return $this->belongsToMany(
            Item::class,
            'object_ownership',
            'user_id',
            'object_id',
        )
            ->withPivot('access_level_id')
            ->using(ObjectOwnershipPivot::class);
    }

    public function items()
    {
        return $this->belongsToMany(
            Item::class,
            'object_ownership',
            'user_id',
            'object_id',
        )
            ->where('object_class', Item::class)
            ->withPivot('access_level_id')
            ->using(ObjectOwnershipPivot::class);
    }

    public function hasOwnership(Model $object, string $access_level_code = 'owner')
    {
        $access_level = AccessLevel::findBy('code',  $access_level_code);
        $ownership = $this->objects()
            ->where('object_class', get_class($object))
            ->where('object_id', $object->id)
            ->first();
        
        if (!$ownership) {
            return false;
        }

        return $ownership->pivot->access_level->level >= $access_level->level;
    }
}

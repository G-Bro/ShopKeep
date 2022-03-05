<?php

namespace App\Models;

use App\Exceptions\InventoryException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(
            Item::class,
            'stores_items',
        )
            ->withPivot('quantity');
    }

    public function getInventory(Item $item)
    {
        if ($existing_record = $this->items()->where('id', $item->id)->first()) {
            return $existing_record->pivot->quantity;
        }

        return 0;
    }

    public function addInventory(Item $item, int $quantity)
    {
        if ($existing_record = $this->items()->where('id', $item->id)->first()) {
            $this->items()->updateExistingPivot(
                $item,
                [
                    'quantity' => $existing_record->pivot->quantity + $quantity
                ]
            );
        } else {
            $this->items()->attach($item, ['quantity' => $quantity]);
        }
    }

    public function takeInventory(Item $item, int $quantity = 1)
    {
        if ($existing_record = $this->items()->where('id', $item->id)->first()) {
            $this->items()->updateExistingPivot(
                $item,
                [
                    'quantity' => $existing_record->pivot->quantity - $quantity
                ]
            );
        } else {
            throw new InventoryException("No stock available for Item #$item->id");
        }
    }
}

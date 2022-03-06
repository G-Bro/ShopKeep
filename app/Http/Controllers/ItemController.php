<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemFromDndBeyondRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function retrieveItem(Item $item, Request $request)
    {
        return new ItemResource($item);
    }

    public function listItems(Request $request)
    {
        $user = $request->user();

        return ItemResource::collection($user->items);
    }

    public function createItem()
    {

    }

    public function updateItem()
    {

    }

    public function deleteItem()
    {
        
    }
}

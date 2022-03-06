<?php

use App\Models\Item;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\postJson;

uses()->group('items', 'controllers');

it('can\'t create an item without providing a name');

it('can delete an item that belongs to you', function () {
    $user = User::factory()
        ->has(
            Item::factory(),
            'items'
        )->create();
    
    $item = $user->items->first();

    actingAs($user);

    $request = deleteJson(
        'item.delete',
        ['item' => $item->id]
    );

    $request->assertStatus(200);
});

it('can\'t delete an item that doesn\'t belong to you', function () {
    $user = User::factory()->create();

    $item = Item::factory()->create();

    actingAs($user);

    $request = deleteJson(
        'item.delete',
        ['item' => $item->id]
    );

    $request->assertStatus(200);
});
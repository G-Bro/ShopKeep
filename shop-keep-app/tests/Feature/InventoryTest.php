<?php

use App\Exceptions\InventoryException;
use App\Models\Item;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

it('can add item to a store', function () {
    // arrange
    $store = Store::factory()->create();
    $item = Item::factory()->create();

    $quantity = 5;

    // act
    $store->addInventory(
        $item,
        $quantity
    );

    // assert
    expect($store->getInventory($item))
        ->toBeInt()
        ->toEqual($quantity);
});

it('can increase stock level of an item in a store', function () {
    // arrange
    $store = Store::factory()->create();
    $item = Item::factory()->create();

    $quantity = 5;

    // act
    // add the item to stock twice and confirm that the quantity goes up each time
    $store->addInventory(
        $item,
        $quantity
    );

    $store->addInventory(
        $item,
        $quantity
    );

    // assert
    expect($store->getInventory($item))
        ->toBeInt()
        ->toEqual($quantity * 2);
});

it('can decrease stock level of an item in a store', function () {
    // arrange
    $store = Store::factory()->create();
    $item = Item::factory()->create();

    $starting_quantity = 5;

    // act
    $store->addInventory(
        $item,
        $starting_quantity
    );

    $store->takeInventory(
        $item,
    );

    // assert
    expect($store->getInventory($item))
        ->toBeInt()
        ->toEqual($starting_quantity - 1);
});

it('can\'t take stock for an item that doesn\'t exist', function () {
        // arrange
        $store = Store::factory()->create();
        $item = Item::factory()->create();
    
        $starting_quantity = 5;
    
        // act   
        $store->takeInventory(
            $item,
            1
        );
})->throws(InventoryException::class);;

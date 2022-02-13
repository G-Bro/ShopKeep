<?php

use App\Models\Item;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

beforeEach(function () { 
    Store::factory()->create();
    Item::factory()->create();
});

it('can add item to a store', function () {
    // arrange
    $store = Store::first();
    $item = Item::first();

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
    $store = Store::first();
    $item = Item::first();

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
    $store = Store::first();
    $item = Item::first();

    $starting_quantity = 5;

    // act
    $store->addInventory(
        $item,
        $starting_quantity
    );

    $store->addInventory(
        $item,
        -1
    );

    // assert
    expect($store->getInventory($item))
        ->toBeInt()
        ->toEqual($starting_quantity - 1);
});

it('can\'t take stock for an item that doesn\'t exist', function () {
        // arrange
        $store = Store::first();
        $item = Item::first();
    
        $starting_quantity = 5;
    
        // act    
        $store->addInventory(
            $item,
            -1
        );
    
        // assert
        expect($store->getInventory($item))
            ->toThrow(InventoryException::class);
});

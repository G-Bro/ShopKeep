<?php

use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->name('user.get')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->controller(ItemController::class)->group(function () {
    Route::name('item.create')->post('/item', 'createItem')
        ->middleware('can:create,item');

    Route::middleware('bindings')->group(function () {
        Route::name('item.get')->get('/item/{item}', 'retrieveItem')
            ->middleware('can:view,item');
        Route::name('items.list')->get('/items/', 'listItems');
        Route::name('item.update')->post('/item/{item}', 'updateItem')
            ->middleware('can:update,item');
        Route::name('item.delete')->delete('/item/{item}', 'deleteItem')
            ->middleware('can:delete,item');
    });
});
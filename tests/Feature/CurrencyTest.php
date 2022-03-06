<?php

use App\Models\Currency;
use Database\Seeders\CurrencySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

uses()->group('currency', 'models');

it('has the correct starting data', function () {
    Artisan::call('db:seed', ['--class' => CurrencySeeder::class]);
    expect(Currency::get()->count())->toEqual(5);
});

it('can accurately convert between currencies', function (int $value, string $from, float $output, string $to) {
    $from_currency = Currency::findBy('code', $from);
    $to_currency = Currency::findBy('code', $to);
    expect($from_currency->convert($value, $to_currency))->toEqual($output);
})->with([
    [ 5, 'gold', 500, 'copper'],
    [ 5, 'gold', 50, 'silver'],
    [ 5, 'gold', 10, 'electrum'],
    [ 5, 'gold', 0.5, 'platinum'],
    [ 5, 'silver', 50, 'copper'],
    [ 5, 'silver', 0.05, 'platinum'],
    [ 123, 'copper', 1.23, 'gold'],
    [ 123, 'copper', 12.3, 'silver'],
    [ 1, 'platinum', 1000, 'copper'],
]);

it('can accurately output price as string', function (int $value, string $currency, string $output) {
    $currency = Currency::findBy('code', $currency);

    expect($currency->toString($value))->toEqual($output);
})->with([
    [5, 'copper', '5cp'],
    [5, 'silver', '5sp'],
    [5, 'electrum', '5ep'],
    [5, 'gold', '5gp'],
    [5, 'platinum', '5pp'],
]);
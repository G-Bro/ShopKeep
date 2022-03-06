<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class)->group('user', 'models');

it('can\'t get user data when not logged in', function () {
    $response = get(route('user.get'));

    $response->assertStatus(302);
});

it('can get user data when logged in', function () {
    $user = User::factory()->create();

    actingAs($user);

    $response = get(route('user.get'));

    $response->assertStatus(200);
});

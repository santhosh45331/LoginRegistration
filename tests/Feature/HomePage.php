<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// Without login or Register to access home 

test('Without login or Register to access home ', function () {
    $response = $this->get('/');
    expect($response->Status())->toBe(200);
    $response->assertSee('ecom ads')
    ->assertSee('login')
    ->assertSee('register');
});


test('users can With login to access home ', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/');

    $response->assertSee('ecom ads')
    ->assertSee($user->name)
    ->assertSee('You are logged in!');
});
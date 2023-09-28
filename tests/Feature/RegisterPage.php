<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

test('it can display the register page and it display the all text', function () {
    $response = $this->get('/register');

    expect($response->Status())->toBe(200);
    $response->assertMiddleware(['web']);
    $response->assertSee('Ecom ADS')
    ->assertSee('Be part of this movement.')
    ->assertSee('CREATE YOUR ACCOUNT')
    ->assertSee('Already a member? ')
    ->assertSee('Name')
    ->assertSee('Email')
    ->assertSee('Password')
    ->assertSee('Show Password')
    ->assertSee('Sign up');
});

//register page Positive test

test('users can register with valid data', function () {
    $response = $this->post('/store', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(302);

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
    ]);
});

//register page Negative test

test('users cannot register with empty data', function () {
    $response = $this->post('/store', [
        'name' => '',
        'email' => '',
        'password' => '',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['name','email','password']);
});

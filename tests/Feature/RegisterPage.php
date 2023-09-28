<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

test('it can display the register page and it display the all text', function () {
    $response = $this->get('/register');

    expect($response->Status())->toBe(200);
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

//register page Negative test

test('users can try to register with empty data', function () {
    $response = $this->post('/store', [
        'name' => '',
        'email' => '',
        'password' => '',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['name','email','password']);
});

test('The user can register with invalid email format', function (string $email) {

    $response = $this->post('/store',[
        'name' => 'Test User',
        'email' => $email, 
        'password' => 'password',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['email']);

})->with(['test', '@gmail.com', 'test@.com', 'testgmail.com']);

test('The user can register with invalid password length', function (string $password) {

    $response = $this->post('/store',[
        'name' => 'Test User',
        'email' => 'test@gmail.com',
         'password' =>$password,]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['password']);

})->with(['s', 'qw', 'qwe', 'qwer', 'qwert', 'qwerty', 'qwertyu']);

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
<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

it('can display the login page', function () {

    $response = $this->get('/login');

    expect($response->Status())->tobe(200);

    $response->assertSee('SALARYAPP')
    ->assertSee('Email address/Mobile Number')
    ->assertSee('password')
    ->assertSee('Forget password')
    ->assertSee('SignIn')
    ->assertSee('Signin with google')
    ->assertSee('Signin with Mobile');

});

it('can log in with valid credentials', function () {

    $user = User::factory()->create();

    $response = $this->post('/login', [

        'email' => $user->email,
        'password' => 'password',

    ]);

    expect($response->Status())->toBe(302);

    $response->assertRedirect('/dashboard');

});

it('cannot log in with invalid credentials', function () {

    $response = $this->post('/login', [

        'email' => 'invalid_user',
        'password' => 'wrong_password',

    ]);

    $response->assertRedirect('/login');
    $this->assertSessionHas('error', 'Invalid Login Credentials');

});


it('cannot log in with invalid email credentials', function () {

    $response = $this->post('/login', [

        'email' => '',
        'password' => 'password',

    ]);

    $response->assertRedirect('/login');
    $this->assertSessionHas('error', 'The email field is required.');

});



it('cannot log in with invalid password credentials', function () {

    $response = $this->post('/login', [

        'email' => 'test@gmail.com',
        'password' => '',

    ]);

    $response->assertRedirect('/login');
    $this->assertSessionHas('error', 'The password field is required.');

});

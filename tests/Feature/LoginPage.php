<?php

use App\Models\User;

test('it can display the login page and it display the all text', function () {
    $response = $this->get('/login');

    expect($response->Status())->toBe(200);
    $response->assertSee('Ecom ADS')
    ->assertSee('Be part of this movement.')
    ->assertSee('SIGNIN YOUR ACCOUNT')
    ->assertSee('Create new account - ')
    ->assertSee('Sign up')
    ->assertSee('Email')
    ->assertSee('Password')
    ->assertSee('Show Password')
    ->assertSee('Forgot password?')
    ->assertSee('Sign in');
});

// Without login or Register to access home 

test('Without login or Register to access home ', function () {
    $response = $this->get('/');
    expect($response->Status())->toBe(200);
    $response->assertSee('ecom ads')
    ->assertSee('login')
    ->assertSee('register');
});

//Login page Positive test

test('The user can log in and be redirected to the dashboard page', function () {
    $user = User::factory()->create();
    //dd($user);
    $response = $this->post('/authenticate', [
        'email' => $user->email,
        'password' => $user->password,
    ]);

    $response->assertStatus(302);
    //dd($user);
    $this->assertDatabaseHas('users', [
        'email' => $user->email,
    ]);
});

//Login page Negative test

test('users cannot log in with invalid credentials', function () {
    $response = $this->post('/authenticate',[
        'email' => '',
        'password' => '',
    ]);
    $response->assertStatus(302);
    $response->assertSessionHasErrors(['email', 'password']);
});


//Login page (password) Negative test

test('users cannot log in with empty password', function () {

    $response = $this->post('/authenticate',[
        'email' => 'test@gmail.com', 'password' =>'',]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['password']);

});


//Login page (email) Negative test

test('users cannot log in with empty email', function () {

    $response = $this->post('/authenticate',[
        'email' => '', 'password' =>'test@gmail.com',]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['email']);
});


test('The user can login with invalid password', function (string $password) {

    $response = $this->post('/authenticate',[
        'email' => 'test@gmail.com', 'password' =>$password,]);

    $response->assertStatus(302);
    $response->assertSessionHas('error', 'Your provided credentials do not match in our records.');

})->with(['s', 'qw', 'qwe', 'qwer', 'qwert', 'qwerty', 'qwertyu', 'qwertyui']);



test('The user can login with invalid email format', function (string $email) {

    $response = $this->post('/authenticate',[
        'email' => $email, 
        'password' =>'test@gmail.com',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['email']);

})->with(['test', '@gmail.com', 'test@.com', 'testgmail.com']);
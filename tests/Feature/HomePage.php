<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

uses(RefreshDatabase::class);

// Without login or Register to access home 

test('Without login or Register to access home ', function () {
    $response = $this->get('/');
    expect($response->Status())->toBe(200);
    $response->assertSee('ecom ads')
    ->assertSee('login')
    ->assertSee('register');
});


test('users can login to access home ', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/');

    $response->assertSee('ecom ads')
    ->assertSee($user->name)
    ->assertSee('You are logged in!');
});

it('blocks invalid characters in the name input field', function (Browser $browser) {
    $browser->visit('http://localhost/LoginRegistration/public/') // Replace with the URL of your page
        ->type('#idname', '123456789') // Type an invalid name with special characters
        ->assertInputValue('#idname', ''); // Assert that the input value is empty

    // You can add more assertions or interactions as needed
});

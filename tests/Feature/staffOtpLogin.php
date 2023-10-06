<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

it('can display the Otplogin page', function () {

    $response = $this->get('/otplogin');

    expect($response->Status())->tobe(200);

    $response->assertSee('Login')
    ->assertSee('Register')
    ->assertSee('Login with Mobile Number ')
    ->assertSee('Select Role and Enter your mobile number to continue ')
    ->assertSee('Select Role')
    ->assertSee('Business Owner ')
    ->assertSee('Use your mobile number to register a new account or access your employer account.')
    ->assertSee('Employee / HR / Adminstrator')
    ->assertSee('To access your account, log in using the mobile number that you registered with your organization.');

});
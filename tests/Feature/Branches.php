<?php

use App\Models\User;
use App\Models\Branch;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});


test('User can access the Branches page without login', function () {

    $response= $this->get('/branch');
    expect($response->Status())->toBe(302);
    $response->assertRedirects('/login');

});


test('User can access the Branches page with login & diisplay the all content', function () {

    $response = $this->actingAs($this->user)->get('/branch');

    expect($response->Status())->toBe(200);

    $response->assertSee('Back')
    ->assertSee('Branches')
    ->assertSee('add new');

});

test('User can access the Add Branch page without login', function () {

    $response= $this->get('/addBranch');
    expect($response->Status())->toBe(302);
    $response->assertRedirects('/login');

});

test('User can access the Add Branche page with login & display the all content', function () {

    $response = $this->actingAs($this->user)->get('/addBranch');

    expect($response->Status())->toBe(200);
    $response->assertSee('back')
    ->assertSee('Branches')
    ->assertSee('Branch Name')
    ->assertSee('Branch Address')
    ->assertSee('Search Location On Map')
    ->assertSee('Radius')
    ->assertSee('Latitude')
    ->assertSee('Longitude')
    ->assertSee('save');

});

test('User can add the new Branche with all valid data', function () {

    $branchename = 'Test Branche';

    $response = $this->actingAs($this->user)->post('/storeBranch',[
        'name'=> $branchename,
        'address' => 'AD Colony, Coimbatore, Tamil Nadu 641004, India',
        'radius' => '0',
        'latitude' => '11.026358332628963',
        'longitude' => '77.00143162204986',
    ]);

    $response->assertStatus(302)
    ->assertHeader('Location','http://localhost/swipebox_backend/staff/branch');

    

    $this->followRedirects($response)
    ->assertSee($branchename)
    ->assertSee('Edit')
    ->assertSee('Delete');

});



test('User can try to add the new Branche with empty data', function () {

    $response = $this->actingAs($this->user)->post('/storeBranch',[
        'name'=> '',
        'address' => '',
        'radius' => '',
        'latitude' => '',
        'longitude' => '',
    ]);

    $response->assertSessionHasErrors(['name','address','radius']);

});


test('User can try to add new branche with empty name', function () {

    $response = $this->actingAs($this->user)->post('/storeBranch',[

        'name'=> '',
        'address' => 'AD Colony, Coimbatore, Tamil Nadu 641004, India',
        'radius' => '0',
        'latitude' => '11.026358332628963',
        'longitude' => '77.00143162204986',

    ]);

    $response->assertSessionHasErrors(['name']);

});


test('User can try to add new branche with empty address', function () {

    $response = $this->actingAs($this->user)->post('/storeBranch',[

        'name'=> 'Test Branche',
        'address' => '',
        'radius' => '0',
        'latitude' => '11.026358332628963',
        'longitude' => '77.00143162204986',

    ]);

    $response->assertSessionHasErrors(['address']);

});


test('User can try to add new branche with empty radius', function () {

    $response = $this->actingAs($this->user)->post('/storeBranch',[

        'name'=> 'Test Branche',
        'address' => 'AD Colony, Coimbatore, Tamil Nadu 641004, India',
        'radius' => '',
        'latitude' => '11.026358332628963',
        'longitude' => '77.00143162204986',

    ]);

    $response->assertSessionHasErrors(['radius']);
    $this->assertDatabaseHas('branch', [
        'name' => 'Test Branche',
    ]);

});


test('User can view the edit branch', function () {

    $branch = Branch::factory()->create();
    $response = $this->actingAs($this->user)->get('/editBranch?id=1');
    expect($response->Status)->toBe(200);
    $response->assertSee($branch->name)
    ->assertSee($branch->address)
    ->assertSee($branch->radius)
    ->assertSee($branch->latitude)
    ->assertSee($branch->longitude);

});


test('User can update the edit branch', function () {

    $branch = Branch::factory()->create();
    $response = $this->actingAs($this->user)->post('/updateBranch',[

        'name'=> $branch->name,
        'address' => $branch->address,
        'radius' => 0,
        'latitude' => $branch->latitude,
        'longitude' => $branch->longitude,

    ]);
    expect($response->Status)->toBe(302);
    $this->assertDatabaseHas('branch', [
        'radius' => 0,
    ]);

});



test('User can delete the branch', function () {

    $branch = Branch::factory()->create();
    $response = $this->actingAs($this->user)->get('/deleteBranch?id=1');
    expect($response->Status)->toBe(302);
});


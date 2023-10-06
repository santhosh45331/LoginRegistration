<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});


test('User can access the Employee designation Setting page without login', function () {

    $response= $this->get('/designation');
    expect($response->Status())->toBe(302);
    $response->assertRedirects('/login');

});


test('User can access the Employee designation Setting page with login & display the all content', function () {

    $response = $this->actingAs($this->user)->get('/designation');

    expect($response->Status())->toBe(200);

    $response->assertSee('Back')
    ->assertSee('Designation Settings')
    ->assertSee('Add Type')
    ->assertSee('NAME')
    ->assertSee('ACTION');

});


test('User can access the Add designation Category & Verify the all content are displayed', function () {

    $response = $this->actingAs($this->user)->get('/designation');

    $response->click('#addlistbutton');

    $this->waitFor('#addlistModal', 5);

    $this->assertSee('Designation')
    ->assertSee('Designation Type')
    ->assertSee('Cancel')
    ->assertSee('save');

});


test('User can add the new Employee designation with all valid data', function () {

    $name = 'Test designation';

    $response = $this->actingAs($this->user)->post('/storeDesignation',[
        'type' => $name,
    ]);

    $response->assertStatus(302)
    ->assertHeader('Location','http://localhost/swipebox_backend/staff/designation');

    $this->followRedirects($response)
    ->assertSee($name);

});


test('User can try to add the new Employee designation with empty data', function () {

    $response = $this->actingAs($this->user)->post('/storeDesignation',[
        'type' => '',
    ]);

    $response->assertSessionHasErrors(['type']);

});




test('User can access the edit Employee designation page & Verify the all content are displayed', function () {

    $designation = Designation::factory()->create();

    $response = $this->actingAs($this->user)->get('/designation');

    $response->click('#editlistbutton1');

    $this->waitFor('#editlistModal1', 5);

    $this->assertSee('Designation')
    ->assertSee('Designation Name')
    ->assertSee($designation->name)
    ->assertSee('Cancel')
    ->assertSee('save');

});



test('User can update the edit Employee designation', function () {

    $designation = Designation::factory()->create();

    $name = 'test designation';

    $response = $this->actingAs($this->user)->post('/updateDesignation',[
        'type' => $name,
    ]);
    expect($response->Status)->toBe(302);
    $this->assertDatabaseHas('designation', [
        'type'=> $name,
    ]);

});



test('User can delete the Employee designation', function () {

    $designation = Designation::factory()->create();
    
    $response = $this->actingAs($this->user)->get('/DesignationDelete?id=1');
    expect($response->Status)->toBe(302);
});



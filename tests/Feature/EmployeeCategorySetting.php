<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});


test('User can access the Employee Category Setting page without login', function () {

    $response= $this->get('/employeeCategory');
    expect($response->Status())->toBe(302);
    $response->assertRedirects('/login');

});


test('User can access the Employee Category Setting page with login & display the all content', function () {

    $response = $this->actingAs($this->user)->get('/employeeCategory');

    expect($response->Status())->toBe(200);

    $response->assertSee('Back')
    ->assertSee('Employee Category Setting')
    ->assertSee('NAME')
    ->assertSee('ACTION');

});


test('User can access the Add Employee Category & Verify the all content are displayed', function () {

    $response = $this->actingAs($this->user)->get('/employeeCategory');

    $response->click('#addlistbutton');

    $this->waitFor('#addlistModal', 5);

    $this->assertSee('Employee Category')
    ->assertSee('Employee Category Type')
    ->assertSee('Cancel')
    ->assertSee('save');

});


test('User can add the new Employee Category with all valid data', function () {

    $name = 'Test Category';

    $response = $this->actingAs($this->user)->post('/storeCategory',[
        'type' => $name,
    ]);

    $response->assertStatus(302)
    ->assertHeader('Location','http://localhost/swipebox_backend/staff/employeeCategory');

    $this->followRedirects($response)
    ->assertSee($name);

});


test('User can try to add the new Employee Category with empty data', function () {

    $response = $this->actingAs($this->user)->post('/storeCategory',[
        'type' => '',
    ]);

    $response->assertSessionHasErrors(['type']);

});




test('User can access the edit Employee Category & Verify the all content are displayed', function () {

    $empcat = EmployeeCategory::factory()->create();

    $response = $this->actingAs($this->user)->get('/employeeCategory');

    $response->click('#editlistbutton1');

    $this->waitFor('#editlistModal1', 5);

    $this->assertSee('Edit Employee Category')
    ->assertSee('Employee Category Name')
    ->assertSee($empcat->name)
    ->assertSee('Cancel')
    ->assertSee('save');

});



test('User can update the edit Employee Category', function () {

    $empcat = EmployeeCategory::factory()->create();

    $name = 'test Category';

    $response = $this->actingAs($this->user)->post('/updateCategory',[
        'type' => $name,
    ]);
    expect($response->Status)->toBe(302);
    $this->assertDatabaseHas('Category', [
        'name'=> $name,
    ]);

});



test('User can delete the Employee Category', function () {

    $shift = Shift::factory()->create();
    
    $response = $this->actingAs($this->user)->get('/CategoryDelete?id=1');
    expect($response->Status)->toBe(302);
});



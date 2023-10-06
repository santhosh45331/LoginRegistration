<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});


test('User can access the Shift Setting page without login', function () {

    $response= $this->get('/shiftList');
    expect($response->Status())->toBe(302);
    $response->assertRedirects('/login');

});


test('User can access the Shift Setting page with login & display the all content', function () {

    $response = $this->actingAs($this->user)->get('/shiftList');

    expect($response->Status())->toBe(200);

    $response->assertSee('Back')
    ->assertSee('Shift Settings')
    ->assertSee('add new');

});

test('User can access the Add shift & Verify the all content are displayed', function () {

    $response = $this->actingAs($this->user)->get('/shiftList');

    $response->click('#addlistbutton');

    $this->waitFor('#addlistModal', 5);

    $this->assertSee('Add Shift')
    ->assertSee('Shift Name')
    ->assertSee('Shift Start Time')
    ->assertSee('Shift End time')
    ->assertSee('Half Intervals')
    ->assertSee('To fix first half and Second half for taking half day leaves.')
    ->assertSee('First Half')
    ->assertSee('Start Time')
    ->assertSee('End time')
    ->assertSee('Second Half')
    ->assertSee('Start Time')
    ->assertSee('End time')
    ->assertSee('Total Shift Hours')
    ->assertSee('Cancel')
    ->assertSee('save');

});

test('User can add the new shift with all valid data', function () {

    $name = 'Morning Shift';

    $response = $this->actingAs($this->user)->post('/shiftStore',[
        'name' => $name,
        'start_time' => '09:00 AM',
        'end_time' => '05:00 PM',
        'shift_day_type' => '1',
        'first_half_start_time' => '09:00 AM',
        'first_half_end_time' => '01:00 PM',
        'second_half_start_time' => '02:00 PM',
        'second_half_end_time' => '05:00 AM',
        'totalShiftTime' => '08:00',
    ]);

    $response->assertStatus(302)
    ->assertHeader('Location','http://localhost/swipebox_backend/staff/shiftList');

    $this->followRedirects($response)
    ->assertSee($name)
    ->assertSee('Edit')
    ->assertSee('Delete')
    ->assertSee('Manage Employees');

});



test('User can try to add the new shift with empty data', function () {

    $response = $this->actingAs($this->user)->post('/shiftStore',[
        'name' => '',
        'start_time' => '',
        'end_time' => '',
        'shift_day_type' => '',
        'first_half_start_time' => '',
        'first_half_end_time' => '',
        'second_half_start_time' => '',
        'second_half_end_time' => '',
        'totalShiftTime' => '',
    ]);

    $response->assertSessionHasErrors(['name']);

});


test('User can access the edit shift & Verify the all content are displayed', function () {

    $shift = Shift::factory()->create();

    $response = $this->actingAs($this->user)->get('/shiftList');

    $response->click('#editlistbutton1');

    $this->waitFor('#editlistModal1', 5);

    $this->assertSee('Edit Shift')
    ->assertSee('Shift Name')
    ->assertSee($shift->name)
    ->assertSee('Shift Start Time')
    ->assertSee($shift->shiftstarttile)
    ->assertSee('Shift End time')
    ->assertSee($shift->shiftendtime)
    ->assertSee('Half Intervals')
    ->assertSee('To fix first half and Second half for taking half day leaves.')
    ->assertSee('First Half')
    ->assertSee('Start Time')
    ->assertSee($shift->fhstarttime)
    ->assertSee('End time')
    ->assertSee($shift->fhendtime)
    ->assertSee('Second Half')
    ->assertSee('Start Time')
    ->assertSee($shift->shstarttime)
    ->assertSee('End time')
    ->assertSee($shift->shendtime)
    ->assertSee('Total Shift Hours')
    ->assertSee($shift->totalshifthours)
    ->assertSee('Cancel')
    ->assertSee('update');

});



test('User can update the edit shift', function () {

    $shift = Shift::factory()->create();

    $name = 'test shift';

    $response = $this->actingAs($this->user)->post('/updateShift',[
        'name' => $name,
        'start_time' => '09:00 AM',
        'end_time' => '05:00 PM',
        'shift_day_type' => '1',
        'first_half_start_time' => '09:00 AM',
        'first_half_end_time' => '01:00 PM',
        'second_half_start_time' => '02:00 PM',
        'second_half_end_time' => '05:00 AM',
        'totalShiftTime' => '08:00',
    ]);
    expect($response->Status)->toBe(302);
    $this->assertDatabaseHas('shift', [
        'name'=> $name,
    ]);

});



test('User can delete the shift', function () {

    $shift = Shift::factory()->create();
    
    $response = $this->actingAs($this->user)->get('/deleteShift?id=1');
    expect($response->Status)->toBe(302);
});

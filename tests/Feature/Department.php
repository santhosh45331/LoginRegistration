<?php

use App\Models\User;
use App\Models\Branch;
use App\Models\Department;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});


test('User can access the Department page without login', function () {

    $response= $this->get('/departmentList');
    expect($response->Status())->toBe(302);
    $response->assertRedirects('/login');

});


test('User can access the Department page with login & display the all content', function () {

    $response = $this->actingAs($this->user)->get('/departmentList');

    expect($response->Status())->toBe(200);

    $response->assertSee('Back')
    ->assertSee('Departments')
    ->assertSee('add new');

});

// test('User can access the Add Department page without login', function () {

//     $response= $this->get('/departmentList', ['adddepartment' => 'add new'] );
//     expect($response->Status())->toBe(302);
//     $response->assertRedirects('/login');

// });

test('User can access the Add Department & Verify the all content are displayed', function () {

    $response = $this->actingAs($this->user)->get('/departmentList');

    $response->click('#adddepartmentbutton');

    $this->waitFor('#adddepartmentModal', 5);

    $this->assertSee('Add Department')
    ->assertSee('Department Name')
    ->assertSee('Branch')
    ->assertSee('Cancel')
    ->assertSee('Submit');

});

test('User can add the new Department with all valid data', function () {

    $branch = Branch::factory()->create();

    $departmentname = "test_department";

    $response = $this->actingAs($this->user)->post('/departmentStore',[
        'name' => $departmentname,
        'branch' => 1,
    ]);

    $response->assertStatus(302)
    ->assertHeader('Location','http://localhost/swipebox_backend/staff/departmentList');

    $this->followRedirects($response)
    ->assertSee($departmentname)
    ->assertSee('Edit')
    ->assertSee('Delete')
    ->assertSee('Manage Employees');

});



test('User can try to add the new department with empty data', function () {

    $response = $this->actingAs($this->user)->post('/departmentStore',[
        'name' => '',
        'branch' => '',
    ]);

    $response->assertSessionHasErrors(['name','branch']);

});


test('User can try to add new department with empty name', function () {

    $branch = Branch::factory()->create();

    $response = $this->actingAs($this->user)->post('/departmentStore',[
        'name' => '',
        'branch' => 1,
    ]);

    $response->assertSessionHasErrors(['name']);

});


test('User can try to add new department with empty branch', function () {

    $departmentname = "test_department";

    $response = $this->actingAs($this->user)->post('/departmentStore',[
        'name' => $departmentname,
        'branch' => '',
    ]);

    $response->assertSessionHasErrors(['branch']);

});


test('User can view the edit department', function () {

    $branch = Branch::factory()->create();

    $department = Department::factory()->create();
    
    $response = $this->actingAs($this->user)->get('/departmentList');
    // $response = $this->actingAs($this->user)->get('/edit-department?id=1');

    $response->click('#editdepartmentbutton1');

    $this->waitFor('#editdepartmentModal', 5);

    $this->assertSee('Edit Department')
    ->assertSee('Department Name')
    ->assertSee($department->name)
    ->assertSee('BraAssign Department headnch')
    ->assertSee($department->departmenthead)
    ->assertSee('Branch')
    ->assertSee($department->branch)
    ->assertSee('Cancel')
    ->assertSee('Submit');

});


test('User can update the edit department', function () {

    $branch = Branch::factory()->create();

    $department = Department::factory()->create();

    $name = 'test_department';

    $response = $this->actingAs($this->user)->post('/updateDepartment',[

        'name'=> $name,
        'employee' => $department->employee,
        'branch' => $department->branch,

    ]);
    expect($response->Status)->toBe(302);
    $this->assertDatabaseHas('department', [
        'name'=> $name,
    ]);

});



test('User can delete the department', function () {

    $branch = Branch::factory()->create();

    $department = Department::factory()->create();
    
    $response = $this->actingAs($this->user)->get('/deleteDepartment?id=1');
    expect($response->Status)->toBe(302);
});

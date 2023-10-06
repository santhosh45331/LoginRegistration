<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DepartmentTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */


    //  public function testcheckDepartment(): void
    // {

    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('https://web1.swipebox.in/staff/login')
    //         ->type('#email-address', '9363402062')
    //         ->type('#current_password', '123456')
    //         ->clickLink('SignIn')
    //         ->pause(2000);
    //         $browser->dump();
    //     });
    // }


    // public function testAddDepartment(): void
    // {
    //     $this->browse(function (Browser $browser) {

    //         $browser->visit('http://localhost/swipebox_backend/staff/departmentList')
    //         ->press('Add New')
    //         ->waitForText('Add Department', 10)
    //         ->assertSee('Add Department')
    //         ->type('#name', '1234567890-=[];,./`~!@#$%^&*()_+{}:"<>?')
    //         ->assertInputValue('#name', '')
    //         ->type('#name', 'test_department')
    //         ->assertInputValue('#name', 'test_department')
    //         ->select('branch', '142')
    //         ->assertInputValue('#branch', 'Ecom Ads Private limited')
    //         ->press('Submit')
    //         ->waitForText('test_department', 10);
    //     });

    // }

    // public function testEditDepartment(): void
    // {
    //     $this->browse(function (Browser $browser) {

    //         $browser->visit('http://localhost/swipebox_backend/staff/departmentList')
    //         ->pressUsingXPath('/html/body/div[1]/div[2]/div[2]/div/div[3]/div[5]/div/div[1]/button')
    //         ->waitForText('Edit Department', 10)
    //         ->assertSee('Edit Department')
    //         ->assertInputValue('#name', 'test_department')
    //         ->type('#name', '1234567890-=[];,./`~!@#$%^&*()_+{}:"<>?')
    //         ->assertInputValue('#name', '')
    //         ->type('#name', 'test_edit_department')
    //         ->assertInputValue('#name', 'test_edit_department')
    //         ->assertInputValue('#branch', 'Ecom Ads Private limited')
    //         ->press('Submit')
    //         ->waitForText('test_edit_department', 10);


    //     });
        
    // }
}

<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            
            $browser->visit('http://localhost/LoginRegistration/public/')
                ->type('#idname', '123456')
                ->assertInputValue('#idname', ''); 

        });
    }

    public function testBasicExample1(): void
    {
        $this->browse(function (Browser $browser) {

            $name = 'ssdfghjk';

            $browser->visit('http://localhost/LoginRegistration/public/')
                ->type('#idname', $name)
                ->assertInputValue('#idname', $name); 

        });
    }

    public function testBasicExample2(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('http://localhost/LoginRegistration/public/login')
                ->type('#lemail', 'demotest@gmail.com')
                ->type('#lpassword', 'demotest@gmail.com')
                ->click('input[type="submit"][value="Sign in"]')
                ->pause(2000);

                $currentUrl = $browser->driver->executeScript('return window.location.href;');
                dump($currentUrl);


                $browser->type('#idname', '123456')
                ->assertInputValue('#idname', ''); 
                

        });
    }
}

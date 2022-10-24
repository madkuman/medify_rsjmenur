<?php

namespace Tests\Browser\TestCases;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UnauthenticatedTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicUnauthenticated()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Selamat datang di')
                    ->assertSee(config('app.name'));
        });
    }

    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->type('#email', 'kevin@medify.id')
                    ->type('#login-password', "123456")
                    ->click('#login-button')
                    ->assertSee('Home')
                    ->assertSee('SuperAdmin');
        });
    }
}
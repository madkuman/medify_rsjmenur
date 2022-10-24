<?php

namespace Tests\Browser\TestCases\Radiologi;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class TransaksiTest extends DuskTestCase
{
    static protected $link = "radiologi";
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testHome()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(self::$link)
                    ->assertSee('Radiologi');
        });
    }

}
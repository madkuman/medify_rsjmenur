<?php

namespace Tests\Browser\TestCases\LabPK;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class TransaksiTest extends DuskTestCase
{
    static protected $link = "labpk";
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
                    ->assertSee('Laboratorium Patologi Klinis');
        });
    }

}
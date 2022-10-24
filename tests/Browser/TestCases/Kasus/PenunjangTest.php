<?php

namespace Tests\Browser\TestCases\Kasus;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class PenunjangTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testDaftar()
    {
        $this->browse(function (Browser $browser) {
            $urj = true;
            $igd = false;
            $browser->loginAs(User::find(2))
                    ->visit('/')
                    ->waitUntilMissing('.spinner', 5);
            // $browser->with('#kasus-rawatinap-container kasus-rawatinap-empty', function ($modal) use(&$inap) {
            //     $urj = true;
            // });
            // dd($urj);
            if($urj){
                $browser->click('#main-container > div > div > div.col-xl-6 > div > div > div > ul > li:nth-child(2)');
                $browser->pause(3000);
                $browser->assertVisible('#kasus-rawatjalan-container > li:nth-child(3)');
                if(!$igd){
                    // dd($igd);
                    $browser->click('#kasus-rawatjalan-container > li:nth-child(3)');
                    $browser->assertSee('INFORMASI UMUM')
                            ->click('#main-container > div.content > div > div.col-lg-4.col-xl-3 > div > div > div > a:nth-child(4)')
                            ->assertVisible('#nav-permintaan');
                }
            }

            if($igd){

            }
                    // ->click('#renderPasien > tr:nth-child(1) > td:nth-child(7) > a')
                    // ->assertSee('INFORMASI PASIEN')
                    // ->click('#main-container > div.container > div > div > div.row.mx-0.mb-20 > div.col-lg-11.col-sm-12.px-0.row.mx-0 > div.col-lg-7.full-only > a.btn.btn-primary.pull-right') //Daftar Pelayanan button
                    // ->assertSee('FORM PENDAFTARAN LAYANAN');

            // $browser->scrollToElement('#buttonSubmit')
            //         ->click('#buttonSubmit');
            
            // $browser->select('poli', 1)
            //         ->scrollToElement('#buttonSubmit')
            //         ->click('#buttonSubmit')
            //         ->waitFor('.swal2-container', 15)
            //         ->assertSee('Berhasil');
            // $browser->click('.swal2-confirm')
            //         ->assertSee("Pendaftaran Pasien Selesai!");
        
        });
    }

}
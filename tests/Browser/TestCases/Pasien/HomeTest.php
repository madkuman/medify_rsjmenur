<?php

namespace Tests\Browser\TestCases\Pasien;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class HomeTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicDashboard()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/pasien')
                    ->assertSee('Daftar Pasien');
        });
    }

    public function testCariDashboard()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/api/pasien/get?page=1&keyword=kevin%20alif%20fa')
                    ->assertSee('"current_page":1');
        });
    }

    // public function testPasienBaru()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/pasien/baru');
    //         $browser->screenshot('error');
    //         $browser->click('#jenis_pembayaran_tunai > label')
    //                 ->select('#selectKartuIdentitas')
    //                 ->type('#noIdentitas', mt_rand(100000, 9999999))
    //                 ->type('#namaPasien', 'TEST#'.mt_rand(1, 9999999))
    //                 ->type('birthplace', 'Pochinki')
    //                 ->select('.day', rand(1, 28))
    //                 ->select('.month', rand(0, 11))
    //                 ->select('.year', rand(1965, 2004))
    //                 ->type('address', 'wubba lubba dub dub');
    //         $browser->pause(5000);
    //         $browser->select('#kotaSelect2', '0');
    //         // $browser->script('$("#kecamatanSelect2").val("0").trigger("change");');
    //         $browser->pause(8000);
    //         // $browser->select('#kelurahanSelect2', '0');
    //         $browser->script('$("#kelurahanSelect2").val("0").trigger("change");');
    //         // $browser->select('#kelurahanSelect2', '0');
    //         $browser->type('phone', mt_rand(100000, 9999999))
    //                 ->select('#selectPekerjaan', 'TABIB')
    //                 ->type('#bahasa', 'Indonesia')
    //                 ->type('#suku', 'Aborigin');
    //         //KERABAT
    //         $browser->type('nameKerabat', 'Aldi sujana#'.mt_rand(1, 999999))
    //                 ->type('addressKerabat', 'wubba lubba dubibibi')
    //                 ->type('phoneKerabat', mt_rand(100000, 9999999));
    //         $browser->scrollToElement('#buttonSubmit')
    //                 ->click('#buttonSubmit')
    //                 ->waitFor('.swal2-modal', 10)
    //                 ->assertSee('Berhasil');

    //         // $browser->pause(8000);
    //         // Assert that a dialog has been displayed and that its message matches the given value:

    //         // $browser->whenAvailable('.swal2-modal', function ($modal) {
    //         //     $modal->assertSee('Berhasil')
    //         //           ->press('OK');
    //         // });        
    //     });
    // }
}
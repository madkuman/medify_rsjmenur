<?php

namespace Tests\Browser\TestCases\Pasien;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class PelayananTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testDaftar()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/pasien')
                    ->waitUntilMissing('.spinner', 5)
                    ->click('#renderPasien > tr:nth-child(1) > td:nth-child(7) > a')
                    ->assertSee('INFORMASI PASIEN')
                    ->click('#main-container > div.container > div > div > div.row.mx-0.mb-20 > div.col-lg-11.col-sm-12.px-0.row.mx-0 > div.col-lg-7.full-only > a.btn.btn-primary.pull-right') //Daftar Pelayanan button
                    ->assertSee('FORM PENDAFTARAN LAYANAN');

            $browser->scrollToElement('#buttonSubmit')
                    ->click('#buttonSubmit');
            $browser->with('.swal2-container', function ($modal) {
                $modal->assertSee('Transaksi Gagal')
                      ->click('.swal2-confirm');
            });
            $browser->select('poli', 1)
                    ->scrollToElement('#buttonSubmit')
                    ->click('#buttonSubmit')
                    ->waitFor('.swal2-container', 15)
                    ->assertSee('Berhasil');
            $browser->click('.swal2-confirm')
                    ->assertSee("Pendaftaran Pasien Selesai!");
        
        });
    }

    // public function testCariDashboard()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/api/pasien/get?page=1&keyword=kevin%20alif%20fa')
    //                 ->assertSee('"current_page":1');
    //     });
    // }

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
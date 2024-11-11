<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

include('modules/survey-kepuasan.php');

if (Request::server('HTTP_X_FORWARDED_PROTO') == 'https') {
	URL::forceScheme('https');
}
Route::get('/testing', 'HomeController@testing');

Auth::routes();
Route::get('/admin/user-control/{id}/bypass-login', 'Admin\UserControl\ViewController@bypassLogin');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('api/official-website/dokter/index', 'Website\APIController@dokterIndex');
Route::get('api/official-website/dokter/get/{slug}', 'Website\APIController@dokterSingle');
Route::get('api/official-website/dokter/spesialis', 'Website\APIController@getSpesialis');
Route::get('api/official-website/poli/antrian', 'Website\APIController@getPoliAntrian');
Route::get('api/official-website/rawatinap/ketersediaan-bed', 'Website\APIController@getKetersediaanBed');
Route::get('api/official-website/rawatinap/ketersediaan-rawat-inap', 'Website\APIController@getKetersediaanRawatInap');

Route::get('api/official-website/rawatinap/ketersediaan-bed-kelas-applicare', 'Website\APIController@getKetersediaanBedKelasApplicare');
// Route::get('api/bpjs/sep/search/{nomor_sep}', 'BPJS\API\Sep\ReadController@get');
// Route::get('api/bpjs/referensi/faskes', 'BPJS\API\Referensi\ReadController@getFaskes');

Route::post('labpk/api/LIS/upload', 'LabPK\LIS\ApiController@insertHasilByFile');
Route::get('labpk/api/LIS/import', 'LabPK\ImportController@importLISTarif');
Route::post('labpk/api/LIS/insert-result', 'LabPK\LIS\ApiController@insertHasilByJson');
// Route::get('labpk/api/transaksi/exportPasien', 'LabPK\ImportController@exportPasien');

Route::get('pasien/api/get', 'Pasien\Pasien\ReadController@APIGetPasien');
Route::post('pasien/api/baru', 'Pasien\Pasien\PostController@APICreatePasien');
Route::get('pasien/api/get-pembayaran', 'Pasien\Pasien\ReadController@APIGetPasienPembayaran');
Route::post('pasien/api/pendaftaran/baru', 'Pasien\Pasien\PostController@APIPendaftaranPasienMobile');
Route::post('pasien/api/pendaftaran/batal', 'RawatJalan\Transaksi\PostController@cancel');
Route::get('pasien/api/poli/antrian/{id}', 'RawatJalan\Poliklinik\ReadController@antrianPoliAPI');
include('modules/public.php');
include('modules-api/public.php');
include('modules-api/third-party-medify-online.php');
include('modules/third-party/mobile-bpjs.php');
include('modules/third-party/vclaim-v2.php');
include('modules/third-party/jkn.php');
include('modules/third-party/whatsapp.php');
include('modules/third-party/satusehat.php');
// Route::group(['middleware' => []], function () {
Route::group(['middleware' => ['auth', 'user-activated']], function () {

	include('modules/getting-started.php');

	Route::group(['middleware' => ['getting-started']], function () {
		// Route::group(['middleware' => []], function () {
		Route::get('/', 'HomeController@index')->name('home');
		Route::get('/home', 'HomeController@index')->name('home');
		Route::get('/kasus', 'Kasus\Kasus\ViewController@index');
		Route::get('/tarif', 'Keuangan\Tarif\ViewController@viewOnly');
		Route::get('/kasus/datamedis', 'Kasus\Kasus\ViewController@datamedis');
		Route::get('/diagnosis/search/{keyword}', 'Kasus\Diagnosis\ReadController@searchDiagnosisByKeyword');
		Route::get('/asuransi/search/{keyword}', 'Pasien\Asuransi\ReadController@searchAsuransiByKeyword');
		Route::get('/search', 'SearchController@search');
		// Route::get('/import', 'Kepegawaian\ImportController@rewriteTmtOut');

		include('modules/kasus.php');
		include('modules/gudang.php');
		include('modules/testing.php');
		include('modules/hospital.php');
		include('modules/kepegawaian.php');
		include('modules/gizi.php');
		// include('modules/gizi-backup.php');
		include('modules/radiologi.php');
		include('modules/labpk.php');
		include('modules/labpa.php');
		include('modules/cssd.php');
		include('modules/jenazah.php');
		include('modules/pasien.php');
		include('modules/rekammedis.php');
		include('modules/farmasi.php');
		include('modules/keuangan.php');
		include('modules/aset.php');
		include('modules/alat-medis.php');
		include('modules/kamaroperasi.php');
		include('modules/kasir.php');
		include('modules/harmat.php');
		// include('modules-api/kasus.php');
		include('modules/rawatinap.php');
		include('modules/rawatjalan.php');
		include('modules/igd.php');
		include('modules/laundry.php');
		include('modules/keperawatan.php');
		include('modules/urikkes.php');
		include('modules/profil.php');
		include('modules/settings.php');
		include('modules/group.php');
		include('modules/clinical-pathways.php');
		include('modules/notification.php');
		include('modules/bpjs.php');
		include('modules/humas.php');
		include('modules/k3.php');

		include('modules-api/kasus.php');

		include('modules/online.php');
		include('modules/admin.php');
		include('modules/unit-tindakan.php');
		include('modules/spm.php');
		include('modules/mutu.php');
		include('modules/it.php');
		include('modules/remunerasi.php');
		include('modules/covid19.php');
		include('modules/esakip.php');
		include('modules/eusulan.php');

		Route::view('/monitor', 'monitor.index');
		Route::group(['prefix' => 'api'], function () {

			Route::get('/dokter/get', 'KamarOperasi\Transaksi\ReadController@getdokter');
			Route::get('/search', 'SearchController@ajaxSearch');
			Route::get('/get-kasus-aktif', 'Users\Kasus\ViewController@getKasusAktif');
			Route::post('/arsip-kasus', 'Users\Kasus\ViewController@loadKasus');
			Route::post('/arsip-kasus/load-table', 'Users\Kasus\ViewController@loadTabelKasus');
		});

		Route::group(['prefix' => 'jasa-medis'], function () {
			Route::get('/', 'Users\JasaMedis\ViewController@index');
			Route::get('/paid', 'Users\JasaMedis\ViewController@paid');
		});

		Route::group(['prefix' => 'my'], function () {
			Route::get('/rekam-medis', 'Users\RekamMedis\ViewController@index');
			Route::get('/arsip-kasus', 'Users\Kasus\ViewController@index');
			Route::get('/arsip-kasus/download', 'Users\Kasus\ViewController@download');
			Route::get('/group', 'Users\Group\ViewController@index');
		});

		include('modules/high-level-report.php');
		include('modules-api/third-party-sirs.php');

		Route::group(['prefix' => 'api'], function () {
			include('modules-api/bpjs.php');
			include('modules-api/spm.php');
			Route::get('/search-user', 'SearchController@searchUser');
		});
		Route::get('/api/get-log', 'HomeController@getRequestLog');
	}); /*CLOSE AUTH*/
}); /*CLOSE AUTH*/
Route::get('500', 'ErrorController@_500');

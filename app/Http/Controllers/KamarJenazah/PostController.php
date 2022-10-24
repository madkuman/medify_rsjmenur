<?php

namespace App\Http\Controllers\KamarJenazah;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\KamarJenazah\Permintaan;
use App\Models\KamarJenazah\Transaksi;
use App\Models\KamarJenazah\Tarif;

use Carbon\Carbon;
use DB;

class PostController extends Controller
{
    public function APICreatePermintaan(Request $request)
    {
    	DB::beginTransaction();
    	try{
            // dd($request);
    	   $permintaan = array(
              'pasienid' => $request->input('jenazah_id'),
              'kasus_id' => $request->input('kasus_id'),
              'waktuMeninggal' => $request->input('meninggal'),
              'waktuJemput' => $request->input('jemput'),
              'tempat' => $request->input('tempat'),
              'detailTempat' => $request->input('detailTempat'),
              'kematian' => $request->input('kematian'),
              'detailKematian' => $request->input('detailKematian'),
              'detailDiagnosis' => $request->input('detailDiagnosis'),
              'nik' => $request->input('nik'),
              'nokk' => $request->input('nokk'),
              'status_kependudukan' => $request->input('statusKependudukan'),
              'hubungan_keluarga' => $request->input('hubunganKeluarga'),
              'status_jenazah' => $request->input('statusJenazah'),
              'dikubur' => $request->input('dikubur'),
              'namapenanggung' => $request->input('namapenanggung'),
              'usiapenanggung' => $request->input('usiapenanggung'),
              'kelaminpenanggung' => $request->input('kelaminpenanggung'),
              'hubunganpenanggung' => $request->input('hubunganpenanggung'),
              'nama_pemeriksa' => Auth::user()->name
            );

            $diagnosis = [];
            $countdiagnosis = count($request->input('diagnosis'));

            for ($i=0; $i < $countdiagnosis; $i++) {
                $diagnosis[$i] = $request->input('diagnosis')[$i];
            };

    		$new_permintaan = app('App\Http\Controllers\KamarJenazah\CreateController')->createPermintaan($permintaan,$diagnosis);
            #log ke kasus
            if (!empty($request->input('kasus_id'))) {
                $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                ->create($request->input('kasus_id'),'create','administrasi-jenazah-daftar',$new_permintaan['permintaanBaru']->id);
            }

    		// dd($new_permintaan);
    		$data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Pasien berhasil didaftarkan';
            $data['url'] = 'kamarjenazah/';
            DB::commit();
    	}

    	catch (\Exception $e) {
            DB::rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Pasien gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }

    // public function getCreatedAtAttribute($date)
    // {
    //     return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i');
    // }

    public function APICreateLayanan(Request $request)
    {
        DB::beginTransaction();
        try{
          $layanan = array(
                'namalayanan' => $request->input('layanan_nama'),
                'hargalayanan' => $request->input('layanan_tarif'),
                'jenislayanan' => $request->input('jenis_layanan')
            );

            $new_layanan = app('App\Http\Controllers\KamarJenazah\CreateController')->createTarif($layanan);


            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Layanan berhasil ditambahkan';
            $data['url'] = 'kamarjenazah/layanan';
            DB::commit();

        }

        catch (\Exception $e) {
            DB::rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Layanan gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }

    public function APIEditLayanan(Request $request)
    {
        DB::beginTransaction();
        try{
          $layanan = array(
                'id' => $request->input('id'),
                'namalayanan' => $request->input('layanan_nama'),
                'hargalayanan' => $request->input('layanan_tarif')
            );

            $edit_layanan = app('App\Http\Controllers\KamarJenazah\EditController')->editTarif($layanan);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Pengubahan layanan berhasil';
            $data['url'] = 'kamarjenazah/layanan';
            DB::commit();

        }

        catch (\Exception $e) {
            DB::rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Layanan gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }

    public function APIDeleteLayanan(Request $request)
    {
        DB::beginTransaction();
        try{
          $layanan = array(
                'id' => $request->input('idLayanan'),
            );

            $edit_layanan = app('App\Http\Controllers\KamarJenazah\DeleteController')->deleteTarif($layanan);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Penghapusan layanan berhasil';
            $data['url'] = 'kamarjenazah/layanan';
            DB::commit();

        }

        catch (\Exception $e) {
            DB::rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Layanan gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }

    public function APIDeleteTransaksi(Request $request)
    {
        DB::beginTransaction();
        try{
          $layanan = array(
                'id' => $request->input('transaksi'),
            );
            //var_dump($layanan['id']);
            $edit_layanan = app('App\Http\Controllers\KamarJenazah\DeleteController')->deleteTransaksi($layanan);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Penghapusan transaksi berhasil';
            $data['url'] = 'kamarjenazah/transaksi';
            DB::commit();

        }

        catch (\Exception $e) {
            DB::rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Transaksi gagal dihapus : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }

    public function APINewTransaksi(Request $request)
    {
        DB::beginTransaction();
        try{
          $transaksi = array(
                'selectPeti' => $request->input('selectPeti'),
                'idJenazah' => $request->input('idJenazah'),
                'formalin' => $request->input('selectFormalin'),
                'total' => $request->input('total')
            );
            $layanan = null;

            if (!empty($request->input('layanan'))) {
              // code...
              $countlayanan = count($request->input('layanan'));

              for ($i=0; $i < $countlayanan; $i++) {
                  $layanan[$i] = $request->input('layanan')[$i];
              };
            }

            $edit_layanan = app('App\Http\Controllers\KamarJenazah\CreateController')->newTransaksi($transaksi,$layanan);

            $transaksi = Transaksi::where('permintaan_id', $request->input('idPermintaan'))->get();

            // dd($transaksi[0]->id);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Pembuatan transaksi berhasil';
            $data['url'] = 'kamarjenazah/detil-transaksi/'.$transaksi[0]->id;
            DB::commit();

        }

        catch (\Exception $e) {
            DB::rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Layanan gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }

    public function APIEditTransaksi(Request $request)
    {
        DB::beginTransaction();
        try{
            $transaksi = array(
                'selectPeti' => $request->input('selectPeti'),
                'idJenazah' => $request->input('idJenazah'),
                'formalin' => $request->input('selectFormalin'),
                'total' => $request->input('total'),
                'id' => $request->input('idTransaksi')
            );
            $layanan = null;

            if (!empty($request->input('layanan'))) {
              // code...
              $countlayanan = count($request->input('layanan'));

              for ($i=0; $i < $countlayanan; $i++) {
                  $layanan[$i] = $request->input('layanan')[$i];
              };
            }

            $delete_layanan = app('App\Http\Controllers\KamarJenazah\EditController')->editTransaksi($transaksi,$layanan);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Pembaharuan Invoice berhasil';
            $data['url'] = 'kamarjenazah/detil-transaksi/'.$request->input('idTransaksi');
            DB::commit();

        }

        catch (\Exception $e) {
            DB::rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Layanan gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }

    public function APIDeletePermintaan(Request $request)
    {
        $trx = Transaksi::where('permintaan_id', $request->input('id'))->first();

        $minta = Permintaan::where('id', $request->input('id'))->first()->pasien_id;
        $permintaan = array(
            'id' => $minta
        );
        DB::beginTransaction();
        try{
            $delete_permintaan = app('App\Http\Controllers\KamarJenazah\DeleteController')->deletePermintaan($permintaan);

            if(!is_null($trx)) {
                $transaksi = array(
                    'id' => $trx->id
                );
                $delete_transaksi = app('App\Http\Controllers\KamarJenazah\DeleteController')->deleteTransaksi($transaksi);
            }

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Penghapusan permintaan berhasil';
            $data['url'] = 'kamarjenazah/';
            DB::commit();

        }

        catch (\Exception $e) {
            DB::rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Layanan gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();
        }

        return json_encode($data);
    }
}

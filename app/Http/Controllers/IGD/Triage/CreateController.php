<?php

namespace App\Http\Controllers\IGD\Triage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi;
use App\Models\IGD\Triage;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Hospital\TransaksiMasuk as GlobalTransaksiMasuk;
use App\Models\Hospital\TransaksiMasukDetail as GlobalTransaksiMasukDetail;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function new(Request $request)
    {
        DB::connection('igd')->beginTransaction();
        DB::connection('rekammedis')->beginTransaction();
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        DB::connection('kasir')->beginTransaction();
        try
        {
        	$nama_pasien = $request->input('nama_pasien');
    		$usia_pasien = $request->input('usia_pasien');
            $nama_pengantar=$request->input('nama_pengantar');
            $alamat_pengantar = $request->input('alamat_pengantar');
    		$jenis_kelamin = $request->input('jenis_kelamin');

            $datang=$request->input('datang');
            $transportasi = $request->input('transportasi');
    		$trauma = $request->input('trauma');
            $penyebab=$request->input('penyebab');
            $alasan = $request->input('alasan');

    		$psikologi = $request->input('psikologi');
            $alergi=$request->input('alergi');
            $risiko = $request->input('risiko');

    		$jalan = $request->input('jalan');
            $nafas=$request->input('nafas');
            $sirkulasi = $request->input('sirkulasi');
            $sadar=$request->input('sadar');
            $ruangan_id = $request->input('kategori');

            $anamnesis=$request->input('anamnesis');
            $sistol = $request->input('sistol');
            $diastol=$request->input('diastol');
            $nadi = $request->input('nadi');
            $pernapasan=$request->input('pernapasan');
            $temperatur = $request->input('temperatur');
            $skala_nyeri=$request->input('skala_nyeri');
            $spo=$request->input('spo');
            $keterangan = $request->input('keterangan');
            $kelompok=$request->input('kelompok');

            $transaksi_detail = app('App\Http\Controllers\Hospital\Transaksi\CreateController')->create(8,1,null);

            $transaksi = new Transaksi;
            $transaksi->ruangan_id = $ruangan_id;
            $transaksi->pasien_id = null;
            $transaksi->waktu_masuk = Carbon::now();
            $transaksi->transaksi_masuk_detail_id = $transaksi_detail->id;
            $transaksi->is_karcis_pengunjung = 0;
            $transaksi->is_kartu_baru = 0;
            $transaksi->is_karcis_igd = 0;
            $transaksi->is_file_tni = 0;
            $transaksi->total_retribusi = 0;        
            $transaksi->asal_rujukan = 0; 
            $transaksi->nomor_sep = 0;
            $transaksi->pasien_pembayaran_id = 0;
            $transaksi->save();

            $transaksi_id = $transaksi->id;
            $transaksi = Transaksi::find($transaksi_id);
            $judul_kasus = 'IGD #'.$transaksi_id;
            $lokasi = $transaksi->ruangan->lokasi_id;

            $transaksi_detail = app('App\Http\Controllers\Hospital\Transaksi\EditController')->edit($transaksi_detail->id,$transaksi->id);

            $app = app();
        	$pasien = $app->make('stdClass');        
        	$pasien->id=null;
            $pasien->name=$nama_pasien;
            $pasien->gender=$jenis_kelamin;
            $pasien->address=null;
            $pasien->job=null;
            $pasien->place_of_birth=null;
            $pasien->date_of_birth=null;
            $pasien->photo_thumb="assets/img/placeholder.jpg";
            $pasien->photo_ori="assets/img/placeholder.jpg";
            $pasien->marriage=null;
            $pasien->no_identitas=null;
            $pasien->phone=null;
            $pasien->umur=$usia_pasien;
            //dd($pasien);
            $kasus = app('App\Http\Controllers\Kasus\Kasus\CreateController')->createKasus($judul_kasus,$pasien,$lokasi,$transaksi->id,2,null,null);
            
            if (!empty($sistol)) {
            	$vital = app('App\Http\Controllers\Kasus\VitalSign\CreateController')->create($kasus->nomor_kasus,$request);
            }

            if (!empty($alergi)) {
                $vital = app('App\Http\Controllers\Kasus\Identitas\EditController')->updateIdentitasMedis($request,$kasus->nomor_kasus);
            }

            $transaksi->kasus_id=$kasus->id;
            $transaksi->save();

            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'create','administrasi-igd-daftar',$transaksi->id);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Pasien berhasil didaftarkan';
            $data['url'] = 'igd';

       
            DB::connection('igd')->commit();
            DB::connection('rekammedis')->commit();
            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            DB::connection('kasir')->commit();
            return json_encode($data);

        } catch (\Exception $e) {
           
            DB::connection('igd')->rollback();
            DB::connection('rekammedis')->rollback();
            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            DB::connection('kasir')->rollback();
            
        }
    }

    public function create($data)
    {
        // dd($data);
        $triage = new Triage;
        $triage->datangigd_at = $data['datangigd_at'];
        $triage->cara_datang = $data['cara_datang'];
        $triage->transport_igd = $data['transportasi_ke_igd'];
        $triage->komunikasi = $data['komunikasi'];
        $triage->ganti_anamnesa = $data['keterangan_ganti_anamnesia'];

        $triage->mobility = $data['mobility'];
        $triage->resp = $data['resp'];
        $triage->heartrate = $data['heartrate'];
        $triage->systol = $data['systol'];
        $triage->conscious = $data['conscious'];
        $triage->trauma = $data['trauma'];
        $triage->temp = $data['temp'];
        $triage->score = $data['score'];
        $triage->created_by = $data['creator'];
        $triage->nama_pasien = $data['nama_pasien'];
        $triage->keterangan = $data['keterangan'];
        $triage->kasus_lain = $data['kasus_lain'];
        if (!empty($data['kasus_id'])) {
            $triage->kasus_id = $data['kasus_id'];
            $kasus = app('App\Http\Controllers\Kasus\Kasus\EditController')->updateDatangIgd($data['kasus_id'],$data['datangigd_at']);
        }
        if ($data['ponek']) {
            $triage->ponek_diskriminan = implode(',', $data['ponek']);
        }
        if ($data['p1']) {
            $triage->p1_diskriminan = implode(',', $data['p1']);
        }
        if ($data['p2']) {
            $triage->p2_diskriminan = implode(',', $data['p2']);
        }
        if ($data['p3']) {
            $triage->p3_diskriminan = 1;
        }
        $triage->pertimbangan_khusus_p1 = $data['pertimbangan_khusus_p1'];
        $triage->pertimbangan_khusus_p2 = $data['pertimbangan_khusus_p2'];
        $triage->save();

        return $triage;
    }
}

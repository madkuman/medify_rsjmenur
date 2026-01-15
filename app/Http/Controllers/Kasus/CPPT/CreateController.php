<?php

namespace App\Http\Controllers\Kasus\CPPT;

use App\Models\Kasus\CPPT;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatInap\RuanganVisite;
use App\User;
use Auth, DB;
use Bugsnag;
use Carbon\Carbon;
use App\Models\RawatJalan\Transaksi;

class CreateController extends Controller
{
    static protected $link = "cppt";
    public function createNewCPPT(Request $request, $nomor_kasus, $jenis = null)
    {
        $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
        $kasusId = $kasus->id;
        $discharge_planning = null;

        if ($request->discharge_enable == 1) {
            $discharge_planning = new \stdClass();
            $discharge_planning->discharge_umur = $request->discharge_umur == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_mobilitas = $request->discharge_mobilitas == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_perawatan = $request->discharge_perawatan == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_bantuan = $request->discharge_bantuan == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_perawatan_diri = $request->discharge_perawatan_diri == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_obat = $request->discharge_obat == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_diet = $request->discharge_diet == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_luka = $request->discharge_luka == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_latihan = $request->discharge_latihan == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_tenaga_khusus = $request->discharge_tenaga_khusus == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_medis = $request->discharge_medis == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_fisik = $request->discharge_fisik == 'dicentang' ? 1 : 0;
            $discharge_planning = json_encode($discharge_planning);
        }


        $cppt = new CPPT();
        $cppt->kasus_id = $kasusId;
        $cppt->jenis = $jenis;
        $cppt->preventif = ($request->preventif == 'dicentang') ? 1 : 0;
        $cppt->kuratif = ($request->kuratif == 'dicentang') ? 1 : 0;
        $cppt->rehab = ($request->rehab == 'dicentang') ? 1 : 0;
        $cppt->paliatif = ($request->paliatif == 'dicentang') ? 1 : 0;

        $cppt->subjective = $request->input('subjective');
        $cppt->objective = $request->input('objective');
        $cppt->assessment = $request->input('assessment');
        $cppt->prioritas = $request->input('prioritas');
        $cppt->perkiraan_hari_rawat = $request->input('perkiraan_hari_rawat');
        $cppt->plan = $request->input('plan');
        $cppt->ppa = $request->input('ppa');
        $cppt->discharge_planning = $discharge_planning;
        $cppt->created_by = Auth::user()->id;

        $date = Carbon::now()->toDateString();
        $path_files = [];
        $i = 1;
        if ($request->hasFile('cppt_files')) {

            foreach ($request->file('cppt_files') as $key => $value) {
                $data_files = app('App\Http\Controllers\Functions\ImageUploader')->upload($value, 'cppt');
                $path_files[] = [
                    'id' => $i,
                    'nama_file' => $value->getClientOriginalName(),
                    'path' => $data_files['file_original'],
                ];
                $i++;
            }
            $cppt->cppt_files = json_encode($path_files);
        }
        $cppt->save();

        app('App\Http\Controllers\Kasus\Diagnosis\PostController')->fromCPPTtoDiagnosis($kasusId, $cppt->assessment);

        if ($request->input('todo') == 'on')
            $todo = app('App\Http\Controllers\Kasus\ToDo\CreateController')->create($request->input('instruksi-ppa'), Auth::user()->id, $cppt->id, $kasusId);


        //tagihan visite
        if ($kasus->lokasi->lokasi->departemen->id == 3 && Auth::user()->profesi == 1) {

            $ruangan = Ruangan::where('lokasi_id', $kasus->lokasi->lokasi->id)->first();

            $user = User::find(Auth::user()->id);
            $visite = '';
            if (!empty($user->subspecialty)) {
                $visite = $this->getVisite($ruangan->id, 3);
            } else if (!empty($user->specialty)) {
                $visite = $this->getVisite($ruangan->id, 2);
            } else {
                $visite = $this->getVisite($ruangan->id, 1);
            }
            if (!empty($visite) && !empty($visite->tarif)) {
                $unit_price = $visite->tarif->harga;
                $data['tarif_id'] = $visite->tarif_id;
                $data['tarif_tipe_id'] = 1;
                $data['tarif_kelas'] = $kasus->kelas->id;
                $data['kasus_id'] = $kasus->id;
                $data['desc'] = $visite->tarif->master->deskripsi . ' - ' . Auth::user()->name;
                $data['unit_price'] = $unit_price;
                $data['qty'] = 1;
                $data['lokasi'] = $kasus->lokasi->lokasi->id;
                $data['daftar_harga_id'] = 0;
                $data['sep_id'] = $kasus->sep_id;
                $data['departemen_id'] = 3;
                $createDetail = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
                $cppt->tagihan_detail_id = $createDetail->id;
                $cppt->save();
            }
            // else {
            // DB::connection('kasus')->rollback();
            // $status = -1;
            // $message = 'CPPT gagal dibuat! Harga Visite Belum dimasukkan';
            // $title = 'Gagal!';
            // return redirect('/kasus/'.$nomor_kasus.'/datamedis#cppt')
            // ->with('message', $message)
            // ->with('active_nav','cppt')
            // ->with('title',$title)
            // ->with('status', $status);
            // }

        }

        if ($kasus->lokasi->lokasi->departemen->id == 2 && Auth::user()->profesi == 1 && $kasus->pembayaran->perusahaan->nama != 'Tunai') {

            $poliklinik = Poliklinik::where('lokasi_id', $kasus->lokasi->lokasi->id)->first();
            if (!empty($poliklinik->tarif_dokter_spesialis)) {
                $data['tarif_id'] = $poliklinik->tarif_dokter_spesialis->id;
                $data['tarif_tipe_id'] = 1;
                $data['tarif_kelas'] = $poliklinik->tarif_dokter_spesialis->kelas->id ?? $kasus->kelas->id ?? '0';
                $data['kasus_id'] = $kasus->id;
                $data['desc'] = $poliklinik->tarif_dokter_spesialis->master->deskripsi . ' - ' . Auth::user()->name;
                $data['unit_price'] = $poliklinik->tarif_dokter_spesialis->harga;
                $data['qty'] = 1;
                $data['lokasi'] = $kasus->lokasi->lokasi->id;
                $data['daftar_harga_id'] = 0;
                $data['sep_id'] = $kasus->sep_id;
                $data['departemen_id'] = 2;
                $createDetail = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
                $cppt->tagihan_detail_id = $createDetail->id;
                $cppt->save();
            }
            if (config('medify.third-party.jkn_online.on')) {
                $kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->get($nomor_kasus);
                $transaksi = $kasus->rawat_jalan_transaksi_last_attr;
                $profesi = Auth::user()->profesi;
                if ($kasus->lokasi->lokasi->departemen->id == 2 && $profesi == 1 && $transaksi && $transaksi->task_id_jkn < 5) {
                    $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                    $carbon_today = strtotime($carbon_today) * 1000;
                    $data = [
                        'kodebooking' => $transaksi->id,
                        'taskid' => 5,
                        'waktu' => $carbon_today
                    ];
                    $returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data);
                    $returned = json_decode($returned);
                    $metadata = isset($returned->metadata) ? $returned->metadata : $returned->metaData;
                    if ($metadata->code != "200") {
                        $data_log['kodebooking'] = $transaksi->id;
                        $data_log['response'] = json_encode($returned);

                        app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
                    } else {
                        $data_log['kodebooking'] = $transaksi->id;
                        $data_log['task_id'] = 5;
                        $data_log['waktu'] = $carbon_today;
                        $data_log['response'] = json_encode($returned);
                        $data_log['request'] = $data;

                        app(\App\Http\Controllers\ThirdParty\LogJkn\CreateController::class)->create($data_log);
                    }
                    $transaksi = Transaksi::find($transaksi->id);
                    $transaksi->task_id_jkn = 5;
                    $transaksi->save();
                }
            }
        }


        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasusId, 'create', 'cppt', $cppt->id, $kasusId);
        return $cppt;
    }

    private function getVisite($ruangan_id, $flag)
    {
        $visite = RuanganVisite::where('ruangan_id', $ruangan_id)->where('jenis_dokter', $flag)->first();
        return $visite;
    }

    public function sendToDiagnosis() {}
}

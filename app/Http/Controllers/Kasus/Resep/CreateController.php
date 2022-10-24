<?php

namespace App\Http\Controllers\Kasus\Resep;

use App\Models\Kasus\CPPT;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Lokasi;
use App\Models\Kasus\Resep;
use App\Models\Kasus\ResepDetail;
use App\Models\Kasus\ResepRacikanDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function createNewResep($nomorKasus, Request $request) {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        DB::connection('farmasi')->beginTransaction();
        try
        {
            $kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();
            $kasusId = $kasus->id;
            $pasienId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('pasien_id')->first();

            $farmasi = $request->input('nama-apotek');
            $jenis_resep = $request->input('jenis_resep');
            $kirim_farmasi = $request->input('kirim-farmasi');
            $kategoriObat = $request->input('kategori-obat');
            $tipeObat = $request->input('tipe-obat');
            $jumlahObat = $request->input('jumlah-obat');
            $namaObat = $request->input('nama-obat');
            $racikan = $request->input('racikan');
            $aturanObat = $request->input('aturan-obat');
            $idObat = $request->input('id-obat');
            $racikan_detail_obat = $request->input('racikan-detail-obat');
            $racikan_detail_jumlah = $request->input('racikan-detail-jumlah');

            $resep = new Resep();
            $resep->kasus_id = $kasusId;
            $resep->jenis_resep = $jenis_resep;
            $resep->created_by = Auth::user()->id;
            $resep->save();
            
            $resepId = $resep->id;

            $size = sizeof($namaObat);

            for($i = 0; $i < $size; $i++) {
                $resepDetail = new ResepDetail();
                $resepDetail->kasus_resep_id = $resepId;
                $resepDetail->obat_name = $namaObat[$i];
                $resepDetail->kategori = $kategoriObat[$i];
                $resepDetail->type = $tipeObat[$i];
                $resepDetail->racikan = $racikan[$i];
                $resepDetail->jumlah = $jumlahObat[$i];
                $resepDetail->aturan = $aturanObat[$i];
                if ($resepDetail->kategori != 'racikan') {
                    $resepDetail->obat_id = $idObat[$i];
                }
                $resepDetail->save();

                $this->kirimCatatanObatPx($resepDetail,$kasus->id);

                if($resepDetail->kategori == 'racikan')
                {
                    $racikanDetailObat = json_decode($request->input('racikan-detail-obat')[$i]);
                    $racikanDetalJumlah = json_decode($request->input('racikan-detail-jumlah')[$i]);
                    $racikanDetalNama = json_decode($request->input('racikan-detail-nama')[$i]);

                    foreach($racikanDetailObat as $index => $item_racikan_temp)
                    {

                        $racikanDetail = new ResepRacikanDetail;
                        $racikanDetail->resep_detail_id = $resepDetail->id;
                        $racikanDetail->nama_obat = $racikanDetalNama[$index];
                        $racikanDetail->obat_id = $racikanDetailObat[$index];
                        $racikanDetail->jumlah = $racikanDetalJumlah[$index];
                        $racikanDetail->save();
                    }
                }

            }
            if(empty($kasus->sep_id))
            {
                $noSEP = null;
            }
            else $noSEP = $kasus->sep_id;

            
            if ($kirim_farmasi=="on") {
                $is_video = 0;
                if(isset($kasus->rawat_jalan_transaksi_first) && !empty($kasus->rawat_jalan_transaksi_first) && $kasus->tipe_igd == 0 && $kasus->tipe_mc == 0 && $kasus->tipe_ri == 0 && $kasus->rawat_jalan_transaksi_first->is_video == 1){
                    $is_video = 1;
                }
                $request->merge(['kasus_id' => $kasusId, 'resep_id' => $resepId, 'pasien_id' => $pasienId, 'sep_id' => $noSEP, 'no_redirect' => 1,'is_video' => $is_video]);
                $resep_farmasi = app('App\Http\Controllers\Farmasi\Transaksi\CreateController')->doCreate($request);
                
                $resep->transaksi_id = $resep_farmasi->id;
                $resep->save();
            }
            
            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasusId,'create','resep',$resep->id);

            $status = 1;
            $message = 'Resep berhasil dibuat!';
            $title = 'Berhasil!';


            
            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            DB::connection('farmasi')->commit();
            return back()
            ->with('active_nav','resep')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
         
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('farmasi')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }

    public function kirimCatatanObatPx($data,$kasus_id)
    {
        $obat = new \stdClass();
        if($data->kategori == 'generik'){
            $obat->nama_obat = $data->obat_name;

            $item_template = app('App\Http\Controllers\Farmasi\ItemTemplate\ReadController')->single($data->obat_id);
            if(!empty($item_template) && $item_template->jenis != "Obat"){
                return 1; #abaikan obat generic non obat
            }
            $obat->obat_id = $data->obat_id;
        } else {
            $obat->obat_id = null;
            $obat->nama_obat = $data->racikan;
        }
        $obat->aturan_pemakaian = $data->aturan;
        $obat->rute = $data->type;
        $obat->keterangan = "";

        $check = app('App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien\ReadController')
        ->checkIfExist($kasus_id,$obat->nama_obat, ($data->kategori == 'generik' ? $obat->obat_id : 0), $data->aturan);

        if($check){
            app('App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien\CreateController')
            ->create($obat, $kasus_id);}
        }
    }

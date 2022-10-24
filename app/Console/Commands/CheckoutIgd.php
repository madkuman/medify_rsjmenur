<?php

namespace App\Console\Commands;

use App\Jobs\Keuangan\QueueGeneratePenagihan;
use App\Models\IGD\Transaksi;
use App\Models\IGD\Transaksi as IGDTransaksi;
use App\Models\Kasus\BPJSSEP;
use App\Models\Kasus\Identitas;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\TagihanDetail;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\TarifTipe;
use App\Models\Pasien\PasienPembayaran;
use App\Models\RawatInap\TempatTidur;
use App\Models\RawatInap\Transaksi as RawatInapTransaksi;
use App\Models\RawatJalan\Transaksi as RawatJalanTransaksi;
use Illuminate\Console\Command;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\KasusLokasi;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use Auth;
use Carbon\Carbon;
use Bugsnag;
use Illuminate\Http\Request;
use DB;

class CheckoutIgd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kasus:checkout-igd {date=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto checkout & KRS kasus rawat jalan harian';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        Auth::loginUsingId(1);
        $arguments = $this->arguments();
        $date = $arguments['date'];
        if($date == 0 ) $now = Carbon::now();
        else $now = Carbon::parse($date)->endOfDay();

        //$threshold = $now->copy()->startOfDay()->subDays(30);

        echo "Get kasus...\n";
        $perusahan_tipe_id = [1,2,3]; // asuransi dan umum
        $perusahaan_ids = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getPerusahaanByTipe($perusahan_tipe_id)->pluck('id');
        $pembayaran_ids = IGDTransaksi::whereNotNull('kasus_id')->where('waktu_masuk', '<=', $now)->whereNull('waktu_keluar')->groupBy('pasien_pembayaran_id')->pluck('pasien_pembayaran_id')->toArray();
        $pasien_pembayaran_id = PasienPembayaran::whereIn('id',$pembayaran_ids)->whereIn('perusahaan_id',$perusahaan_ids)->get()->pluck('id');
        $kasus_ids = IGDTransaksi::whereIn('pasien_pembayaran_id',$pasien_pembayaran_id)->whereNotNull('kasus_id')->where('waktu_masuk', '<=', $now)->whereNull('waktu_keluar')->groupBy('kasus_id')->pluck('kasus_id')->toArray();
        $kasus = Kasus::whereIn('id', $kasus_ids)->whereNull('krs_at')->where('tipe_igd',1)->where('tipe_ri',0)->get();

        // CREATE REQUEST FOR KRS & CHECKOUT
        echo "Creating request...\n";
        $request = new \Illuminate\Http\Request();
        $request->replace(['from_scheduler' => 1, 'krs_by' => 1, 'alasan_krs' => 1, 'status_krs' => 1, 'gizi' => null, 'rawatinap' => 1, 'operasi' => 1, 'labpa' => 1, 'labpk' => 1, 'radiologi' => 1, 'farmasi' => null, 'kasir_tujuan' => 3, 'split_piutang' => null]);

        // BEGIN EXEC
        $count = 1;
        $size = count($kasus);
        foreach ($kasus as $key => $item) {
            echo "Checking out ".$count." item of ".$size."...\n";
            try {
                $exec_krs = $this->dataKRS($item->nomor_kasus, $request);
                if (!empty($item->daftar_tagihan_belum_checkout)) {
                    foreach ($item->daftar_tagihan_belum_checkout as $tagihan) {
                        $request->merge(['tagihan_id' => $tagihan->id]);
                        $exec_checkout = $this->checkout($request, $item->nomor_kasus);
                    }
                }
            } catch (Exception $e) {
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            }
            $count++;
        }
        // Kasus::whereIn('id', $kasus)->update([
        //     'krs_at'        => Carbon::now()->toDateTimeString(),
        //     'krs_by'        => 1,
        //     'krs_alasan'    => 'Selesai Pelayanan',
        //     'krs_status'    => 'Membaik'
        // ]);
        echo "done.";
    }

    public function dataKRS($nomor_kasus, Request $request)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('rawatinap')->beginTransaction();
        DB::connection('rawatjalan')->beginTransaction();
        DB::connection('igd')->beginTransaction();
        DB::connection('gizi')->beginTransaction();
        DB::connection('kamaroperasi')->beginTransaction();
        DB::connection('lab_pk')->beginTransaction();
        DB::connection('lab_pa')->beginTransaction();
        DB::connection('radiology')->beginTransaction();
        DB::connection('farmasi')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        DB::connection('rekammedis')->beginTransaction();
        try{
            if(!$this->checkIfPermintaanRanapExist($nomor_kasus) && empty($request->from_scheduler))
            {
                $status = -1;
                $message = 'Pasien gagal di KRS-kan! Terdapat permintaan rawat inap yang belum terselesaikan';
                $title = 'Gagal!';
                return back()
                    ->with('active_nav','pengaturan')
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
            }


            $dateArr = !empty($request->krs_at) ? explode("-", $request->krs_at) : [];
            if(count($dateArr)==3)
                $krs_at = Carbon::now()->setDate($dateArr[2], $dateArr[1], $dateArr[0])
                    ->toDateTimeString();
            else $krs_at = Carbon::now()->toDateTimeString();
            $kasus = Kasus::with('pembayaran.perusahaan.tipe')->where('nomor_kasus',$nomor_kasus)->first();
            $kasus->krs_alasan = $request->alasan_krs;
            $kasus->krs_status = $request->status_krs;
            $kasus->krs_keterangan = $request->krs_keterangan;
            $kasus->krs_at = $kasus->created_at;
            $kasus->krs_by = !empty($request->krs_by) ? $request->krs_by : Auth::user()->id;

            if($kasus->pembayaran && $kasus->pembayaran->perusahaan->tipe->slug == 'bpjs'){
                if($kasus->sep_id != 0 && empty($kasus->sep_id)){
                    $res_krs_bpjs = app('App\Http\Controllers\BPJS\API\Sep\PostController')->sepPulang($kasus->active_sep->no_sep, $krs_at);
                    if($res_krs_bpjs->metaData->code == 200)
                        $kasus->krs_bpjs = 1;
                }
            }

            $kasus->save();

            app('App\Console\Commands\Kasus\Update\LOS')->updateKasus($kasus);
            app('App\Console\Commands\Kasus\Update\LamaPerawatan')->updateLamaPerawatan($kasus);

            if(!empty($request->gizi))
            {
                app('App\Http\Controllers\Gizi\Pemesanan\DeleteController')->deleteKasus($kasus->id,$kasus->krs_at);//gizi
            }
            if(!empty($request->rawatinap))
            {
                app('App\Http\Controllers\RawatInap\Transaksi\EditController')->editKasus($kasus->id);//rawat inap
            }
            if(!empty($request->operasi))
            {
                app('App\Http\Controllers\KamarOperasi\Transaksi\DeleteController')->kasus($kasus->id,$kasus->krs_at);//operasi
            }
            if(!empty($request->labpa))
            {
                app('App\Http\Controllers\LabPA\Transaction\DeleteController')->cancelKrs($kasus->id,$request->alasan_krs);//lab pa
            }
            if(!empty($request->labpk))
            {
                app('App\Http\Controllers\LabPK\Transaksi\DeleteController')->cancelKrs($kasus->id,$request->alasan_krs);//lab pk
            }
            if(!empty($request->radiologi))
            {
                app('App\Http\Controllers\Radiology\Transaction\DeleteController')->cancelKrs($kasus->id,$request->alasan_krs);//radiologi
            }
            if(!empty($request->farmasi))
            {
                app('App\Http\Controllers\Farmasi\Transaksi\DeleteController')->cancelKrs($kasus->id);//farmasi
            }

            //unsubscribe tindakan
            $tindakan = app('App\Http\Controllers\Kasus\Tindakan\EditController')->massUnsubscribe($kasus->id);
            $kembalikan_file_rm = $this->kembalikanFile($kasus);

            $status = 1;
            $message = 'Pasien berhasil di KRS-kan!';
            $title = 'Berhasil!';

            $old_id = $kasus->transaksi_masuk_detail_id;

            $remove = $this
                ->removeKasusPrevTransaksi($kasus->id);

            //update pasien meninggal
            $krs_status = $request->status_krs->nama;
            if ($krs_status=='Meninggal') {
                $death_at = Carbon::createFromFormat('d-m-Y H:i', $request->death_date.' '.$request->death_time, 'Asia/Jakarta');
                $pasien = app('App\Http\Controllers\Pasien\Pasien\EditController')->updatePasienMeninggal($kasus->pasien_id,$death_at);
            }

            //update tirah baring end
            $identitas = Identitas::where('kasus_id',$kasus->id)->first();
            $identitas->tanggal_tirah_baring_end = $krs_at;
            $identitas->save();

            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                ->create($kasus->id,'create','krs',$kasus->id);

            DB::connection('kasus')->commit();
            DB::connection('rawatinap')->commit();
            DB::connection('rawatjalan')->commit();
            DB::connection('igd')->commit();
            DB::connection('gizi')->commit();
            DB::connection('kamaroperasi')->commit();
            DB::connection('lab_pk')->commit();
            DB::connection('lab_pa')->commit();
            DB::connection('radiology')->commit();
            DB::connection('farmasi')->commit();
            DB::connection('mysql')->commit();
            DB::connection('rekammedis')->commit();

            if (empty($request->from_scheduler)) {
                return back()
                    ->with('active_nav','pengaturan')
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
            } else {
                return $status;
            }



        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('rawatinap')->rollback();
            DB::connection('rawatjalan')->rollback();
            DB::connection('igd')->rollback();
            DB::connection('gizi')->rollback();
            DB::connection('kamaroperasi')->rollback();
            DB::connection('lab_pk')->rollback();
            DB::connection('lab_pa')->rollback();
            DB::connection('radiology')->rollback();
            DB::connection('farmasi')->rollback();
            DB::connection('mysql')->rollback();
            DB::connection('rekammedis')->rollback();

        }

    }

    public function removeKasusPrevTransaksi($kasus_id)
    {
        $transaksi_igd = IGDTransaksi::where('kasus_id',$kasus_id)->whereNull('waktu_keluar')->first();
        if(!empty($transaksi_igd)){
            $transaksi_igd->waktu_keluar = $transaksi_igd->waktu_masuk;
            $transaksi_igd->save();
        }

        $transaksi_rawatinap = RawatInapTransaksi::where('kasus_id',$kasus_id)->whereNull('waktu_keluar')->whereIn('status',[1,2])->get();

        foreach($transaksi_rawatinap as $t_inap_transaksi)
        {
            $bed = TempatTidur::find($t_inap_transaksi->tempat_tidur_id);
            if(!empty($bed))
            {
                //JIKA ADA YANG BOOKING UNTUK KAMAR TERSEBUT
                if (!empty($bed->booking_id)) {

                    #jika dia booking, dia belum sempet nempatin ruangan, tapi udah KRS
                    if ($bed->booking_id == $t_inap_transaksi->id) {
                        $t_inap_transaksi->status=3; #set status keluar
                        $t_inap_transaksi->save();

                        $bed->booking_id = NULL;
                        $bed->save();
                    }
                    elseif($bed->transaksi_id == $t_inap_transaksi->id) {

                        #orang pertama pindah
                        $bed->transaksi_id = $bed->booking_id;
                        $bed->booking_id = NULL;
                        $bed->save();
                        if ($t_inap_transaksi->status==1) {
                            $t_inap_transaksi->status=3; #set status keluar
                            $t_inap_transaksi->save();

                            $toi_log = app('App\Http\Controllers\RawatInap\ToiLog\EditController')
                                ->updateKrs($bed->id,$t_inap_transaksi->id);

                            //mindah pasien yang booking (kasus)
                            $new_trans_inap = RawatInapTransaksi::find($bed->transaksi_id);
                            if(!empty($new_trans_inap->kedatangan_at)){
                                #kalo dia sudah konfirmasi kedatangan, maka toi log akan di update
                                #jika belum datang, nanti updateMrs toilog nya waktu dia konfirm kedatangan
                                $toi_log = app('App\Http\Controllers\RawatInap\ToiLog\EditController')
                                    ->updateMrs($bed->id,$new_trans_inap->id);
                            }

                            $new_trans_inap->status=1;
                            $new_trans_inap->save();
                        }
                    }
                }
                else {

                    $toi_log = app('App\Http\Controllers\RawatInap\ToiLog\EditController')
                        ->updateKrs($bed->id,$t_inap_transaksi->id);

                    $bed->transaksi_id = NULL;
                    $bed->save();
                }



                $ruangan = $bed->ruangan;
                $name_ruang = $ruangan->nama_applicare;
                $kode_ruang = $ruangan->kode_applicare;
                $tersedia =  empty($ruangan->count_empty) ? 0 : $ruangan->count_empty;
                $kapasitas = $ruangan->count_bed;
                if(!empty($ruangan->kelas_applicare && config("app.bpjs_enable"))){
                    $data['kelas_applicare'] = $ruangan->kelas_applicare;
                    $data['kode_ruang'] = $kode_ruang;
                    $data['nama_ruang'] = $name_ruang;
                    $data['tersedia'] = $tersedia;
                    $data['kapasitas'] = $kapasitas;
                    $res_applicare = app('App\Http\Controllers\BPJS\API\Applicare\EditController')->editRuangan($data);
                    if(isset($kelas_applicare) && $res_applicare->metadata->code == 1)
                        $ruangan->kelas_applicare = $kelas_applicare;
                }
            }
            $t_inap_transaksi->waktu_keluar = Carbon::now();
            $t_inap_transaksi->save();
        }

        $transaksi_rawatjalan = RawatJalanTransaksi::where('kasus_id',$kasus_id)->whereNull('waktu_keluar')->get();
        foreach ($transaksi_rawatjalan as $item)
        {
            $poli = RawatJalanTransaksi::find($item->id);

            $poli->waktu_keluar = Carbon::now();
            $poli->status = 2;
            $poli->save();
        }
    }

    public function checkIfPermintaanRanapExist($nomor_kasus)
    {
        $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
        $kasus_id = $kasus->id;

        $rawatinap = RawatInapTransaksi::where('kasus_id',$kasus_id)->where('status',0)->where('is_pindah',0)->get();
        if(count($rawatinap) > 0)
            return 0;
        else
            return 1;
    }

    private function kembalikanFile($kasus)
    {
        $data['pasien_id'] = $kasus->pasien_id;
        $data['status'] = 1;
        $data['holder_keterangan'] = '';
        $data['holder_type'] = 2; //grup
        $data['holder_user_id'] = null;
        $rm_group = app('App\Http\Controllers\Group\Group\ReadController')->getRMGroupSlug('rekam-medis');
        $data['holder_group_id'] = $rm_group->id;

        $data['lokasi'] = $kasus->lokasi->lokasi->nama;
        $data['tujuan_id'] = 1;
        $data['jenis'] = 2;

        $data['sender_confirmed_at'] = Carbon::now();
        $data['sender_confirmed_by'] = Auth::user()->id;
        $data['sender_keterangan'] = '';

        $rm_transaksi = app('App\Http\Controllers\RekamMedis\Transaksi\CreateController')->create($data);
    }

    public function checkout(Request $request, $nomor_kasus)
    {
        DB::connection('keuangan')->beginTransaction();
        DB::connection('kasus')->beginTransaction();
        try {
            ini_set('memory_limit', "2048M");
            ini_set('max_execution_time', "300");
            $kasus = Kasus::with(['pembayaran.perusahaan.tipe'])->where('nomor_kasus',$nomor_kasus)->first();
            $tagihan_id = $request->tagihan_id;
            $tagihan = Tagihan::with('kasus')->where('id',$tagihan_id)->first();
            $tagihan->total_bill = TagihanDetail::where('kasus_tagihan_id',$tagihan_id)->sum('subtotal');
            $tagihan->save();

            $jumlah = $tagihan->total_bill;
            $diskon = 0;
            $total = $tagihan->total_bill;
            $pasien_id = $tagihan->kasus->pasien_id;
            $kasir_id = $request->kasir_tujuan;
            $created_at = $kasus->krs_at;
            $updated_at = $kasus->krs_at;
            $tanggal = $kasus->krs_at;
            $transaksi = TagihanDetail::where('kasus_tagihan_id',$tagihan_id)->get();
            $is_split = $request->split_piutang;

            $lokasiNow = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getSingleLokasi($kasus->lokasi->lokasi->id);
            $kategori_id = $lokasiNow->kategori_keuangan_id;
            $keterangan = app('App\Http\Controllers\Kasus\Kasus\ReadController')->getKeteranganPembayaran($kasus->id);

            foreach ($transaksi as $trans) {
                $lokasi_temp = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getSingleLokasi($trans->lokasi_id);

                $trans->tagihan_id = $trans->kasus_tagihan_id;
                $trans->layanan_id = $trans->tarif_id;
                $trans->layanan_string = $trans->desc;
                $trans->departemen_id = $trans->departemen_id;
                $trans->tipe = $trans->tarif_tipe_id;
                $trans->kelas = $tagihan->kasus->kelas->nama;
                $trans->kelas_id = $trans->tarif_kelas_id;
                $trans->harga = $trans->unit_price;
                $trans->diskon = 0;
                $trans->keterangan = "";
                $trans->jumlah = $trans->qty;
                $trans->lokasi = $trans->lokasi_id;
                $trans->kategori = $lokasi_temp->kategori_keuangan_id;
            }

            /*
            if($tagihan->kasus->lokasi->lokasi->departemen->id == 3)//jika lokasi departemen rawat inap
            {
                $tagihanAdminRanap = $this->tambahAdministrasiRawatInap($tagihan_id,$kasus->sep_id);
                $transaksi->push($tagihanAdminRanap);
                $total += $tagihanAdminRanap->subtotal;
                $jumlah = $total;
            }*/

            $sep = '';
            if(!empty($kasus->sep_id))
            {
                if($kasus->pembayaran->perusahaan->tipe->slug == 'bpjs')
                {
                    //UPDATE PLAFON INACBG
                    if(isset($kasus->active_sep->no_sep))
                        app('App\Http\Controllers\Kasus\Kasus\PostController')->autoUpdatePlafon($kasus);

                    $sep = BPJSSEP::find($kasus->sep_id);
                    if(!empty($sep->id)){
                        if($sep->total_plafon > 0){
                            $tagihanSEP = $this->hitungKeuntunganKerugian($kasus->id,$kasus->sep_id,$transaksi,$tagihan_id);
                            if($tagihanSEP->kasus_tagihan_id != 0) {
                                $transaksi->push($tagihanSEP);
                                $total = $sep->total_plafon;
                                $jumlah = $total;
                            }
                        }
                        $sep = ' - SEP '.$kasus->active_sep->no_sep;
                    }
                    else $sep = '- SEP - Tidak Diketahui';
                }
            }

            $asal_layanan = $tagihan->kasus->lokasi->lokasi->departemen->nama;

            $tipe_bayar = $kasus->pembayaran->perusahaan->nama;

            $judul = 'Tagihan '.$tipe_bayar.' - '.$tagihan->kasus->pasien->name.' - RM '.$tagihan->kasus->pasien->no_rm.' - '.$kasus->pembayaran->no_asuransi.$sep;
            $diskon = 0;
            $pasien_id = $pasien_id;
            $pihak_3 = $kasus->pembayaran->perusahaan->nama;
            $kategori_id = $kasus->lokasi->lokasi->id;
            $tanggal_transaksi = $tanggal;
            $transaksi_details = $transaksi;
            $pasien_pembayaran_id = $kasus->pembayaran->id;
            $lokasi_id = $kasus->lokasi->lokasi->id;
            $kategori_bpjs_id = $kasus->lokasi->lokasi->kategori_bpjs_id;
            $kasus_tagihan_id = $tagihan_id;
            $perusahaan_id = $kasus->pembayaran->perusahaan->perusahaan_keuangan_id;

            $transaksi_piutang = app('App\Http\Controllers\Keuangan\Piutang\CreateController')->create($kasir_id,$judul,$jumlah,$diskon,$total,$pasien_id,$pihak_3,$kategori_id,$tanggal_transaksi,$created_at,$updated_at,$transaksi_details,$pasien_pembayaran_id,$lokasi_id,$kasus_tagihan_id,$perusahaan_id,$keterangan,null, $kategori_bpjs_id);


            $tagihan->checkout = 1;
            $tagihan->checkout_at = $tanggal;
            $tagihan->save();

            $status = 1;
            $message = 'Tagihan berhasil di checkout';
            $title = 'Berhasil!';

            DB::connection('keuangan')->commit();
            DB::connection('kasus')->commit();

            if($kasus->pembayaran->perusahaan->tipe->slug == 'bpjs')
                QueueGeneratePenagihan::dispatch(['piutang_id' => $transaksi_piutang->id])
                    ->delay(now()->addSeconds(45));

            if (empty($request->from_scheduler)) {
                return back()
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
            } else {
                return $status;
            }

        }
        catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = 'Tagihan gagal di checkout';
            $title = 'Gagal!';

            DB::connection('keuangan')->rollback();
            DB::connection('kasus')->rollback();

            if (empty($request->from_scheduler)) {
                return back()
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
            } else {
                return $status;
            }
        }

    }

    private function hitungKeuntunganKerugian($kasus_id,$sep_id,$transaksi,$tagihan_id)
    {
        $sep = BPJSSEP::find($sep_id);
        $tagihan = Tagihan::find($tagihan_id);
        $total_tagihan_sep = $transaksi->where('sep_id',$sep_id)->sum('subtotal');
        $sisa = $sep->total_plafon - $total_tagihan_sep;
        $kasus = Kasus::find($kasus_id);
        $kategori_admin = Kategori::where('slug','administrasi')->first();
        $tipe_default = TarifTipe::where('slug','default')->first();
        if ($sisa>0) {

            $tarif_kategori = TarifKategori::where('slug','selisih-biaya-untung')->first();
            $tarif_master = TarifMaster::where('kategori_id',$tarif_kategori->id)->first();
            $tarif = Tarif::where('tarif_master_id',$tarif_master->id)->where('tipe_id',$tipe_default->id)->first();
            $kategori = Kategori::where('slug','selisih-biaya-untung')->first();
        }elseif($sisa<0){
            $tarif_kategori = TarifKategori::where('slug','selisih-biaya-rugi')->first();
            $tarif_master = TarifMaster::where('kategori_id',$tarif_kategori->id)->first();
            $tarif = Tarif::where('tarif_master_id',$tarif_master->id)->where('tipe_id',$tipe_default->id)->first();
            $kategori = Kategori::where('slug','selisih-biaya-rugi')->first();
        }
        else{
            $is_hutang = '';
            $tarif_id = 0;
        }

        if($sisa != 0){
            $sisaDB = new TagihanDetail;
            $sisaDB->kasus_tagihan_id = $tagihan_id;
            $sisaDB->tarif_id = $tarif->id;
            $sisaDB->deskripsi = $tarif_master->deskripsi;
            $sisaDB->lokasi_id = $kasus->lokasi->lokasi->kategori_keuangan_id;
            $sisaDB->kategori_id = $kategori->id;
            $sisaDB->tarif_tipe_id = $tipe_default->id;
            $sisaDB->tarif_kelas_id = $kasus->kelas->id;
            $sisaDB->harga = $sisa;
            $sisaDB->diskon = 0;
            $sisaDB->jumlah = 1;
            $sisaDB->subtotal = $sisa;
            $sisaDB->keterangan = "";
            $sisaDB->sep_id = $sep_id;
            $sisaDB->created_at = Carbon::now();
            $sisaDB->updated_at = Carbon::now();
        }
        else
        {
            $sisaDB = new TagihanDetail;
            $sisaDB->kasus_tagihan_id = 0;
        }

        return $sisaDB;
    }



}

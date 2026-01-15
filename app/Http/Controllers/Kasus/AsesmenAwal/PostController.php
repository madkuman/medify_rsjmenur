<?php

namespace App\Http\Controllers\Kasus\AsesmenAwal;

use App\Models\RawatJalan\Poliklinik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenAwal;
use App\Models\Kasus\AsesmenAwal2;
use App\Models\Kasus\AsesmenAwal3;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\RekonsiliasiObat;
use App\Models\Kasus\RekonsiliasiObatDetail;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\RuanganVisite;
use App\User;
use MPDF;
use Auth;
use DB;
use Bugsnag;
use Carbon\Carbon;

class PostController extends Controller
{
    public function save($nomorKasus, Request $request)
    {
        DB::connection('kasus')->beginTransaction();
        try {
            // dd($request->all());
            $kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();
            if (isset($request->id)) {
                $asesmen = AsesmenAwal::find($request->id);
                $asesmen2 = AsesmenAwal2::find($request->id);
                $asesmen3 = AsesmenAwal3::find($request->id);
            } else {
                $asesmen = new AsesmenAwal;
                $asesmen->save();
                $asesmen2 = new AsesmenAwal2;
                $asesmen2->save();
                $asesmen3 = new AsesmenAwal3;
                $asesmen3->save();
            }
            $input = ['kasus_id' => $kasus->id, 'created_by' => Auth::id(), 'layani_igd_at' => date('Y-m-d', strtotime($request->tanggal_layani)) . " " . $request->jam_layani . ":00"];
            $layani_igd = app('App\Http\Controllers\Kasus\Kasus\EditController')->updateLayaniIgd($kasus->id, date('Y-m-d', strtotime($request->tanggal_layani)) . " " . $request->jam_layani . ":00");
            foreach ($request->all() as $key => $val) {
                if ($key == '_token' || $key == 'id') continue;
                $input[$key] = $val;
            }
            foreach ($asesmen->getTableColumns() as $value) {
                if (
                    $value == 'id' || $value == 'created_at' ||
                    $value == 'updated_at' || $value == 'deleted_at'
                ) continue;
                if (isset($input[$value]))
                    $asesmen->$value = $input[$value];
                else
                    $asesmen->$value = null;
            }

            $is_array = [
                'icd_10_1',
                'icd_10_2',
                'icd_10_3',
                'obat_nama',
                'dosis',
                'jumlah',
                'rute',
                'aturan_pakai',
            ];

            foreach ($asesmen2->getTableColumns() as $value) {
                if (
                    $value == 'id' || $value == 'created_at' ||
                    $value == 'updated_at' || $value == 'deleted_at'
                ) continue;
                if (isset($input[$value])) {
                    if (in_array($value, $is_array)) {
                        $input[$value] = implode('; ', $input[$value]);
                    }
                    $asesmen2->$value = $input[$value];
                } else {
                    $asesmen2->$value = null;
                }
            }
            foreach ($asesmen3->getTableColumns() as $value) {
                if (
                    $value == 'id' || $value == 'created_at' ||
                    $value == 'updated_at' || $value == 'deleted_at'
                ) continue;
                if ($value == 'tindakan_implementasi_keperawatan_array') {
                    $content = [];
                    foreach ($request->tindakan_implementasi_keperawatan_array ?? [] as $key => $value) {
                        $content[] = [
                            'jam_implementasi_keperawatan' => $request->jam_implementasi_keperawatan[$key],
                            'tindakan_implementasi_keperawatan_array' => $request->tindakan_implementasi_keperawatan_array[$key],
                        ];
                    }
                    $asesmen3->tindakan_implementasi_keperawatan_array = json_encode($content);
                } else if (isset($input[$value]))
                    $asesmen3->$value = $input[$value];
                else
                    $asesmen3->$value = null;
            }
            // dd($asesmen3, $asesmen2, $asesmen);
            $asesmen->save();
            $asesmen2->save();
            $asesmen3->id = $asesmen2->id;
            $asesmen3->save();

            $status = 1;

            if (isset($request->id)) {
                $message = 'Asesmen awal berhasil diubah!';
            } else {
                $message = 'Asesmen awal baru berhasil dibuat!';

                // if($kasus->lokasi->lokasi->departemen->id == 3 && Auth::user()->profesi == 1 && $request->jenis == 'Rawat Inap Dokter')
                // {
                //     $ruangan = Ruangan::where('lokasi_id',$kasus->lokasi->lokasi->id)->first();

                //     $user = User::find(Auth::user()->id);
                //     if(!empty($user->subspecialty))
                //     {
                //         $visite = $this->getVisite($ruangan->id,3);
                //     }
                //     else if(!empty($user->specialty))
                //     {
                //         $visite = $this->getVisite($ruangan->id,2);
                //     }
                //     else
                //     {
                //         $visite = $this->getVisite($ruangan->id,1);
                //     }

                //     if(!empty($visite) && !empty($visite->tarif)){
                //         $unit_price = $visite->tarif->harga;

                //         $data['tarif_id'] = $visite->tarif_id;
                //         $data['tarif_tipe_id'] = 1;
                //         $data['tarif_kelas'] = $kasus->kelas->id;
                //         $data['kasus_id'] = $kasus->id;
                //         $data['desc'] = $visite->tarif->master->deskripsi.' - '.Auth::user()->name;
                //         $data['unit_price'] = $unit_price;
                //         $data['qty'] = 1;
                //         $data['lokasi'] = $kasus->lokasi->lokasi->id;
                //         $data['daftar_harga_id'] = 0;
                //         $data['sep_id'] = $kasus->sep_id;
                //         $data['departemen_id'] = 3;
                //         $createDetail = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
                //         $asesmen2->tagihan_detail_id = $createDetail->id;
                //         $asesmen2->save();

                //     }  
                // }

                // if ($kasus->lokasi->lokasi->departemen->id == 2 && Auth::user()->profesi == 1 && $kasus->pembayaran->perusahaan->nama != 'Tunai' && $request->jenis == 'Rawat Jalan Dokter') {
                //     $poliklinik = Poliklinik::where('lokasi_id', $kasus->lokasi->lokasi->id)->first();
                //     if (!empty($poliklinik->tarif_dokter_spesialis)) {
                //         $data['tarif_id'] = $poliklinik->tarif_dokter_spesialis->id;
                //         $data['tarif_tipe_id'] = 1;
                //         $data['tarif_kelas'] = $poliklinik->tarif_dokter_spesialis->kelas->id ?? $kasus->kelas->id ?? '0';
                //         $data['kasus_id'] = $kasus->id;
                //         $data['desc'] = $poliklinik->tarif_dokter_spesialis->master->deskripsi . ' - ' . Auth::user()->name;
                //         $data['unit_price'] = $poliklinik->tarif_dokter_spesialis->harga;
                //         $data['qty'] = 1;
                //         $data['lokasi'] = $kasus->lokasi->lokasi->id;
                //         $data['daftar_harga_id'] = 0;
                //         $data['sep_id'] = $kasus->sep_id;
                //         $data['departemen_id'] = 2;
                //         $createDetail = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
                //         $asesmen2->tagihan_detail_id = $createDetail->id;
                //         $asesmen2->save();
                //     }
                // }
            }
            $title = 'Berhasil!';

            if (!empty($request->alergi_obat) || !empty($request->alergi_makanan) || !empty($request->golongan_darah) || !empty($request->mrs_riwayat_pengobatan) || !empty($request->tinggi_badan) || !empty($request->berat_badan)) {
                if (!empty($request->mrs_riwayat_pengobatan))
                    $request->merge(["riwayat_sakit" => $request->mrs_riwayat_pengobatan]);
                app('App\Http\Controllers\Kasus\Identitas\EditController')
                    ->updateIdentitasMedis($request, $kasus->nomor_kasus);
            }


            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                ->create($kasus->id, 'create', 'AsesmenAwal', $asesmen->id, $kasus->id);

            $rekonsiliasi_obat_id = $this->rekonsiliasiObat($request, $kasus);
            $asesmen2->rekonsiliasi_obat_id = $rekonsiliasi_obat_id;
            $asesmen2->save();

            DB::connection('kasus')->commit();
            return redirect('/kasus/' . $nomorKasus . '/datamedis/asesmenawal')
                ->with('message', $message)
                ->with('active_nav', 'AsesmenAwal')
                ->with('title', $title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();

            $status = -1;
            $message = 'Asesmen awal gagal dibuat!';
            $title = 'Gagal!';

            return redirect('/kasus/' . $nomorKasus . '/datamedis/asesmenawal')
                ->with('message', $message)
                ->with('active_nav', 'AsesmenAwal')
                ->with('title', $title)
                ->with('status', $status);
        }
    }

    private function rekonsiliasiObat($request, $kasus)
    {
        # ref: Controllers\Kasus\Farmasi\Rekonsiliasi\PostController.php > post

        try {
            if (empty($request->id_rekonsiliasi_obat)) {
                $rekon = new RekonsiliasiObat;
                $rekon->kasus_id = $kasus->id;
                $rekon->created_by = Auth::user()->id;
                $message = 'Rekonsiliasi Obat Berhasil Dibuat';
            } else {
                $rekon = RekonsiliasiObat::find($request->id);
                $rekon->updated_by = Auth::user()->id;
                $message = 'Rekonsiliasi Obat Berhasil Di Update';
            };

            $rekon->jenis = "awal";
            $rekon->save();

            foreach ($request->obat_nama ?? [] as $index => $obat_nama) {
                $detail = new RekonsiliasiObatDetail();
                $detail->rekonsiliasi_obat_id = $rekon->id;
                $detail->tanggal = now();
                $detail->obat_nama = $request->obat_nama[$index];
                $detail->dosis = $request->dosis[$index];
                $detail->jumlah = $request->jumlah[$index];
                $detail->rute = $request->rute[$index];
                $detail->aturan_pakai = $request->aturan_pakai[$index];
                $detail->created_by = Auth::user()->id;
                $detail->save();
            }

            $status = 1;
            $title = 'Berhasil!';

            return $rekon->id;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();

            $status = -1;
            $message = 'Transaksi gagal ! Terjadi Kesalahan Server';
            $title = 'Gagal!';

            return back()
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
        }
    }

    public function delete(Request $request, $nomor_kasus)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try {
            // dd($request->all());
            $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
            $id = $request->id;

            $asesmen = AsesmenAwal::find($id);
            if ($asesmen)
                $asesmen->delete();

            $asesmen2 = AsesmenAwal2::find($id);
            if ($asesmen2) {
                if ($asesmen2->tagihan_detail_id) {
                    $tagihan_detail = app('App\Http\Controllers\Kasus\TagihanDetail\ReadController')->getSingle($asesmen2->tagihan_detail_id);
                    if (empty($tagihan_detail->tagihan->checkout)) {
                        $deleteTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\DeleteController')->deleteFromCppt($kasus->nomor_kasus, $asesmen2->tagihan_detail_id);
                    }
                }
                $asesmen2->delete();
            }

            if ($asesmen)
                $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                    ->create($kasus->id, 'delete', 'AsesmenAwal', $asesmen->id, $kasus->id);


            $status = 1;
            $message = 'Asesmen awal berhasil dihapus!';
            $title = 'Berhasil!';

            DB::connection('kasus')->commit();
            return redirect('/kasus/' . $nomor_kasus . '/datamedis/asesmenawal')
                ->with('message', $message)
                ->with('active_nav', 'AsesmenAwal')
                ->with('title', $title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();

            $status = -1;
            $message = 'Asesmen awal gagal dibuat!';
            $title = 'Gagal!';

            return redirect('/kasus/' . $nomor_kasus . '/datamedis/asesmenawal')
                ->with('message', $message)
                ->with('active_nav', 'AsesmenAwal')
                ->with('title', $title)
                ->with('status', $status);
        }
    }

    public function verifikasiDokter(Request $request, $nomor_kasus)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try {
            $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
            $id = $request->id;

            $asesmen2 = AsesmenAwal2::find($id);
            if ($asesmen2) {
                $asesmen2->verified_dokter_at = Carbon::now();
                $asesmen2->verified_dokter_by = Auth::user()->id;
                $asesmen2->save();
            }

            if ($asesmen2)
                $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                    ->create($kasus->id, 'edit', 'AsesmenAwal', $asesmen2->id, $kasus->id);


            $status = 1;
            $message = 'Asesmen awal berhasil diverifikasi!';
            $title = 'Berhasil!';

            DB::connection('kasus')->commit();
            return redirect('/kasus/' . $nomor_kasus . '/datamedis/asesmenawal')
                ->with('message', $message)
                ->with('active_nav', 'AsesmenAwal')
                ->with('title', $title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();

            $status = -1;
            $message = 'Asesmen awal gagal diverifikasi!';
            $title = 'Gagal!';

            return redirect('/kasus/' . $nomor_kasus . '/datamedis/asesmenawal')
                ->with('message', $message)
                ->with('active_nav', 'AsesmenAwal')
                ->with('title', $title)
                ->with('status', $status);
        }
    }

    public function verifikasiNERS(Request $request, $nomor_kasus)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try {
            $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
            $id = $request->id;

            $asesmen2 = AsesmenAwal2::find($id);
            if ($asesmen2) {
                $asesmen2->verified_ners_at = Carbon::now();
                $asesmen2->verified_ners_by = Auth::user()->id;
                $asesmen2->save();
            }

            if ($asesmen2)
                $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                    ->create($kasus->id, 'edit', 'AsesmenAwal', $asesmen2->id, $kasus->id);


            $status = 1;
            $message = 'Asesmen awal berhasil diverifikasi!';
            $title = 'Berhasil!';

            DB::connection('kasus')->commit();
            return redirect('/kasus/' . $nomor_kasus . '/datamedis/asesmenawal')
                ->with('message', $message)
                ->with('active_nav', 'AsesmenAwal')
                ->with('title', $title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();

            $status = -1;
            $message = 'Asesmen awal gagal diverifikasi!';
            $title = 'Gagal!';

            return redirect('/kasus/' . $nomor_kasus . '/datamedis/asesmenawal')
                ->with('message', $message)
                ->with('active_nav', 'AsesmenAwal')
                ->with('title', $title)
                ->with('status', $status);
        }
    }

    private function getVisite($ruangan_id, $flag)
    {
        $visite = RuanganVisite::where('ruangan_id', $ruangan_id)->where('jenis_dokter', $flag)->first();
        return $visite;
    }
}

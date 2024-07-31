<?php

namespace App\Http\Controllers\Kasus\Resep;

use App\Models\Kasus\CPPT;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Resep;
use App\Models\Kasus\ICD10;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\TipeRacikan;
use App\Models\Warehouse\Items;
use App\Models\Pasien\Pasien;

class ReadController extends Controller
{
    public function fetchAllResep($nomorKasus) {

        $kasusId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('id')->first();

        $resep = Resep::where('kasus_id', $kasusId)->with(['resepDetail','transaksi_farmasi.owner_detail'])->orderBy('created_at','desc')->get();
        return $resep;
    }
    public function fetchResepKasus($kasus_id) {
        $resep = Resep::where('kasus_id', $kasus_id)->with(['resepDetail','transaksi_farmasi.owner_detail','doctor'])->orderBy('created_at','desc')->get();
        return $resep;
    }

    public function search(Request $request)
    {
    		$apotek_id = $request->apotek_id;
            $keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
    		$items = Items::search($keyword)->paginate(10);
    		return json_encode($items);
    }
    public function get($nomor_kasus,$id) {
        $resep = Resep::where('id',$id)->with(['resepDetail.item_template', 'resepDetail.racikan_detail','transaksi_farmasi.ori_detail','transaksi_farmasi.final_detail.resep_detail', 'transaksi_farmasi.owner_detail'])->first();
        # == kategori resep
        $resep->resepDetail->map(function ($item) use ($resep) {
            $item->racikan_detail = $item->racikan_detail->map(function ($item) use ($resep) {
                $item->item_farmasi_id = ItemsFarmasi::where('item_template_id', $item->obat_id)->where('farmasi_id', $resep->farmasi_id)->first()->id ?? null;
                return $item;
            });
            $item->item_farmasi_id = ItemsFarmasi::where('item_template_id', $item->obat_id)->where('farmasi_id', $resep->farmasi_id)->first()->id ?? null;
            return $item;
        });
        return json_encode($resep);
    }

    public function historiResep($nomor_kasus)
    {   
        $pasien_id = Kasus::where('nomor_kasus',$nomor_kasus)->pluck('pasien_id')->first();
        $pasien = Pasien::find($pasien_id);
        $all_kasus = Kasus::where('pasien_id',$pasien_id)->pluck('id')->toArray();
        $resep = Resep::whereIn('kasus_id', $all_kasus)->with(['resepDetail','transaksi_farmasi.ori_detail','transaksi_farmasi.owner_detail','kasus'])->orderBy('kasus_id','desc')->get();
        // dd($resep);
        $data['reseps'] = [];
        $data['pasien'] = $pasien;
        foreach ($resep as $value) 
        {   
            if(empty($data['reseps'][$value->kasus_id]))
            {
                $data['reseps'][$value->kasus_id] = [];
                array_push($data['reseps'][$value->kasus_id],$value);   
            }
            else
            {
                array_push($data['reseps'][$value->kasus_id],$value);
            }
        }
        // dd($data);
        return view('kasus.datamedis.content.resep.histori',$data);
    }

    public function hitungHarga(Request $request, $nomor_kasus)
    {
        $kategori_resep = $request->kategori_resep;
        $kasus = $request->kasus;
        $farmasi = Farmasi::find($request->farmasi_id);
        $perusahaan_tipe = $kasus->pembayaran->perusahaan->type ?? null;
        $lokasi_departemen_id = $kasus->lokasi->lokasi->lokasi_departemen_id ?? null;
        $aturan_harga = app(\App\Http\Controllers\Farmasi\AturanHarga\ReadController::class)->filterAturan($farmasi->id, $perusahaan_tipe, $transaksi ?? null, $jenis_pasien ?? null, $lokasi_departemen_id ?? null);
        
        $data_stok_used = [];
        $total = 0;
        $total_embalase = 0;
        $data_obat = [];
        foreach ($request->obat ?? [] as $item) {
            $laba = 0;
            $harga = 0;
            $embalase = 0;
            $jumlah = $item['jumlah'] ?? null;
            if (($item['item_farmasi_id'] ?? 0) != 0) { 
                $max_stok = -1;

                $dosis = $item['dosis'] ?? null;
                $item_farmasi = ItemsFarmasi::find($item['item_farmasi_id'] ?? 0);
                if ($item_farmasi != null) {
                    $max_stok = floatval($item_farmasi->stok);
                    $object_harga_jual = $item_farmasi->hitungHargaJual($aturan_harga, 1, true, $farmasi, ['return_object' => true]);
                    $laba = $object_harga_jual->laba;
                    $harga = round($object_harga_jual->harga);
                    $kekuatan = $item_farmasi->item_template->kekuatan_sediaan;
                    if (!empty($item['dosis'])) {
                        $dosis = $item['dosis'] ?? null;
                        $jumlah = $dosis / ($kekuatan ?? 1);
                    } else {
                        $dosis = $jumlah * $kekuatan;
                    }
                }
                $subtotal = $harga * $jumlah;
                $embalase = 0;
                if ($kategori_resep != 'tpn') {
                    $embalase = app(\App\Http\Controllers\Farmasi\AturanEmbalase\ReadController::class)->hitungEmbalase($farmasi, $perusahaan_tipe, [
                        'tipe_racikan_id' => TipeRacikan::whereSlug('resep-obat-jadi')->first()->id ?? null,
                        'tipe' => 'generik',
                        'jumlah' => $jumlah,
                    ]);
                }
                $total_embalase += $embalase;
                $subtotal += $embalase;
                if ($jumlah != 0) {
                    $harga = $subtotal / $jumlah;
                } else {
                    $harga = 0;
                }
                $total += $subtotal;
                if ($max_stok !== -1) {
                    $max_stok = ($max_stok - array_sum($data_stok_used[$item_farmasi->id ?? 0] ?? []));
                    if ($max_stok < 0) $max_stok = 0;
                }
                $data_obat[] = [
                    'index' => $item['index'],
                    'kategori' => 'generik',
                    'item_farmasi_id' => $item['item_farmasi_id'],
                    'restriksi' => $item_farmasi->item_template->retriksi_bpjs_jumlah ?? '', 
                    'kekuatan' => $kekuatan ?? '', 
                    'satuan' => $item_farmasi->item_template->satuan ?? '',
                    'laba' => $laba,
                    'embalase' => $embalase,
                    'harga' => $harga,
                    'dosis' => $dosis, 
                    'jumlah' => $jumlah, 
                    'max_stok' => $max_stok,
                    'subtotal' => $subtotal
                ];
                if (isset($item_farmasi)) {
                    $data_stok_used[$item_farmasi->id][] = $jumlah;
                }
            } else if (($item['racikan'] ?? 0) != 0) {
                $data_racikan = [];
                $subtotal = 0;
                $laba = 0;
                foreach ($item['racikan'] as $racikan) {
                    $max_stok = -1;
                    $racikan_jumlah = $racikan['jumlah'] ?? null;
                    $harga_racikan = 0; #reset
                    $item_farmasi = ItemsFarmasi::find($racikan['item_farmasi_id'] ?? 0);
                    if ($item_farmasi != null) {
                        $max_stok = floatval($item_farmasi->stok);
                        $harga_racikan = ($item_farmasi->hitungHargaJual($aturan_harga, 1, false, $farmasi, [
                            'laba_round' => false,
                        ]));
                        $kekuatan = $item_farmasi->item_template->kekuatan_sediaan;
                        $restriksi = $item_farmasi->item_template->retriksi_bpjs_jumlah;
                        if (isset($racikan['dosis'])) {
                            $dosis = $racikan['dosis'];
                            $racikan_jumlah = $jumlah * $dosis / ($kekuatan ?? 1);
                        }
                    }
                    $subtotal_racikan = ($harga_racikan * floatval($racikan_jumlah));
                    $subtotal += $subtotal_racikan;
                    if ($max_stok !== -1) {
                        $max_stok = ($max_stok - array_sum($data_stok_used[$item_farmasi->id ?? 0] ?? []));
                        if ($max_stok < 0) $max_stok = 0;
                    }
                    $data_racikan[] = [
                        'racikan_index' => $racikan['racikan_index'] ?? null,
                        'item_farmasi_id' => $item_farmasi->id,
                        'jumlah' => $racikan_jumlah,
                        'max_stok' => $max_stok,
                        'kekuatan' => $kekuatan ?? null,
                        'restriksi' => $restriksi ?? null,
                        'harga_racikan' => $harga_racikan,
                        'subtotal_racikan' => $subtotal_racikan,
                    ];
                    if (isset($item_farmasi)) {
                        $data_stok_used[$item_farmasi->id][] = $racikan_jumlah;
                    }
                }
                # add laba 
				$selected_aturan_harga = app(\App\Http\Controllers\Farmasi\AturanHarga\ReadController::class)->findAturan($aturan_harga, $subtotal, false);
                if ($selected_aturan_harga != null) {
                    $subtotal = $subtotal * ((100 + $selected_aturan_harga->laba) / 100);
                    $laba = $selected_aturan_harga->laba;
                }
                
                # add harga jasa
                if ($kategori_resep == 'dispensing_aseptik') {
                    $embalase = app(\App\Http\Controllers\Farmasi\AturanEmbalase\ReadController::class)->hitungEmbalase($farmasi, $perusahaan_tipe, [
                        'tipe_racikan_id' => TipeRacikan::whereSlug('dispensing-aseptik')->first()->id ?? null,
                        'tipe' => 'racikan',
                        'jumlah' => $jumlah,
                    ]);
                    $total_embalase += $embalase;
                    $subtotal += $embalase;
                } else {
                    if (($item['tipe_racikan_id'] ?? '') != '') {
                        $embalase = app(\App\Http\Controllers\Farmasi\AturanEmbalase\ReadController::class)->hitungEmbalase($farmasi, $perusahaan_tipe, [
                            'tipe_racikan_id' => $item['tipe_racikan_id'],
                            'tipe' => 'racikan',
                            'jumlah' => $jumlah,
                        ]);
                        $total_embalase += $embalase;
                        $subtotal += $embalase;
                    }
                }
                if ($item['jumlah'] != 0) {
                    $harga = round($subtotal / $item['jumlah']);
                    $subtotal = $harga * $item['jumlah'];
                } else {
                    $harga = 0;
                }

                $total += $subtotal;
                $data_obat[] = [
                    'index' => $item['index'],
                    'data_racikan' => $data_racikan,
                    'kategori' => 'racikan',
                    'harga' => $harga,
                    'laba' => $laba,
                    'embalase' => $embalase,
                    'jumlah' => $jumlah, 
                    'subtotal' => $subtotal,
                ];
            } else if (($item['tipe_racikan_id'] ?? '') != '') {
                $subtotal = 0;
                $embalase = app(\App\Http\Controllers\Farmasi\AturanEmbalase\ReadController::class)->hitungEmbalase($farmasi, $perusahaan_tipe, [
                    'tipe_racikan_id' => $item['tipe_racikan_id'],
                    'tipe' => 'racikan',
                    'jumlah' => $jumlah,
                ]);
                $total_embalase += $embalase;
                $subtotal += $embalase;
                $total += $subtotal;
                $harga = $subtotal / $jumlah;
                $data_obat[] = [
                    'index' => $item['index'],
                    'harga' => $harga,
                    'laba' => 0,
                    'embalase' => $embalase,
                    'jumlah' => $jumlah, 
                    'subtotal' => $subtotal
                ];
            }
            
        }
        # add harga jasa
        if ($kategori_resep == 'tpn') {
            $embalase = app(\App\Http\Controllers\Farmasi\AturanEmbalase\ReadController::class)->hitungEmbalase($farmasi, $perusahaan_tipe, [
                'tipe_racikan_id' => TipeRacikan::whereSlug('obat-sediaan-tpn')->first()->id ?? null,
                'tipe' => 'racikan',
                'jumlah' => $jumlah ?? 1,
            ]);
            $total_embalase += $embalase;
            $total += $embalase;
        }

        $sisa_plafon = 0;
        if (!empty($kasus)) {
            $header = $kasus->header;
            $sisa_plafon = $header->sep_total_plafon - $header->sep_total_pemakaian;
        }
        $total_hari23 = round($total * 23 / 30);
        $total_hari7 = $total - $total_hari23;
        $total_sisa_plafon = $sisa_plafon - $total_hari7;
        return response()->json([
            'data' => [
                'data_obat' => $data_obat,
                'total_obat' => $total - $total_embalase,
                'total_embalase' => $total_embalase,
                'total' => $total,
                'total_hari7' => $total_hari7,
                'total_hari23' => $total_hari23,
                'total_sisa_plafon' => $total_sisa_plafon,
            ]
        ]);
    }
}

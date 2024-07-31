<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use App\Models\Hospital\Lokasi;
use App\Models\Hospital\LokasiDepartemen;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\PemasukanDetail;
use App\Models\Keuangan\Perusahaan;
use App\Models\Pasien\PembayaranPerusahaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\TarifKategori;
use Carbon\Carbon;

class PendapatanUnitController extends Controller
{
    public function getTotalData(Request $request)
    {
        $total = TarifKategori::where('parent_id', 0)->count();
        $total = $total + 1; /* farmasi */

        return json_encode([
            'status' => 200,
            'data' => $total
        ]);
    }

    public function getData(Request $request)
    {
        $start = Carbon::parse($request->date)->startOfMonth();
        $end = $start->copy()->endOfMonth();
        $data_fetched = $request->datafetched;
        $limit = $request->limit;
        $perusahaan_ids  = $request->perusahaan;
        $perusahaan_nama = '';
        if(empty($perusahaan_ids))
        {
            $perusahaan_ids = PembayaranPerusahaan::all()->pluck('id')->toArray();
        }else{
            $perusahaan_ids = explode(',',$perusahaan_ids);
            $perusahaan_nama = implode('/ ',PembayaranPerusahaan::whereIn('id',$perusahaan_ids)->pluck('nama')->toArray());
        }

        $data = TarifKategori::where('parent_id', 0)->skip($data_fetched)->take($limit)->orderBy('id', 'asc')->get();

        $array_data = [];
        foreach($data as $index => $item)
        {
            $parent_tarif_kategori_id = $item->id;
            $new_item = new \StdClass();
            $new_item->no = $data_fetched + $index + 1;
            $new_item->unit = $item->nama;
            $new_item->nilai = 'Rp '.number_format($this->getNilai($start,$end,$perusahaan_ids,null,$parent_tarif_kategori_id));
            $array_data[] = $new_item;
        }

        /* farmasi */
        $idx = count($array_data);
        $lokasi_ids = Lokasi::whereHas('departemen', function ($query){
                            $query->where('slug', 'farmasi');
                        })->pluck('id')->toArray();

        if (!empty($lokasi_ids)) {
            $new_item_farm = new \StdClass();
            $new_item_farm->no = $idx + 1;
            $new_item_farm->unit = 'FARMASI';
            $new_item_farm->nilai = 'Rp '.number_format($this->getNilai($start,$end,$perusahaan_ids,$lokasi_ids, null));

            $array_data[] = $new_item_farm;
        }

        return json_encode([
            'status' => 200,
            'data' => $array_data,
            'perusahaan_nama' => $perusahaan_nama
        ]);

    }

    public function getNilai($start,$end,$perusahaan_ids,$lokasi_ids = null,$parent_tarif_kategori_id = null)
    {
        $total = Pemasukan::whereBetween('pemasukan.created_at',[$start,$end])
            ->join('pemasukan_detail','pemasukan_detail.pemasukan_id','=','pemasukan.id')
            ->join(config('app.db_name').'_patients.pasien_pembayaran', 'pemasukan.pasien_pembayaran_id', '=', 'pasien_pembayaran.id')
            ->join(config('app.db_name').'_patients.pembayaran_perusahaan', 'pasien_pembayaran.perusahaan_id', '=', 'pembayaran_perusahaan.id')
            ->leftjoin('tarif','tarif.id','=','pemasukan_detail.tarif_id')
            ->leftjoin('tarif_master','tarif_master.id','=','tarif.tarif_master_id')
            ->leftjoin('tarif_kategori','tarif_kategori.id','=','tarif_master.kategori_id');

        if (!is_null($lokasi_ids)) {
            $total->whereIn('pemasukan_detail.lokasi_id',$lokasi_ids);
        }else{
            $total->where(function ($query) use ($parent_tarif_kategori_id) {
                $query->where('tarif_kategori.parent_id', $parent_tarif_kategori_id)
                      ->orWhere('tarif_kategori.id', $parent_tarif_kategori_id);
            });
        }

        $total = $total->whereIn('pembayaran_perusahaan.id',$perusahaan_ids)
                ->sum('pemasukan_detail.subtotal');

        return $total ?? 0;
    }
}
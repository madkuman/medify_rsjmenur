<?php

namespace App\Http\Controllers\Kasus\Farmasi;

use App\Models\Kasus\Resep;
use App\Support\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\CatatanPengobatanPasien;
use App\Models\Kasus\CatatanPengobatanPasienDetail;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\TransaksiObat;
use Carbon\Carbon;
use App\User;
use DB;
use Auth;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		return redirect('kasus/'.$nomor_kasus.'/farmasi/pengobatan-pasien');
	}

	public function pengobatanPasien($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();

        $pengobatan = CatatanPengobatanPasien::with(['details'])
            ->where('kasus_id', $kasus->id)
            ->orderBy('nama_obat','asc')
            ->get();

        if (config('medify.kasus.riwayat_pemberian_obat.prevent_input_jika_obat_habis')) {
            $obat = $this->mappingObatByResep($kasus->id);
            $this->mappingPengobatanPasien($pengobatan, $obat);
        }
		
		$pengobatan_id = $pengobatan->pluck('id')->toArray();
		
		$kolaborator = Kolaborator::where('kasus_id',$kasus->id)->with('user')->get();
        $data['is_kolaborator'] = $kolaborator->contains('user_id', \Illuminate\Support\Facades\Auth::id());

		$data['kasus'] = $kasus;
		$data['fitur_header'] = '';
        $fitur_alergi = config('medify.kasus.header_alergi.on');
        if($fitur_alergi == 1 ) {
            $data['fitur_header'] = $fitur_alergi;
        }
        $data['dpjp_name'] = '';
        if(!empty($data['kasus']->Dpjp->user_id)) {
           $data['dpjp_name'] = User::where('id', $data['kasus']->Dpjp->user_id)->pluck('name')->first();
        }
		$data['kolaborator'] = $kolaborator;
		$data['pengobatan'] = $pengobatan;
		$data['sidebar_active'] = 'farmasi';
		$data['active_nav'] = 'pengobatan';

		//$this->seedDataDemoDetail($kasus->id);

		return view('kasus.farmasi.pengobatan-pasien',$data);
	}

	private function seedDataDemo($kasus_id)
	{
		$seed_data = ItemsTemplate::where('jenis','obat')->take(100)->get();

		foreach($seed_data as $obat)
		{
			$cppd = new CatatanPengobatanPasien;
			$cppd->obat_id = $obat->id;
			$cppd->nama_obat = $obat->nama;
			$cppd->aturan_pemakaian = '3x1';
			$cppd->rute = $obat->satuan;
			$cppd->keterangan = $obat->keterangan;
			$cppd->kasus_id = $kasus_id;
			$cppd->created_by = Auth::user()->id;
			$cppd->save();
		}
	}



	private function seedDataDemoDetail($kasus_id)
	{
		$seed_data = CatatanPengobatanPasien::where('kasus_id',$kasus_id)->get();
		$hours = ['8','10','12','14','16','20','22'];
		$status = 'sukses';


		foreach($seed_data as $catatan_pengobatan_pasien)
		{
			for($i=1;$i<14;$i++)
			{

				$random = rand(0,100);
				if($random > 60) continue;

				$count_give = 0;
				foreach($hours as $hour)
				{

					$random = rand(0,100);
					if($random > 30) continue;

					$temp_date = Carbon::now()->startOfDay()->subDays($i)->addHours($hour);

					$cppd = new CatatanPengobatanPasienDetail;
					$cppd->catatan_pengobatan_pasien_id = $catatan_pengobatan_pasien->id;
					$cppd->pemberian_at = $temp_date;
					$cppd->status = $status;
					$cppd->evaluasi = '';
					$cppd->verified_by = Auth::user()->id;
					$cppd->verified_by_2 = Auth::user()->id;
					$cppd->save();
				}
			}
		}
	}

    private function mappingObatByResep($kasus_id)
    {
        $resep = Resep::with(['transaksi_farmasi', 'resepDetail'])
            ->where('kasus_id', '=', $kasus_id)
            ->get();

        $obat = [];

        foreach ($resep as $item) {
//            hanya jika transaksi obat sudah dikonfirmasi -> status = 1
            if (($item->transaksi_farmasi->status ?? 0) > 0) {
                foreach ($item->resepDetail ?? [] as $_item) {
                    $obat_id = $_item->obat_id ?? 0;
                    $obat[$obat_id] = ($obat[$obat_id] ?? 0) + ($_item->jumlah ?? 0);
                }
            }
        }

        return $obat;
    }

    private function mappingPengobatanPasien(&$pengobatan, $obat)
    {
        $pengobatan = $pengobatan->map(function ($item) use ($obat) {
            $item->jumlah_obat = $obat[$item->obat_id] ?? 0;
            $item->pemakaian = 0;
            for ($i = 0; $i < count($item->details ?? []); $i++) {
                $item->pemakaian += 1;
            }
            $item->sisa = $item->jumlah_obat - $item->pemakaian;
            return $item;
        });
    }
}

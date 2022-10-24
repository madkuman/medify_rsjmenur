<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Transaksi as TransaksiRawatInap;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use App\Models\IGD\Transaksi as TransaksiIGD;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;

class LaporanSTPController extends Controller
{
    public function get($request)
	{
		$penyakit_array = $this->getPenyakitArray();
		$age_array = $this->getAgeArray();
		$gender_l = ['L'];
		$gender_p = ['P'];
		$gender_lp = ['L','P'];
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
    	$layanan = $request->tujuan;
    	
    	//nge get transaksi yang waktu keluarnya diantara datepicker dan kasus_id nya di grup biar gak kembar
    	if ($layanan == 'rj') {
    		$transaksi_ids = TransaksiRawatJalan::whereBetween('waktu_keluar',[$start,$end])->groupBy('kasus_id')->pluck('id')->toArray();
    	} else if ($layanan == 'ri') {
    		$transaksi_ids = TransaksiRawatInap::whereBetween('waktu_keluar',[$start,$end])->groupBy('kasus_id')->pluck('id')->toArray();
    	} else if ($layanan == 'igd') {
    		$transaksi_ids = TransaksiIGD::whereBetween('waktu_keluar',[$start,$end])->groupBy('kasus_id')->pluck('id')->toArray();
    	}
		
		$result = [];

		foreach($penyakit_array as $penyakit)
		{
			$temp = [];
			foreach($age_array as $key => $usia)
			{
				if ($key == 8) break;
				$temp[] = $this->getData($transaksi_ids,$penyakit,$usia,$gender_lp,$layanan);
			}
			$temp[] = $this->getData($transaksi_ids,$penyakit,$age_array[8],$gender_l,$layanan);
			$temp[] = $this->getData($transaksi_ids,$penyakit,$age_array[8],$gender_p,$layanan);
			$temp[] = $this->getData($transaksi_ids,$penyakit,$age_array[8],$gender_lp,$layanan);
			$result[] = $temp;
		}

		$data['result'] = $result;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['layanan'] = $layanan;
		$data['tanggal_ttd'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%B %Y');
		return $data;

	}

	private function getData($transaksi_ids,$penyakit,$usia,$gender,$layanan)
	{
		
		if ($layanan == 'rk') {
    		$kasus_ids = TransaksiRawatJalan::whereIn('id',$transaksi_ids)->whereBetween('usia_masuk',[$usia->min,$usia->max])->pluck('kasus_id')->toArray();
    	} else if ($layanan == 'ri') {
    		$kasus_ids = TransaksiRawatInap::whereIn('id',$transaksi_ids)->whereBetween('usia_masuk',[$usia->min,$usia->max])->pluck('kasus_id')->toArray();
    	} else if ($layanan == 'igd') {
    		$kasus_ids = TransaksiIGD::whereIn('id',$transaksi_ids)->whereBetween('usia_masuk',[$usia->min,$usia->max])->pluck('kasus_id')->toArray();
    	}
		
		$kasus = Kasus::whereIn('id',$kasus_ids);

		$kasus = $kasus->whereHas('diagnosis' ,function($q) use ($penyakit){
			$q->whereIn('icd_10',$penyakit);
		})->whereHas('identitas',function($q2) use ($gender){
			$q2->whereIn('jenis_kelamin',$gender);
		})->count();

		return $kasus;
	}


	private function getPenyakitArray()
	{
		$array = [];
		$array['A00'] = [1,2,3,4];
		$array['A09'] = [68];
		$array['A09B'] = [];
		$array['A01.9'] = [10];
		$array['A01.0'] = [6];
		$array['A15.9'] = [79];
		$array['A16.2'] = [83];
		$array['A30.0'] = [167];
		$array['A30.9'] = [174];
		$array['B30.9'] = [585];
		$array['A36'] = [189,190,191,192,193,194,195];
		$array['A37'] = [196,197,198,199,200];
		$array['A34'] = [187];
		$array['K75.9'] = [4448];
		$array['B16'] = [512,513,514,515,516];
		$array['B54'] = [723];
		$array['B51'] = [711,712,713,714];
		$array['B50'] = [707,708,709,710];
		$array['B52'] = [715,716,717,718];
		$array['A91'] = [426];
		$array['A90'] = [425];
		$array['J18.9'] = [3934];
		$array['A53.9'] = [287];
		$array['A54.9'] = [297];
		$array['A66.9'] = [331];
		$array['B74.9'] = [807];
		$array['J11.1'] = [3904];
		$array['G04.9'] = [2807];
		$array['G03.9'] = [2802];
		$array['I20.9'] = [3545];
		$array['I21.9'] = [3551];
		$array['I25.2'] = [3570];
		$array['I10'] = [3528];
		$array['I11.9'] = [3530];
		$array['I48'] = [3675];
		$array['I12.9'] = [3532];
		$array['I13.9'] = [3536];
		$array['I15.9'] = [3541];
		$array['E10'] = [2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012];
		$array['E11'] = [2013,2014,2015,2016,2017,2018,2019,2020,2021,2022,2023];
		$array['E12'] = [2024,2025,2026,2027,2028,2029,2030,2031,2032,2033,2034];
		$array['E14'] = [2046,2047,2048,2049,2050,2051,2052,2053,2054,2055];
		$array['E14.9'] = [2056];
		$array['C53.9'] = [1194];
		$array['C50.9'] = [1182];
		$array['C22.9'] = [1039];
		$array['C34'] = [1078,1079,1080,1081,1082,1083,1084];
		$array['J44.8'] = [4008];
		$array['V01-99'] = [8773, 8774, 8775, 8776, 8777, 8778, 8779, 8780, 8781, 8782, 8783, 8784, 8785, 8786, 8787, 8788, 8789, 8790, 8791, 8792, 8793, 8794, 8795, 8796, 8797, 8798, 8799, 8800, 8801, 8802, 8803, 8804, 8805, 8806, 8807, 8808, 8809, 8810, 8811, 8812, 8813, 8814, 8815, 8816, 8817, 8818, 8819, 8820, 8821, 8822, 8823, 8824, 8825, 8826, 8827, 8828, 8829, 8830, 8831, 8832, 8833, 8834, 8835, 8836, 8837, 8838, 8839, 8840, 8841, 8842, 8843, 8844, 8845, 8846, 8847, 8848, 8849, 8850, 8851, 8852, 8853, 8854, 8855, 8856, 8857, 8858, 8859, 8860, 8861, 8862, 8863, 8864, 8865, 8866, 8867, 8868, 8869, 8870, 8871, 8872, 8873, 8874, 8875, 8876, 8877, 8878, 8879, 8880, 8881, 8882, 8883, 8884, 8885, 8886, 8887, 8888, 8889, 8890, 8891, 8892, 8893, 8894, 8895, 8896, 8897, 8898, 8899, 8900, 8901, 8902, 8903, 8904, 8905, 8906, 8907, 8908, 8909, 8910, 8911, 8912, 8913, 8914, 8915, 8916, 8917, 8918, 8919, 8920, 8921, 8922, 8923, 8924, 8925, 8926, 8927, 8928, 8929, 8930, 8931, 8932, 8933, 8934, 8935, 8936, 8937, 8938, 8939, 8940, 8941, 8942, 8943, 8944, 8945, 8946, 8947, 8948, 8949, 8950, 8951, 8952, 8953, 8954, 8955, 8956, 8957, 8958, 8959, 8960, 8961, 8962, 8963, 8964, 8965, 8966, 8967, 8968, 8969, 8970, 8971, 8972, 8973, 8974, 8975, 8976, 8977, 8978, 8979, 8980, 8981, 8982, 8983, 8984, 8985, 8986, 8987, 8988, 8989, 8990, 8991, 8992, 8993, 8994, 8995, 8996, 8997, 8998, 8999, 9000, 9001, 9002, 9003, 9004, 9005, 9006, 9007, 9008, 9009, 9010, 9011, 9012, 9013, 9014, 9015, 9016, 9017, 9018, 9019, 9020, 9021, 9022, 9023, 9024, 9025, 9026, 9027, 9028, 9029, 9030, 9031, 9032, 9033, 9034, 9035, 9036, 9037, 9038, 9039, 9040, 9041, 9042, 9043, 9044, 9045, 9046, 9047, 9048, 9049, 9050, 9051, 9052, 9053, 9054, 9055, 9056, 9057, 9058, 9059, 9060, 9061, 9062];
		$array['F22'] = [2510,2511,2512,2513];

		$penyakit_A = [];
		$penyakit_B = [];
		$penyakit_C = [];
		$temp = [];
		$idx = 1;
		foreach($array as $item)
		{
			if ($idx > 47) {
				$penyakit_C = array_merge($penyakit_C, $item);
			} else if ($idx > 20) {
				$penyakit_B = array_merge($penyakit_B, $item);
			} else {
				$penyakit_A = array_merge($penyakit_A, $item);
			}
			$idx++;
			$temp = array_merge($temp, $item);
		}
		$array[] = $penyakit_A;
		$array[] = $penyakit_B;
		$array[] = $penyakit_C;
		$array[] = $temp;

		return $array;


	}

	private function getAgeArray()
	{	
		$array = [];
		$temp = $this->getObjectAge('0 - 28 Hari',0,28);
		$array[] = $temp;
		$temp = $this->getObjectAge('29 - < 1 Tahun',29,364);
		$array[] = $temp;
		$temp = $this->getObjectAge('1 - 4 Tahun',365*1,(365*5-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('5 - 14 Tahun',365*5,(365*15-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('15 - 24 Tahun',365*15,(365*25-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('25 - 44 Tahun',365*25,(365*45-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('45 - 64 Tahun',365*45,(365*65-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('65+ Tahun',365*65,(365*1000-1));
		$array[] = $temp;
		$temp = $this->getObjectAge('Total',0,(365*1000-1));
		$array[] = $temp;

		return $array;
	}

	private function getObjectAge($name,$min,$max)
	{
		$temp = new \StdClass();
		$temp->name = $name;
		$temp->min = $min;
		$temp->max = $max;
		return $temp;
	}
}

<?php

namespace App\Http\Controllers\RawatInap\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\TempatTidur;


class DummyController extends Controller
{
	public function ruangan()
	{
		for($bangsal_id = 4;$bangsal_id<=10;$bangsal_id++)
		{
			for($i=1;$i<=5;$i++)
			{
				if($bangsal_id % 2 == 0) $kelas = 1;
				else $kelas = 2;

				$ruang = new Ruangan;
				$ruang->nama = "Ruang ".$i;
				$ruang->kelas = $kelas;
				$ruang->bangsal_id = $bangsal_id;
				$ruang->save();
			}
		}
	}

	public function tempattidur()
	{
		$ruangan = Ruangan::all();
		foreach($ruangan as $ruang)
		{
			if($ruang->kelas == 1)
			{
				for($i=1;$i<=2;$i++)
				{
					$bed = new TempatTidur;
					$bed->nama = "Bed ".$i;
					$bed->ruangan_id = $ruang->id;
					$bed->save();
				}
			}
			else if($ruang->kelas == 2)
			{
				for($i=1;$i<=4;$i++)
				{
					$bed = new TempatTidur;
					$bed->nama = "Bed ".$i;
					$bed->ruangan_id = $ruang->id;
					$bed->save();
				}
			}
			else if($ruang->kelas == 'vip')
			{
				for($i=1;$i<=1;$i++)
				{
					$bed = new TempatTidur;
					$bed->nama = "Bed ".$i;
					$bed->ruangan_id = $ruang->id;
					$bed->save();
				}
			}
		}
	}
}

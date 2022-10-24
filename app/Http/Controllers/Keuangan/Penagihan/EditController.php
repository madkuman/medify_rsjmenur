<?php

namespace App\Http\Controllers\Keuangan\Penagihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use DB;
use App\Models\Pasien\Pasien;
use App\Models\Keuangan\PiutangDetail;
use App\Models\Keuangan\PaketPenagihan;
use App\Models\Keuangan\PenagihanBPJS;

class EditController extends Controller
{
	public function addTotal($penagihan_id, $addition)
	{
		$penagihan = PaketPenagihan::find($penagihan_id);
		$penagihan->total += $addition;
		$penagihan->save();
	}

	public function updateStatusBpjs($slug, $status, $relations = [])
	{
		$paket_penagihan = PaketPenagihan::where('slug', $slug)->with($relations)->first();
		$this->checkToAbort($paket_penagihan);
		$paket_penagihan->status = $status;
		$paket_penagihan->save();
		return $paket_penagihan;
	}

	public function updateStatus($paket_penagihan, $status, $relations = [], $req)
	{
		$total = 0;
		foreach($paket_penagihan->detail as $d){
			if(!in_array($d->id, $req->piutang_id)){
				$d->paket_penagihan_id = NULL;
				$d->save();
			} else {
				$total += $d->total;
			}
		}
		$this->checkToAbort($paket_penagihan);
		$paket_penagihan->total = $total;
		$paket_penagihan->status = $status;
		$paket_penagihan->save();
		return $paket_penagihan;
	}

	public function updateStatusPembayaran($paket, $status)
	{
		$total_detail = count($paket->detail_bpjs);
		foreach($paket->detail_bpjs as $d)
		{
			if($d->total_paid > 0)
				$total_detail--;
		}
		if($total_detail > 0)
			return;
		$paket->status = $status;
		$paket->save();
	}

	public function updateNomor($slug, $req)
	{
		$paket_penagihan = PaketPenagihan::where('slug', $slug)->first();
		$this->checkToAbort($paket_penagihan);
		$paket_penagihan->judul = $req->judul;
		$paket_penagihan->nomor_surat = $req->nomor_surat;
		$paket_penagihan->save();
	}

	public function updateFPK($penagihan_bpjs_id, $fpk)
	{
		$penagihan_bpjs = PenagihanBPJS::find($penagihan_bpjs_id);
		$this->checkToAbort($penagihan_bpjs);
		$penagihan_bpjs->fpk = $fpk;
		$penagihan_bpjs->save();
	}

	public function updatePenagihanSiapBPJS($penagihan_bpjs_id, $pivot_ids)
	{
		$penagihan_bpjs = PenagihanBPJS::find($penagihan_bpjs_id);

		$total = 0;
		foreach($penagihan_bpjs->piutang_pivot_detail as $d)
		{
			if(in_array($d->id, $pivot_ids))
			{
				$total += $d->total;
				$d->status = 1;
			} else
			{
				$d->status = 0;
			}
			$d->save();
		}
		$penagihan_bpjs->total = $total;
		$penagihan_bpjs->save();
		return $penagihan_bpjs->paket_penagihan_id;
	}

	public function confirmPenagihanBPJS($penagihan_bpjs_id, $pivot_id)
	{
		$penagihan_bpjs = PenagihanBPJS::find($penagihan_bpjs_id);
		$paket_id = $penagihan_bpjs->paket_penagihan_id;

		$total = 0;
		$details_count = count($penagihan_bpjs->piutang_pivot_detail);
		foreach($penagihan_bpjs->piutang_pivot_detail as $d)
		{
			if(in_array($d->id, $pivot_id))
			{
				$total += $d->total;
				$d->status = 1;
				$d->save();
			} else
			{
				$deleted_pivot_id = $d->id;
				$piutang = $d->piutang;
				PiutangDetail::where('piutang_pivot_id', $deleted_pivot_id)->update(['piutang_pivot_id' => NULL]);
				$piutang->paket_penagihan_id = NULL;
				$piutang->save();

				$d->delete();
				$details_count--;
			}
		}
		if($details_count == 0)
		{
			$penagihan_bpjs->delete();
			return $paket_id;
		} else
		{
			$penagihan_bpjs->confirmed_at = Carbon::now();
			$penagihan_bpjs->confirmed_by = Auth::user()->id;
			$penagihan_bpjs->total = $total;
			$penagihan_bpjs->save();
			return $paket_id;
		}
	}

	public function calculatePenagihan($paket_penagihan_id)
	{
		$paket_penagihan = PaketPenagihan::find($paket_penagihan_id);
		$total = 0;
		foreach($paket_penagihan->detail_bpjs as $b)
		{
			if($b->pernah_ditolak == 0)
				$total += $b->total;
		}
		$paket_penagihan->total = $total;
		$paket_penagihan->save();
	}

	public function kirimPenagihanBpjs($paket)
	{
		foreach($paket->detail_bpjs as $b)
		{
			$details_count = count($b->piutang_pivot_detail);
			foreach($b->piutang_pivot_detail as $p)
			{
				if($p->status == 0){
					$deleted_pivot_id = $p->id;
					$piutang = $p->piutang;
					$p->delete();
					PiutangDetail::where('piutang_pivot_id', $deleted_pivot_id)->update(['piutang_pivot_id' => NULL]);
					$piutang->paket_penagihan_id = NULL;
					$piutang->save();
					$details_count--;
				}
			}
			if($details_count == 0)
			{
				$b->delete();
			}
		}
	}
}
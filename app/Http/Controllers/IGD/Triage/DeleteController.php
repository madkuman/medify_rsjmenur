<?php

namespace App\Http\Controllers\IGD\Triage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Triage;

class DeleteController extends Controller
{
    public function delete($id, $nomor_kasus=0)
    {
		$triage = Triage::find($id);
		if (!empty($triage)) {
			if ($nomor_kasus != 0) {
				$triage->kasus_id = NULL;
				$triage->save();
			} else {
				$triage->delete();
			}
		}

		return 1;
    }
}

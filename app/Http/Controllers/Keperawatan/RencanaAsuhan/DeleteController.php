<?php

namespace App\Http\Controllers\Keperawatan\RencanaAsuhan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keperawatan\RencanaAsuhan;

class DeleteController extends Controller
{
    public function destroy($id)
    {
      $rencana_asuhan = RencanaAsuhan::findOrFail($id);
      $rencana_asuhan->delete();

      $message = 'Data Rencana Asuhan Berhasil Dihapus!';
      $title = 'Berhasil!';
      $status = 1;

      return redirect('keperawatan')
      ->with('message', $message)
      ->with('title',$title)
      ->with('status', $status);
    }
}

<?php

namespace App\Http\Controllers\Laundry\Barang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Laundry\Barang;
use App\Models\Laundry\Transaksi;
use App\Models\Laundry\TransaksiDetail;

class DeleteController extends Controller
{
  public function DeleteBarang($id)
  {
    try {
        $delete = Barang::find($id);
        $delete->delete();

        return array(
            'delete' => $delete,
            'status' => 1
        );

    } catch (Exception $e) {
        return array(
            'delete' => $e->getMessage(),
            'status' => 0
        );
    }
  }
}

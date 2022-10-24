<?php

namespace App\Http\Controllers\Farmasi\Consis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FarmasiConsis\TransaksiDetail;
use App\Models\FarmasiConsis\Obat;
use App\Models\FarmasiConsis\Transaksi;


class DeleteController extends Controller
{
    //$data ini dari item_template gudang
    public function deleteObat($item_template_id)
    {
    	$obat = Obat::where('hobat_id', $item_template_id)->delete();
    }
}

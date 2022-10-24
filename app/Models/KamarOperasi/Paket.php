<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
{
	use DataLogger;
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $connection = 'kamaroperasi';
	protected $table = 'paket';

  public function paket_item()
  {
    return $this->hasMany('App\Models\KamarOperasi\PaketItem');
  }

  public function getHargaTotal()
  {
    if ($this->tipe == 'alkes') return 0; //sementara, alkes belum ada kolom harga
    $items = $this->paket_item;
    $total = 0;
    foreach ($items as $item)
    {
      $barang = $item->getItem;
      if(!$barang->harga) $barang->harga = 0;
      $total += $barang->harga;
    }

    return $total;
  }
}

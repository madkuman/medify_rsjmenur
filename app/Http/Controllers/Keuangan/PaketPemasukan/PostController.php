<?php

namespace App\Http\Controllers\Keuangan\PaketPemasukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use DB;
use App\Models\Pasien\Pasien;
use App\Models\Keuangan\PaketPemasukan;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PiutangDetail;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\TarifTipe;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\Tarif;
use App\Models\Hospital\Lokasi;
use App\Models\Keuangan\Perusahaan;

class PostController extends Controller
{

}
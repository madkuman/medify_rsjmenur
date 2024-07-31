<?php

use App\Models\Farmasi\TipeObat;
use App\Models\Farmasi\TipeRacikan;
use App\Models\Pasien\PembayaranPerusahaanType;
use Carbon\Carbon;

/**
* change plain number to formatted currency
*
* @param $number
* @param $currency
*/
function isJson($string)
{
    return is_object(json_decode($string));
}


function formatCurrency($number, $currency = "Rp ")
{
    if($number - (int)$number >0){
        return $currency.number_format($number, 2, ',', '.');
    }else{
        return $currency.number_format($number, 0, ',', '.');
    }
}

function carbon_parse($timestamp,$format_start,$format_end)
{
    if(empty($timestamp)) return '';
    $date = Carbon::createFromFormat($format_start,$timestamp);
    return $date->format($format_end);
}

function indonesian_date ($timestamp = '', $date_format = 'j F Y', $suffix = 'WIB') {
    if(strpos($timestamp, ':') !== false){
        $suffix = '';
    }elseif($date_format == 'F'){
        $date_format = 'F';
    }elseif($date_format != 'l'){
        $date_format = 'j F Y';
    }
    $suffix = '';
    if (trim ($timestamp) == '')
    {
        $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
}

function phparray_to_mysql($array)
{
    $res = "(";
    foreach($array as $count => $a)
    {
        $res .= $a;
        if(isset($array[$count+1]))
            $res .= ", ";
    }
    return $res.")";
}

function getTipeRacikan($is_racikan_default = false) {
    $tipe_racikan = session('temp_data_tipe_racikan', null);
    if ($tipe_racikan == null) {
        $tipe_racikan = TipeRacikan::get();
        session()->put('temp_data_tipe_racikan', $tipe_racikan);
    }
    if ($is_racikan_default !== false) {
        $tipe_racikan->where('is_racikan_default', $is_racikan_default);
    }
    return $tipe_racikan;
}

function excel_column($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num - 1) / 26);
    if ($num2 > 0) {
        return excel_column($num2) . $letter;
    } else {
        return $letter;
    }
}



function slug($name)
{
    $slug = preg_replace('~[^\pL\d]+~u', '-', $name);
    $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
    $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
    $slug = trim($slug, '-'); // trim
    $slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
    $slug = strtolower($slug); // lowercase
    
    return $slug;
}

function tanggalMerah($value)
{
    // dd($value);
    date_default_timezone_set("Asia/Jakarta");
    $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/Json-Indonesia-holidays/master/calendar.json"), true);
    //check tanggal merah berdasarkan libur nasional
    if (isset($array[$value])) {
        $message = "Tanggal merah " . $array[$value]["deskripsi"];
        $status = true;
    } elseif (date("D", strtotime($value)) === "Sun") {
        //check Tanggal merah berdasarkan hari minggu
        $message = "Tanggal merah hari minggu";
        $status = true;
    } else {
        //bukan Tanggal merah
        $message = "bukan Tanggal merah";
        $status = false;
    }

    $response = [
        'status'  => $status,
        'message' => $message
    ];
    return $response;
}

function getTunaiPerusahaanTipe()
{
    return PembayaranPerusahaanType::where('slug', 'tunai')->first()->id ?? null;
}

function removeSpecialChar($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function checkToAbort($data)
{
    if (is_null($data))  abort(404);
}

function cutText($text, $maxchar, $end = ' ...')
{
    $panjang_text = strlen($text);
    if ($panjang_text > $maxchar)
        $text = substr($text, 0, $maxchar) . '' . $end;
    return $text;
}

if (!function_exists('dumpquery')) {
    #dumping builder as runnable query
    function dumpquery($builder)
    {
        $addSlashes = str_replace('?', "'?'", $builder->toSql());
        $query =  vsprintf(str_replace('?', '%s', $addSlashes), $builder->getBindings());
        return $query;
    }
}

function pre(...$array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function globalGetTipeObat()
{
    return TipeObat::select('id', 'nama')->get();
}


function getTanggalIndonesiaHari($number)
{
    $data = ["Senin","Selasa",'Rabu','Kamis','Jumat','Sabtu','Minggu'];
    return $data[$number];
}

function getTanggalIndonesiaBulan($number)
{
    $data = ['Januari','Februari','Maret','April','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    return $data[$number];
}

function getTerbilang($nominal)
{
    $terbilang = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($nominal);
    return $terbilang;
}



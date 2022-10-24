<?php

namespace App\Exports\LabPA;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\LabPA\TransactionDetail;
use App\Models\LabPA\LaporanMaster;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InvoiceRekapPasien implements FromView, WithEvents, ShouldAutoSize
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $col_num;

    public function __construct($date){
        define("ad_mil", config('const.bpjs_tni_ad'));
        define("ad_sp", config('const.bpjs_sp_ad'));
        define("ad_kel", config('const.bpjs_kel_ad'));
        define("al_mil", config('const.bpjs_tni_al'));
        define("al_sp", config('const.bpjs_sp_al'));
        define("al_kel", config('const.bpjs_kel_al'));
        define("au_mil", config('const.bpjs_tni_au'));
        define("au_sp", config('const.bpjs_sp_au'));
        define("au_kel", config('const.bpjs_kel_au'));
        define("bpjs_purna", config('const.bpjs_purna'));
        define("bpjs_anh", config('const.bpjs_anh'));
        define("tunai", config('const.tunai'));
        $month = explode("-", $date)[1];
        $year = explode("-", $date)[0];
        $this->month = date("F Y", strtotime($date));
        $this->formattedDate = Carbon::createFromDate($year, $month, 1);
        $this->requestedDate = $this->formattedDate->toDateString();
        $this->nextDate = $this->formattedDate->addMonth()->toDateString();
    
        $master = LaporanMaster::where('slug', 'rekap-pasien')->first();
        $konten = json_decode($master->konten);
        $col_num = 0;
        $tarif = [];
        foreach ($konten as $key => $value) {
            foreach($value as $val) {
                $col_num++;
                array_push($tarif, $val);
            }
        }
        $this->master = $master;
        $this->konten = $konten;
        $this->tarif = $tarif;
        $this->col_num = $col_num;
    }

    public function registerEvents(): array
    {
        $alphabet = range('A', 'Z');
        $col_alpha = $alphabet[$this->col_num+2];
        return [
            AfterSheet::class    => function(AfterSheet $event) use($col_alpha) {
                
                $event->sheet->styleCells(
                    'A1:N22',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A2',
                    [
                        'font' => [
                            'underline' => true
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A4:A5',
                    [
                        'font' => [
                            'size' => 14
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A4:N22',
                    [
                        'font' => [
                            'bold' => true
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'C11:'.$col_alpha.'23',
                    [
                        'font' => [
                            'bold' => false
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A7:N22',
                    [
                        'font' => [
                            'size' => 12
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A7',
                    [
                        'alignment' => [
                            'wrapText' => true
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A7:'.$col_alpha.'22',
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'K26:K31',
                    [
                        'font' => [
                            'size' => 14
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'K26:K31',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                        ]
                    ]
                );

            }
        ];
    }

    public function view(): View
    {
    	$startDate = $this->requestedDate;
    	$endDate = $this->nextDate;
        $data['month'] = $this->month;
        $data['master'] = $this->master;
        $tarif = $this->tarif;


        $targets = [ad_mil, ad_sp, ad_kel, al_mil, al_sp, al_kel, au_mil, au_sp, au_kel, bpjs_purna, bpjs_anh, tunai];
    	$transaksi = TransactionDetail::where(function($q){
            $q->where('status', 'new')->orWhere('status', 'done');
        })->whereHas('transaction', function($q) use($startDate, $endDate){
			$q->whereDate('result_created_at', '>=', $startDate)->whereDate('result_created_at', '<=', $endDate);
		})->with('transaction.kasus.pembayaran.perusahaan');

        //RETRIEVING AND ORGANIZING DATA
        $result = [];
        foreach($targets as $t){
            foreach($tarif as $col){
                $copy = clone $transaksi;
                $copy = $copy->whereIn('tarif_id', $col->id)->get();
                $result[$t][$col->header] = count($copy->filter(function($val, $key) use($t){
                    return $val->transaction->pembayaran['perusahaan_id'] == $t;
                }));
            }
        }
        $data['tarif'] = $tarif;
        $data['result'] = $result;
        $data['month'] = $this->month;        
        $data['target'] = $targets;
        $data['col_num'] = $this->col_num;
        $data['tunai'] = tunai;
        $data['konten'] = $this->konten;
        return view('labpa.laporan.rekap_pasien', $data);
    }
}
<?php

namespace App\Exports\Pasien;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\LabPA\Transaction;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Resep;
use App\Models\Kasus\Penunjang;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\DTD;
use App\Models\Pasien\ListLaporan;
use App\Models\Kasus\PenunjangPermintaan;
use App\Models\Pasien\AlamatKecamatan;
use App\Models\Pasien\AlamatKota;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\AsalRujukan;
use App\Models\RawatJalan\PermintaanRujuk;

use App\Models\Hospital\TransaksiMasukDetail as TransaksiDetail;
use App\Models\Hospital\TransaksiMasuk as Transaksi;
use Carbon\Carbon;
//use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Datetime;
use PhpOffice\PhpSpreadsheet\Cell;
use PhpOffice\PhpSpreadsheet;

class InvoiceDiagnosisInap implements FromView, WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getColumnDimension('C')->setWidth(17);
                $event->sheet->getColumnDimension('D')->setWidth(47);
                $event->sheet->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getColumnDimension('F')->setAutoSize(true);
                $event->sheet->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getColumnDimension('H')->setAutoSize(true);
                $event->sheet->getColumnDimension('I')->setAutoSize(true);
                $event->sheet->getColumnDimension('J')->setAutoSize(true);
                $event->sheet->getColumnDimension('K')->setAutoSize(true);
                $event->sheet->getColumnDimension('L')->setAutoSize(true);
                $event->sheet->getColumnDimension('M')->setAutoSize(true);
                $event->sheet->getColumnDimension('N')->setAutoSize(true);
                $event->sheet->getColumnDimension('O')->setAutoSize(true);
                $event->sheet->getStyle('C3:D550')->getAlignment()->setWrapText(true);
                
                $event->sheet->styleCells(
                    'A3:O6',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]
                    ]
                );                

                $event->sheet->styleCells(
                    'E7:O502',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A505:O538',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A3:O502',
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
                    'A6:O6',
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A504',
                    [
                        'font' => [
                            'bold' => true
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A505:O538',
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
                    'A508:O508',
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
            }
        ];
    }
    public function __construct($data){
        $this->date1 = $data['start'];
        $this->date2 = $data['end'];
    }

    public function view(): View
    {
        $start = $this->date1;
        $end = $this->date2;
        $dtd = DTD::all();
        $data = app('App\Http\Controllers\Pasien\Laporan\DiagnosisRawatInapController')->diagnosis($start,$end);
        return view('pasien.laporan.diagnosisinap',$data);
    }
}

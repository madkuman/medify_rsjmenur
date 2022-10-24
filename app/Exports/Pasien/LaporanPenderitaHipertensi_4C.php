<?php

namespace App\Exports\Pasien;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use Datetime;

class LaporanPenderitaHipertensi_4C implements FromView, WithEvents
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(6);
                $event->sheet->getColumnDimension('B')->setWidth(20);
                $event->sheet->getColumnDimension('C')->setWidth(20);
                $event->sheet->getColumnDimension('D')->setWidth(20);
                $event->sheet->getColumnDimension('E')->setWidth(10);
                $event->sheet->getColumnDimension('F')->setWidth(15);
                $event->sheet->getColumnDimension('G')->setWidth(15);
                $event->sheet->getColumnDimension('H')->setWidth(15);
                $event->sheet->getColumnDimension('I')->setWidth(15);
                $event->sheet->getColumnDimension('J')->setWidth(15);
                $event->sheet->getColumnDimension('K')->setWidth(6);
                $event->sheet->getColumnDimension('L')->setWidth(6);
                $event->sheet->getColumnDimension('M')->setWidth(6);
                $event->sheet->getColumnDimension('N')->setWidth(6);
                $event->sheet->getColumnDimension('O')->setWidth(6);
                $event->sheet->getColumnDimension('P')->setWidth(6);
                $event->sheet->getColumnDimension('Q')->setWidth(6);
                $event->sheet->getColumnDimension('R')->setWidth(6);
                $event->sheet->getColumnDimension('S')->setWidth(6);
                $event->sheet->getColumnDimension('T')->setWidth(6);
                $event->sheet->getColumnDimension('U')->setWidth(6);
                $event->sheet->getColumnDimension('V')->setWidth(6);
                $event->sheet->getColumnDimension('W')->setWidth(6);
                $event->sheet->getColumnDimension('X')->setWidth(6);
                $event->sheet->getColumnDimension('Y')->setWidth(6);
                $event->sheet->getColumnDimension('Z')->setWidth(6);
                $event->sheet->getColumnDimension('AA')->setWidth(6);
                $event->sheet->getColumnDimension('AB')->setWidth(6);

                $event->sheet->styleCells(
                    'A1:AB1',
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'textRotation' => 0,
                            'wrapText'     => TRUE,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A6:AB8',
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'textRotation' => 0,
                            'wrapText'     => TRUE,
                        ],

                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A7:AB7',
                    [
                        'alignment' => [
                            'wrapText'     => TRUE,
                        ]
                    ]
                );
            },
        ];
    }

    
    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View
    {
        $data = $this->data;
        return view('pasien.laporan.laporan-penderita-hipertensi-4c',$data);
    }
}

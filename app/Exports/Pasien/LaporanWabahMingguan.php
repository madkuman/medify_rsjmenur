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

class LaporanWabahMingguan implements FromView, WithEvents
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(6);
                $event->sheet->getColumnDimension('B')->setWidth(30);
                $event->sheet->getRowDimension(7)->setRowHeight(50);
                // $event->sheet->getColumnDimension('D')->setWidth(30);
                // $event->sheet->getColumnDimension('E')->setWidth(30);
                // $event->sheet->getColumnDimension('F')->setWidth(12);
                // $event->sheet->getColumnDimension('G')->setWidth(12);
                // $event->sheet->getColumnDimension('H')->setWidth(15);
                // $event->sheet->getColumnDimension('I')->setWidth(15);
                // $event->sheet->getColumnDimension('J')->setWidth(12);
                // $event->sheet->getColumnDimension('K')->setWidth(10);
                // $event->sheet->getColumnDimension('L')->setWidth(12);
                // $event->sheet->getColumnDimension('M')->setWidth(12);
                // $event->sheet->getColumnDimension('N')->setWidth(10);
                // $event->sheet->getColumnDimension('O')->setWidth(12);
                // $event->sheet->getColumnDimension('P')->setWidth(12);
                // $event->sheet->getColumnDimension('Q')->setWidth(14);
                // $event->sheet->getColumnDimension('R')->setWidth(12);

                $event->sheet->styleCells(
                    'A1:AD22',
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'C7:AD8',
                    [
                        'alignment' => [
                            'wrapText' => TRUE,
                            'textRotation' => 0,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A7:AD22',
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
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
        return view('pasien.laporan.laporan-wabah-mingguan', $data);
    }
}

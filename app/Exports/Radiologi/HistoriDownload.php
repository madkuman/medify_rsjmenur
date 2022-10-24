<?php

namespace App\Exports\Radiologi;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Datetime;

class HistoriDownload implements FromView, WithEvents
{

    use Exportable;

    public function __construct($data)
    {
        $this->data = $data;
    }

        public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                
                $event->sheet->getColumnDimension('A')->setWidth(4);
                $event->sheet->getColumnDimension('B')->setWidth(7);
                $event->sheet->getColumnDimension('C')->setWidth(29);
                $event->sheet->getColumnDimension('D')->setWidth(12);
                $event->sheet->getColumnDimension('E')->setWidth(11);
                $event->sheet->getColumnDimension('F')->setWidth(10);
                $event->sheet->getColumnDimension('G')->setWidth(9);
                $event->sheet->getColumnDimension('H')->setWidth(20);
                $event->sheet->getColumnDimension('I')->setWidth(16);

                $event->sheet->styleCells(
                    'A2:I2',
                    [
                        'borders' => [
                            'left' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => '00000000'],
                            ],
                            'right' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => '00000000'],
                            ],
                            'top' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => '00000000'],
                            ],
                            'bottom' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => '00000000'],
                            ],

                        ],
                        'font' => [
                            'size' => 12
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A1:I999',
                    [
                        'alignment' => [
                            'wrapText' => true
                        ]
                    ]
                );

            },
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $this->rowNumber = $this->data['row_number'];
        return view('radiolog.transaksi.histori-download', [
            'invoices' => $this->data['history'], 'tgl_start' => $this->data['start'], 'tgl_end' => $this->data['end']
        ]);
    }
}
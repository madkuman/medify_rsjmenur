<?php

namespace App\Exports\LabPA;

use App\Models\LabPA\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Datetime;

class InvoiceHistori implements FromView, WithEvents, ShouldAutoSize
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

                        ],
                        'font' => [
                            'size' => 12
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'A3:I'.($this->rowNumber+2),
                    [
                        'font' => [
                            'size' => 10
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
                                'color' => ['argb' => '00000000'],
                            ],
                        ],
                    ]
                );

                $event->sheet->styleCells(
                    'I',
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
        return view('layouts.components2.lab.histori-download', [
            'invoices' => $this->data['history'], 'tgl_start' => $this->data['start'], 'tgl_end' => $this->data['end']
        ]);
    }
}
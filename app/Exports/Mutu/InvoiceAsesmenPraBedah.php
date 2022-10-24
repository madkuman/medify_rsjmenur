<?php

namespace App\Exports\Mutu;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;

class InvoiceAsesmenPraBedah implements FromView, WithEvents
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class   => function(AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(10);
                $event->sheet->getColumnDimension('B')->setWidth(19);
                $event->sheet->getColumnDimension('C')->setWidth(35);
                $event->sheet->getColumnDimension('D')->setWidth(25);
                $event->sheet->getColumnDimension('E')->setWidth(30);
                $event->sheet->getColumnDimension('F')->setWidth(30);
                $event->sheet->getColumnDimension('G')->setWidth(19);

                $event->sheet->styleCells(
                    'A1:G1',
                    [
                        'alignment' => [
                            'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'textRotation'  => 0
                        ],
                        'font' => [
                            'size'  => 12,
                            'bold'  => true,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A3:G3',
                    [
                        'alignment' => [
                            'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'textRotation'  => 0,
                        ],
                        'font' => [
                            'size'  => 12,
                            'bold'  => true,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A4:A1000',
                    [
                        'alignment' => [
                            'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'textRotation'  => 0,
                        ],
                        'font' => [
                            'size'  => 12,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'B4:B1000',
                    [
                        'alignment' => [
                            'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'textRotation'  => 0,
                        ],
                        'font' => [
                            'size'  => 12,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'C4:C1000',
                    [
                        'alignment' => [
                            'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation'  => 0,
                        ],
                        'font' => [
                            'size'  => 12,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'D4:D1000',
                    [
                        'alignment' => [
                            'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation'  => 0,
                        ],
                        'font' => [
                            'size'  => 12,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'E4:G1000',
                    [
                        'alignment' => [
                            'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation'  => 0,
                        ],
                        'font' => [
                            'size'  => 12,
                        ]
                    ]
                );
            },
        ];
    }

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View  
    {
        $data = $this->data;
        return view('mutu.laporan.laporan-kesesuaian-asesmen-pra-bedah', $data);
    }
}

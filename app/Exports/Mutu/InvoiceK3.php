<?php

namespace App\Exports\Mutu;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;

class InvoiceK3 implements FromView, WithEvents
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class   => function(AfterSheet $event) {
                $rows = $event->sheet->getDelegate()->toArray();
                $rows = count($rows);

                $event->sheet->getColumnDimension('A')->setWidth(5);
                $event->sheet->getColumnDimension('B')->setWidth(19);
                $event->sheet->getColumnDimension('C')->setWidth(35);
                $event->sheet->getColumnDimension('D')->setWidth(25);
                $event->sheet->getColumnDimension('E')->setWidth(30);
                $event->sheet->getColumnDimension('F')->setWidth(25);
                $event->sheet->getColumnDimension('G')->setWidth(10);
                $event->sheet->getColumnDimension('H')->setWidth(20);

                $event->sheet->styleCells(
                    'A1:H4',
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
                    'A2:H2',
                    [
                        'font' => [
                            'bold'  => false,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A5:H'.$rows,
                    [
                        'alignment' => [
                            'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                        'font' => [
                            'size'  => 12,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A5:B'.$rows,
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
                    'D5:D'.$rows,
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
                    'F5:H'.$rows,
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
        return view('mutu.laporan.laporan-k3', $data);
    }
}
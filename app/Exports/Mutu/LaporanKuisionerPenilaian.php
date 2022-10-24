<?php

namespace App\Exports\Mutu;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;

class LaporanKuisionerPenilaian implements FromView, WithEvents
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

                $event->sheet->getColumnDimension('A')->setWidth(10);
                $event->sheet->getColumnDimension('B')->setWidth(40);
                $event->sheet->getColumnDimension('C')->setWidth(20);
                $event->sheet->getColumnDimension('D')->setWidth(20);
                $event->sheet->getColumnDimension('E')->setWidth(20);
                $event->sheet->getColumnDimension('F')->setWidth(20);
                $event->sheet->getColumnDimension('G')->setWidth(25);

                $event->sheet->styleCells(
                    'A1:G2',
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
                    'A4:G5',
                    [
                        'alignment' => [
                            'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'      => TRUE,
                            'textRotation'  => 0,
                        ],
                        'font' => [
                            'size'  => 12,
                            'bold'  => true,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A6:A'.(count($rows)),
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
                    'B6:B'.(count($rows)),
                    [
                        'alignment' => [
                            'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                            'wrapText'     => TRUE,
                            'textRotation'  => 0,
                        ],
                        'font' => [
                            'size'  => 12,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'C6:G'.(count($rows)),
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
                    'A4:G'.(count($rows)),
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

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View  
    {
        $data = $this->data;
        return view('mutu.laporan.laporan-kuisioner-penilaian', $data);
    }
}

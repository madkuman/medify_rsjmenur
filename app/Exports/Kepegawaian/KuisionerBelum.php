<?php

namespace App\Exports\Kepegawaian;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;

class KuisionerBelum implements FromView, WithEvents
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
                $event->sheet->getColumnDimension('C')->setWidth(40);
                $event->sheet->getColumnDimension('D')->setWidth(30);

                $event->sheet->styleCells(
                    'A1:D2',
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
                    'A4:D4',
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
                    'A5:B10000',
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
                    'D5:D10000',
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
        return view('kepegawaian.laporan.kuisioner-belum', $data);
    }
}
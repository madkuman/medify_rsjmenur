<?php

namespace App\Exports\Gizi;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LaporanDietPasienBulanan implements FromView, WithEvents
{

    use Exportable;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $rows = $event->sheet->getDelegate()->toArray();
                $rows = count($rows);
                $event->sheet->getColumnDimension('A')->setWidth(7);
                $event->sheet->getColumnDimension('B')->setWidth(30);
                $event->sheet->getColumnDimension('C')->setWidth(5);
                $event->sheet->getColumnDimension('D')->setWidth(5);
                $event->sheet->getColumnDimension('E')->setWidth(5);
                $event->sheet->getColumnDimension('F')->setWidth(5);
                $event->sheet->getColumnDimension('G')->setWidth(5);
                $event->sheet->getColumnDimension('H')->setWidth(5);
                $event->sheet->getColumnDimension('I')->setWidth(5);
                $event->sheet->getColumnDimension('J')->setWidth(5);
                $event->sheet->getColumnDimension('K')->setWidth(5);
                $event->sheet->getColumnDimension('L')->setWidth(5);
                $event->sheet->getColumnDimension('M')->setWidth(5);
                $event->sheet->getColumnDimension('N')->setWidth(5);
                $event->sheet->getColumnDimension('O')->setWidth(5);
                $event->sheet->getColumnDimension('P')->setWidth(5);
                $event->sheet->getColumnDimension('Q')->setWidth(10);

                $event->sheet->styleCells(
                    'A1:Q8',
                    [
                        'font' => [
                            'bold' => true
                        ],
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'A9:A'.$rows,
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'B9:Q'.$rows,
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
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
        return view('gizi.laporan.view.laporan-diet-pasien-bulanan', $this->data);
    }

}
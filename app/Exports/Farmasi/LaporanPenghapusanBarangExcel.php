<?php

namespace App\Exports\Farmasi;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LaporanPenghapusanBarangExcel implements FromView, WithEvents, WithColumnFormatting
{

	use Exportable;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getColumnDimension('A')->setWidth(7);
                $event->sheet->getColumnDimension('B')->setWidth(25);
                for($i=3;$i<=$this->count_column;$i++)
                {
                    $column = excel_column($i);
                    $event->sheet->getColumnDimension($column)->setWidth(16);
                }

                $event->sheet->styleCells(
                    'A1:'.$this->last_column.'5',
                    [
                        'font' => [
                            'bold' => true
                        ],
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );  

                $event->sheet->styleCells(
                    'A1:'.$this->last_column.$this->last_row,
                    [
                        'alignment' => [
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );  

                $event->sheet->styleCells(
                    'A1:A'.$this->last_row,
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'C4:'.$this->last_column.$this->last_row,
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );


                $event->sheet->styleCells(
                    'A1:'.$this->last_column.$this->last_row,
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A6:'.$this->last_column.$this->last_row,
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

    public function columnFormats(): array
    {
        return [
            'J' => '#,##0',
            'K' => '#,##0',
            'L' => '#,##0',
        ];
    }

    public function __construct($data)
    {
        $this->count_column = 12;
        $this->data = $data;
        $this->last_column = excel_column($this->count_column);
        $this->last_row = count($data['data']) + 6;
        $this->data['last_column'] = $this->last_column;
        $this->data['last_row'] = $this->last_row;
        $this->data['count_column'] = $this->count_column;
    }

    public function view(): View
    {
        return view('farmasi.laporan.view.laporan-penghapusan-barang', $this->data);
    }

}
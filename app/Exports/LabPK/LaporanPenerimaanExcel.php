<?php

namespace App\Exports\LabPK;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class LaporanPenerimaanExcel implements FromView, WithEvents, WithColumnFormatting
{

	use Exportable;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getColumnDimension('A')->setWidth(25);
                $event->sheet->getColumnDimension('B')->setWidth(35);
                for($i=3;$i<=15;$i++)
                {
                    $column = excel_column($i);
                    $event->sheet->getColumnDimension($column)->setWidth(16);
                }

                $event->sheet->styleCells(
                    'A1:'.$this->last_column.'3',
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
                    'A5:'.$this->last_column.$this->last_row,
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
            'C' => '#,##0',
            'D' => '#,##0',
            'E' => '#,##0',
            'F' => '#,##0',
            'G' => '#,##0',
            'H' => '#,##0',
            'I' => '#,##0',
            'J' => '#,##0',
            'K' => '#,##0',
            'L' => '#,##0',
            'M' => '#,##0',
            'N' => '#,##0',
            'O' => '#,##0',
            'P' => '#,##0',
            'Q' => '#,##0',
            'R' => '#,##0',
            'S' => '#,##0',
            'T' => '#,##0',
            'U' => '#,##0',
            'V' => '#,##0',
            'W' => '#,##0',
            'X' => '#,##0',
            'Y' => '#,##0',
            'Z' => '#,##0',
            'AA' => '#,##0',
            'AB' => '#,##0',
            'AC' => '#,##0',
            'AD' => '#,##0',
            'AE' => '#,##0',
            'AF' => '#,##0',
            'AG' => '#,##0',
            'AH' => '#,##0',
            'AI' => '#,##0',
            'AJ' => '#,##0',
            'AK' => '#,##0',
            'AL' => '#,##0',
        ];
    }

    public function __construct($data)
    {
        $count_column = count($data['header'])+3;
        $count_row = 0;

        foreach($data['data'] as $key=> $data_item){
            $count_row+=count($data_item)+1;
        }

        $this->data = $data;
        $this->last_column = excel_column($count_column);
        $this->last_row = $count_row+6;
        $this->data['last_column'] = $this->last_column;
        $this->data['count_column'] = $count_column;
        $this->data['count_row'] = $count_row;
        $this->data['last_row'] = $this->last_row;
    }

    public function view(): View
    {
        return view('labpk.laporan.view.laporan-penerimaan', $this->data);
    }

}
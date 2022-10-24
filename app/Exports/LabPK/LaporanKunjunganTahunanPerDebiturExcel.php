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

class LaporanKunjunganTahunanPerDebiturExcel implements FromView, WithEvents, WithColumnFormatting
{

    use Exportable;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getColumnDimension('A')->setWidth(10);
                $event->sheet->getColumnDimension('B')->setWidth(25);
                $event->sheet->getColumnDimension('C')->setWidth(15); 
                for($i=4;$i<=16;$i++)
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
                    'B6:'.$this->last_column.$this->last_row,
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );  
                $event->sheet->styleCells(
                    'C6:'.$this->last_column.$this->last_row,
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
        ];
    }

    public function __construct($data)
    {
        $count_column = 16;
        $count_row = 0;
        $idx = 0;
        foreach($data['data'] as $key=> $data_item){
            $count_row += count($data_item);
            
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
        return view('labpk.laporan.view.laporan-kunjungan-tahunan-per-debitur', $this->data);
    }

}
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

class LaporanRekapitulasiMutasiBarang implements FromView, WithEvents, WithColumnFormatting
{

    use Exportable;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getColumnDimension('A')->setWidth(15);
                $event->sheet->getColumnDimension('B')->setWidth(30);
                $event->sheet->getColumnDimension('C')->setWidth(12);
                $event->sheet->getColumnDimension('D')->setWidth(12);
                $event->sheet->getColumnDimension('E')->setWidth(12);
                $event->sheet->getColumnDimension('F')->setWidth(20);


                $last_column = $this->last_column;
                $last_row = $event->sheet->getHighestRow();

                $event->sheet->styleCells(
                    'A1:'.$last_column.'4',
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
                    'A5:'.$last_column.'11',
                    [
                        'font' => [
                            'bold' => true
                        ],
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A1:'.$last_column.$last_row,
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A7:A'.$last_row,
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
                    'A12:'.$last_column.$last_row,
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'L16:N'.$last_row,
                    [
                        'numberFormat' => [
                            // 'formatCode' => '_-* #,##0.00_-;-* #,##0.00_-;_-* "0.00"_-;_-@_-',
                            'formatCode' => '#,##0',
                        ],
                    ]
                );

                $event->sheet->styleCells(
                    'C16:I'.$last_row,
                    [
                        'numberFormat' => [
                            'formatCode' => '#,##0',
                        ],
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
        ];
    }

    public function __construct($data)
    {
        $column_count = 15;
        $this->last_column = excel_column($column_count);
        $data['full_colspan'] = $column_count;
        $this->data = $data;
        $this->last_row = count($data['master_kode_bidang']) + 14;
        $this->data['last_column'] = $this->last_column;
        $this->data['last_row'] = $this->last_row;
    }

    public function view(): View
    {
        return view('farmasi.laporan.laporan-rekapitulasi-kartu-barang', $this->data);
    }

}
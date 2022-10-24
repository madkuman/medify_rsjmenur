<?php

namespace App\Exports\Radiologi;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;



class RekapPemeriksaanPasienBulanan implements FromView, WithEvents
{

	use Exportable;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getColumnDimension('A')->setWidth(4);
                $event->sheet->getColumnDimension('B')->setWidth(37);
                $event->sheet->getColumnDimension('C')->setWidth(7);
                $event->sheet->getColumnDimension('D')->setWidth(7);
                $event->sheet->getColumnDimension('E')->setWidth(7);
                $event->sheet->getColumnDimension('F')->setWidth(7);
                $event->sheet->getColumnDimension('G')->setWidth(7);
                $event->sheet->getColumnDimension('H')->setWidth(7);
                $event->sheet->getColumnDimension('I')->setWidth(7);
                $event->sheet->getColumnDimension('J')->setWidth(7);
                $event->sheet->getColumnDimension('K')->setWidth(7);
                $event->sheet->getColumnDimension('L')->setWidth(7);
                $event->sheet->getColumnDimension('M')->setWidth(7);
                $event->sheet->getColumnDimension('N')->setWidth(7);
                $event->sheet->getColumnDimension('O')->setWidth(7);
                $event->sheet->getColumnDimension('P')->setWidth(7);
                $event->sheet->getColumnDimension('Q')->setWidth(7);
                $event->sheet->getColumnDimension('R')->setWidth(7);
                $event->sheet->getColumnDimension('S')->setWidth(7);
                $event->sheet->getColumnDimension('T')->setWidth(7);
                $event->sheet->getColumnDimension('U')->setWidth(7);
                $event->sheet->getColumnDimension('V')->setWidth(7);
                $event->sheet->getColumnDimension('W')->setWidth(7);
                $event->sheet->getColumnDimension('X')->setWidth(7);
                $event->sheet->getColumnDimension('Y')->setWidth(7);
                $event->sheet->getColumnDimension('Z')->setWidth(7);
                $event->sheet->getColumnDimension('AA')->setWidth(7);
                $event->sheet->getColumnDimension('AB')->setWidth(7);
                $event->sheet->getColumnDimension('AC')->setWidth(7);
                $event->sheet->getColumnDimension('AD')->setWidth(7);
                $event->sheet->getColumnDimension('AE')->setWidth(7);
                $event->sheet->getColumnDimension('AF')->setWidth(7);
                $event->sheet->getColumnDimension('AG')->setWidth(7);
                $event->sheet->getColumnDimension('AH')->setWidth(7);
                $event->sheet->getColumnDimension('AI')->setWidth(7);
                $event->sheet->getColumnDimension('AJ')->setWidth(7);

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
                    'B1:'.$this->last_column.$this->last_row,
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'C1:'.$this->last_column.$this->last_row,
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
                    'A7:'.$this->last_column.$this->last_row,
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
        $this->last_column = excel_column($data['total_tanggal'] + 3);
        $this->last_row = count($data['data']) + 9;
    }

    public function view(): View
    {
        return view('radiolog.laporan.view.rekap-pemeriksaan-pasien-bulanan', $this->data);
    }

}
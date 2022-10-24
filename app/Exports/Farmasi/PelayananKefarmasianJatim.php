<?php

namespace App\Exports\Farmasi;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use Datetime;

class PelayananKefarmasianJatim implements FromView, WithEvents
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $rows = $event->sheet->getDelegate()->toArray();

                $event->sheet->getColumnDimension('A')->setWidth(5);
                $event->sheet->getColumnDimension('B')->setWidth(15);
                $event->sheet->getColumnDimension('C')->setWidth(12);
                $event->sheet->getColumnDimension('D')->setWidth(12);
                $event->sheet->getColumnDimension('E')->setWidth(13);
                $event->sheet->getColumnDimension('F')->setWidth(10);
                $event->sheet->getColumnDimension('G')->setWidth(12);
                $event->sheet->getColumnDimension('H')->setWidth(12);
                $event->sheet->getColumnDimension('I')->setWidth(12);
                $event->sheet->getColumnDimension('J')->setWidth(13);
                $event->sheet->getColumnDimension('K')->setWidth(12);
                $event->sheet->getColumnDimension('L')->setWidth(12);
                $event->sheet->getColumnDimension('M')->setWidth(12);
                $event->sheet->getColumnDimension('N')->setWidth(12);
                $event->sheet->getColumnDimension('O')->setWidth(12);
                $event->sheet->getColumnDimension('P')->setWidth(12);
                $event->sheet->getColumnDimension('Q')->setWidth(12);
                $event->sheet->getColumnDimension('R')->setWidth(12);

                $event->sheet->styleCells(
                    'A1:R6',
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ],
                        'font' => [
                            'bold' =>true
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A7:A'.count($rows),
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
                    'B7:E'.count($rows),
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'F7:R'.count($rows),
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ]
                    ]
                );
            },
        ];
    }


    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View
    {
        $data = $this->data;
        return view('farmasi.laporan.view.pelayanan-kefarmasian-jatim',$data);
    }
}

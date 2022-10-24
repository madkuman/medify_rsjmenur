<?php

namespace App\Exports\Farmasi;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Datetime;

class ResepObat implements FromView, WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(7);
                $event->sheet->getColumnDimension('B')->setWidth(25);
                $event->sheet->getColumnDimension('C')->setWidth(20);
                $event->sheet->getColumnDimension('D')->setWidth(15);
                $event->sheet->getColumnDimension('E')->setWidth(25);
                
                $event->sheet->styleCells(
                    'A1:G6',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'A5:A6',
                    [
                        'font' => [
                            'size' => 14,
                            'bold' => true
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'A8:A9',
                    [
                        'font' => [
                            'bold' => true
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'A11:E11',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ],
                        'font' => [
                            'bold' => true
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'A11:E'.($this->rowNumber+12),
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

    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View
    {
        $data['items'] = $this->data['items'];
        $data['pasien'] = $this->data['pasien'];
        $data['min_date'] = str_replace('/', '-', $this->data['min_date']);
        $data['max_date'] = str_replace('/', '-', $this->data['max_date']);
        $this->rowNumber = count($data['items']);

        return view('farmasi.laporan.resep-obat-xls', [
            'items' => $data['items'],
            'pasien' => $data['pasien'],
            'min_date' => $data['min_date'],
            'max_date' => $data['max_date']
        ]);
    }
}

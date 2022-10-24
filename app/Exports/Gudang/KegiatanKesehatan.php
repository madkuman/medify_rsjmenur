<?php

namespace App\Exports\Gudang;

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

class KegiatanKesehatan implements FromView, WithEvents, ShouldAutoSize
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                $event->sheet->styleCells(
                    'A1:A8',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'A6:A8',
                    [
                        'font' => [
                            'size' => 14,
                            'bold' => true
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'A10:L11',
                    [
                        'alignment' => [
                            'wrapText' => true,
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'A10:A'.($this->rowNumber+11),
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'L10:L'.($this->rowNumber+11),
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'C10:C'.($this->rowNumber+11),
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'D12:K'.($this->rowNumber+12),
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'A10:L'.($this->rowNumber+11),
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ],
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
        $data['min_date'] = str_replace('/', '-', $this->data['min_date']);
        $data['max_date'] = str_replace('/', '-', $this->data['max_date']);
        $this->rowNumber = count($data['items']);

        return view('warehouse.laporan.kegiatan-kesehatan-xls', [
            'items' => $data['items'],
            'min_date' => $data['min_date'],
            'max_date' => $data['max_date']
        ]);
    }
}

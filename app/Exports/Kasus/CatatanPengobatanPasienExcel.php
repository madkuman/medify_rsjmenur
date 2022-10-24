<?php

namespace App\Exports\Kasus;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;

class CatatanPengobatanPasienExcel implements FromView, WithEvents
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class   => function(AfterSheet $event) {
                $event->sheet->getColumnDimension('B')->setWidth(40);

                $event->sheet->styleCells(
                    'A3:B9',
                    [
                        'alignment' => [
                            'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'wrapText'      => TRUE, 
                            'textRotation'  => 0
                        ]
                    ]
                );
                
                $event->sheet->styleCells(
                    'A10:A500',
                    [
                        'alignment' => [
                            'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'      => TRUE,
                            'textRotation'  => 0
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
        return view('kasus.farmasi.pengobatan-components.excel', $data);
    }
}

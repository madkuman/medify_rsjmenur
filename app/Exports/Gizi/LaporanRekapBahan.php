<?php

namespace App\Exports\Gizi;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanRekapBahan implements FromView, WithEvents, ShouldAutoSize
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                
                $event->sheet->styleCells(
                    'A1:Z7',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]
                    ]
                );

                /*$event->sheet->styleCells(
                    'A3:Z3',
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );*/

                $event->sheet->styleCells(
                    'A9:Z550',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'C1:C2',
                    [
                        'font' => [
                            'bold' => true
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A2',
                    [
                        'font' => [
                            'underline' => true
                        ]
                    ]
                );


                $event->sheet->styleCells(
                    'A5:F10',
                    [
                        'font' => [
                            'bold' => true
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'W9',
                    [
                        'alignment' => [
                            'wrapText' => true
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A8:F'.$this->count.'',
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
                    'F'.$this->total.'',
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
                    'D'.$this->total.':F'.$this->total.'',
                    [
                        'font' => [
                            'bold' => true
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'L26:L31',
                    [
                        'font' => [
                            'size' => 14
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'L26:L31',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                        ]
                    ]
                );

            }
        ];
    }

    public function __construct($data)
    {	
        $this->data = $data;
        $this->count = count($data);
        $this->count = 7+$this->count;
        $this->total = $this->count + 1;
        //dd($this->count);
    }

    public function view(): View
    {
        $data = $this->data;
        $mulai = $this->data['mulai'];
        $akhir = $this->data['akhir'];
        $total = $this->data['total_akhir'];
        dd($data);
        /*dd($data);*/
        unset($data['mulai'],$data['akhir'],$data['total_akhir']);
        return view('gizi.laporan.belanja-bahan',['data'=>$data,'mulai'=>$mulai,'akhir'=>$akhir, 'total'=>$total]);
    }
}
?>
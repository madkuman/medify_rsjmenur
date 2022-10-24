<?php

namespace App\Exports\Keuangan;

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

class BukuKas implements FromView, WithEvents, ShouldAutoSize
{
	use Exportable;

	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {
                $a = 1;
                for($i = 0; $i < $this->kas['page']; $i++) 
				{
                    $start = $a + $i*($this->kas['perpage']+16);
                    $end = $start + 2;
                    $event->sheet->styleCells(
                        'A'.$start.':C'.$end,
                        [
                            'alignment' => [
                                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                            ],
                            'font' => [
                                'size' => 10,
                            ]
                        ]
                    );
                    $event->sheet->styleCells(
                        'D'.$start.':K'.$end,
                        [
                            'font' => [
                                'size' => 10,
                            ]
                        ]
                    );
                    $start = $start + 3;
                    $end = $start;
                    $event->sheet->styleCells(
                        'A'.$start.':K'.$end,
                        [
                            'alignment' => [
                                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                            ],
                            'font' => [
                                'size' => 12,
                                'bold' => true,
                            ]
                        ]
                    );
                    $start = $start + 1;
                    $end = $start + 1;
                    $event->sheet->styleCells(
                        'A'.$start.':K'.$end,
                        [
                            'alignment' => [
                                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                            ],
                            'font' => [
                                'size' => 10,
                                'bold' => true,
                            ]
                        ]
                    );
                    $start = $start + 2;
                    $end = $start + 2;
                    $event->sheet->styleCells(
                        'A'.$start.':K'.$end,
                        [
                            'font' => [
                                'size' => 10,
                            ]
                        ]
                    );
                    $start = $start + 3;
                    $end = $start + 3;
                    $event->sheet->styleCells(
                        'A'.$start.':K'.$end,
                        [
                            'alignment' => [
                                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                            ],
                            'borders' => [
                                'allBorders' => [
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                    'color' => ['argb' => '00000000'],
                                ],
    
                            ],
                            'font' => [
                                'size' => 10,
                                'bold' => true,
                            ]
                        ]
                    );
                    $start = $start + 4;
                    if($i == $this->kas['page']-1 && ($this->kas['count'] % $this->kas['perpage'])>0)
                        $end = $start + ($this->kas['count'] % $this->kas['perpage']) + 1;
                    else
                        $end = $start + $this->kas['perpage'] + 1;
                    for($col = 'A'; $col <= 'K'; $col++) 
                    {
                        
                        $event->sheet->styleCells(
                            $col.$start.':'.$col.$end,
                            [
                                'borders' => [
                                    'right' => [
                                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                        'color' => ['argb' => '00000000'],
                                    ],
                                    'left' => [
                                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                        'color' => ['argb' => '00000000'],
                                    ],

                                ],
                                'font' => [
                                    'size' => 10,
                                ]
                            ]
                        );
					    
                        $event->sheet->styleCells(
                            $col.$end,
                            [
                                'borders' => [
                                    'bottom' => [
                                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                        'color' => ['argb' => '00000000'],
                                    ],
                                    'top' => [
                                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                        'color' => ['argb' => '00000000'],
                                    ],

                                ],
                                'font' => [
                                    'bold' => true,
                                ]
                            ]
                        );
                    }
                }
			},
		];
	}

	public function __construct($kas){
		$this->kas = $kas;
	}

	public function view(): View
	{
		return view('keuangan.laporan.kas.buku-kas-print',$this->kas);
	}
}
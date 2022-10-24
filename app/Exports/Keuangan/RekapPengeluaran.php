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

class RekapPengeluaran implements FromView, WithEvents, ShouldAutoSize
{
	use Exportable;

	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {
                $a = 1;
                $start = $a;
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
                $col = 'A';
                for($i = 0; $i < $this->rekapkeluar['column']['num']+3; $i++) 
                { 
                    $start = $a + 3;
                    $end = $start;
                    $event->sheet->styleCells(
                        $col.$start.':'.$col.$end,
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
                        $col.$start.':'.$col.$end,
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
                    $start = $start + 3;
                    $end = $start + 4;
                    $event->sheet->styleCells(
                        $col.$start.':'.$col.$end,
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
                    $col++;
                }
                $start = $start + 5;
                $end = $start + $this->rekapkeluar['count'];
                $col = 'A';
                for($i = 0; $i < $this->rekapkeluar['column']['num']+3; $i++) 
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

                    $col++;
                }   
			},
		];
	}

	public function __construct($rekapkeluar){
		$this->rekapkeluar = $rekapkeluar;
	}

	public function view(): View
	{
		return view('keuangan.laporan.pengeluaran.rekap-pengeluaran-print',$this->rekapkeluar);
	}
}
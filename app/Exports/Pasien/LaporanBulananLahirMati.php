<?php

namespace App\Exports\Pasien;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class LaporanBulananLahirMati implements FromView, WithEvents
{
    use Exportable;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $this->max_column = count($this->data[0]) ?? 20;

                $event->sheet->setShowGridlines(false);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getColumnDimension('E')->setAutoSize(true);

                $start_row = 5;
                $first_row = 7;

                $this->max_row = $event->sheet->getHighestRow();


                #all
                $event->sheet->styleCells(
                    $this->toRange([1, 1, $this->max_column, $this->max_row]),
                    [
                        'font' => [
                            'name' => 'Calibri',
                            'size' => 11
                        ],
                    ]
                );

                #headers
                $event->sheet->styleCells(
                    $this->toRange([1, 1, $this->max_column, 1]),
                    [
                        'font' => [
                            'name' => 'Calibri',
                            'size' => 14,
                            'bold' => true,
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                    ]
                );

                #header-detail
                $event->sheet->styleCells(
                    $this->toRange([1, 2, $this->max_column, $start_row - 1]),
                    [
                        'font' => [
                            'name' => 'Calibri',
                            'size' => 12,
                            'bold' => true,
                        ],
                    ]
                );

                #all-table
                $event->sheet->styleCells(
                    $this->toRange([1, $start_row, $this->max_column, $this->max_row]),
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ],
                    ]
                );

                #table-headers
                $event->sheet->styleCells(
                    $this->toRange([1, $start_row, $this->max_column, $start_row + 1]),
                    [
                        'font' => [
                            'bold' => true,
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                    ]
                );

                #table-footer
                $event->sheet->styleCells(
                    $this->toRange([1, $this->max_row, $this->max_column, $this->max_row]),
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                    ]
                );

                #table-body
                $event->sheet->styleCells(
                    $this->toRange([1, $first_row, $this->max_column, $this->max_row - 1]),
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                    ]
                );
            },
        ];
    }

    public function __construct($param)
    {
        if (is_array($param)) $param = (object) $param;

        $this->data = $param->data;
        $this->date_start = $param->date_start;
        $this->date_end = $param->date_end;
    }

    public function view(): View
    {
        $data = [
            'data' => $this->data,
            'max_column' => count($this->data[0]) ?? 20,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
        ];
        return view('pasien.laporanv2.pages.dkk-15-laporan-bulanan-lahir-mati.excel', $data);
    }


    private function toRange($arr)
    {
        $range = "";
        if (!is_string($arr[0])) $arr[0] = Coordinate::stringFromColumnIndex($arr[0]);
        $range .= $arr[0] . $arr[1];
        if (count($arr) == 4) {
            if (!is_string($arr[2])) $arr[2] = Coordinate::stringFromColumnIndex($arr[2]);
            $range .= ":" . $arr[2] . $arr[3];
        }
        return $range;
    }
}

<?php

namespace App\Exports\Pasien;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class LaporanBulananIspa implements FromView, WithEvents
{
    use Exportable;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $this->max_row = 5;
                $this->max_column = 50;

                $event->sheet->setShowGridlines(false);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);


                $start_row = 5;
                $event->sheet->freezePane($this->toRange([1, $start_row + 5]));

                $row = $start_row + 5;


                #data

                $sigma_col = [5, 8, 11, 14, 17, 20, 23, 27, 30, 33, 37, 40, 43, 47, 50];

                $first_row = $row;
                foreach ($this->data as $item) {
                    foreach ($item as $key => $value) {
                        $event->sheet->setCellValue($this->toRange([$key + 1, $row]), $value);
                        if (in_array($key + 1, $sigma_col)) {
                            $event->sheet->setCellValue($this->toRange([$key + 1, $row]), '=SUM(' . $this->toRange([$key - 1, $row, $key, $row]) . ')');
                        }
                    }
                    $event->sheet->setCellValue($this->toRange([15, $row]), '=' . $this->toRange([3, $row]) . '+'. $this->toRange([9, $row]));
                    $event->sheet->setCellValue($this->toRange([16, $row]), '=' . $this->toRange([4, $row]) . '+'. $this->toRange([10, $row]));
                    $event->sheet->setCellValue($this->toRange([18, $row]), '=' . $this->toRange([6, $row]) . '+'. $this->toRange([12, $row]));
                    $event->sheet->setCellValue($this->toRange([19, $row]), '=' . $this->toRange([7, $row]) . '+'. $this->toRange([13, $row]));
                    $event->sheet->setCellValue($this->toRange([21, $row]), '=' . $this->toRange([15, $row]) . '+'. $this->toRange([18, $row]));
                    $event->sheet->setCellValue($this->toRange([22, $row]), '=' . $this->toRange([16, $row]) . '+'. $this->toRange([19, $row]));

                    $event->sheet->setCellValue($this->toRange([24, $row]), '=IF(SUM('.$this->toRange([23,$first_row, 23, $first_row+count($this->data)-1]).')<>0,(100*'.$this->toRange([23, $row]).'/(SUM('.$this->toRange([23,$first_row, 23, $first_row+count($this->data)-1]).'))),0)');

                    $event->sheet->setCellValue($this->toRange([41, $row]), '=' . $this->toRange([35, $row]) . '+'. $this->toRange([38, $row]));
                    $event->sheet->setCellValue($this->toRange([42, $row]), '=' . $this->toRange([36, $row]) . '+'. $this->toRange([39, $row]));
                    $event->sheet->setCellValue($this->toRange([44, $row]), '=IF('.$this->toRange([23,$row]).'=0,0,(100*'.$this->toRange([43,$row]).'/'.$this->toRange([23,$row]).'))');
                    $row++;
                }

                $event->sheet->setCellValue($this->toRange([1, $row]), "Total");
                $event->sheet->mergeCells($this->toRange([1, $row, 2, $row]));
                for ($i = 0; $i < 48; $i++) {
                    $event->sheet->setCellValue($this->toRange([$i + 3, $row]), '=SUM(' . $this->toRange([$i + 3, $first_row, $i + 3, $row - 1]) . ')');
                }
                $row++;

                $this->max_row = $row - 1;


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
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
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
                    $this->toRange([1, $start_row, $this->max_column, $start_row + 4]),
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
                        'font' => [
                            'bold' => true,
                        ],
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
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
        ];
        return view('pasien.laporanv2.pages.dkk-33-laporan-bulanan-ispa.excel', $data);
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

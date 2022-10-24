<?php

namespace App\Exports\Pasien;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class LaporanBulananDiare implements WithEvents
{
    use Exportable;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $this->max_row = 15;
                $this->max_column = 46;
                $event->sheet->setShowGridlines(false);
                $event->sheet->getColumnDimension('B')->setWidth(40);

                $event->sheet->setCellValue($this->toRange([1, 1]), "LAPORAN BULANAN DIARE");
                $event->sheet->mergeCells($this->toRange([1, 1, $this->max_column, 1]));
                
                $event->sheet->setCellValue($this->toRange([1, 3]), "PERIODE : ". $this->date_start->format('d-m-Y')." - ". $this->date_end->format('d-m-Y'));
                $start_row = 4;
                $event->sheet->freezePane($this->toRange([1, $start_row + 4]));

                $row = $start_row;
                #header
                ##header row 1
                $event->sheet->setCellValue($this->toRange([1, $row]), "No");
                $event->sheet->mergeCells($this->toRange([1, $row, 1, $row + 3]));
                $event->sheet->setCellValue($this->toRange([2, $row]), "FASYANKES");
                $event->sheet->mergeCells($this->toRange([2, $row, 2, $row + 3]));
                $event->sheet->setCellValue($this->toRange([3, $row]), "FASILITAS PELAYANAN KESEHATAN");
                $event->sheet->mergeCells($this->toRange([3, $row, 46, $row]));

                $row++;
                ##header row 2
                $temp_col = 3;
                $list_age_range = [
                    '0 - 6 Bln',
                    '≥ 6 Bln - < 1 Th',
                    '1 - 4 Th',
                    '5 - 9 Th',
                    '10 - 14 Th',
                    '15 - 19Th',
                    '> 20 Th',
                    'JUMLAH',
                ];

                foreach ($list_age_range as $item) {
                    $event->sheet->setCellValue($this->toRange([$temp_col, $row]), $item);
                    $event->sheet->mergeCells($this->toRange([$temp_col, $row, $temp_col + 3, $row]));
                    $temp_col += 4;
                }

                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), 'Penderita Diare < 5 Th Diberi');
                $event->sheet->mergeCells($this->toRange([$temp_col, $row, $temp_col + 4, $row]));
                $temp_col += 5;

                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), 'Penderita Diare > 5 Th Diberi');
                $event->sheet->mergeCells($this->toRange([$temp_col, $row, $temp_col + 1, $row + 1]));
                $temp_col += 2;

                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), 'Jumlah Pemakaian');
                $event->sheet->mergeCells($this->toRange([$temp_col, $row, $temp_col + 4, $row]));

                $row++;
                ##header col 3
                $temp_col = 3;
                for ($i = 0; $i < 8; $i++) {
                    $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "P");
                    $event->sheet->mergeCells($this->toRange([$temp_col, $row, $temp_col + 1, $row]));
                    $temp_col += 2;
                    $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "M");
                    $event->sheet->mergeCells($this->toRange([$temp_col, $row, $temp_col + 1, $row]));
                    $temp_col += 2;
                }

                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "Oralit");
                $event->sheet->mergeCells($this->toRange([$temp_col, $row, $temp_col, $row + 1]));
                $temp_col++;

                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "ZINC");
                $event->sheet->mergeCells($this->toRange([$temp_col, $row, $temp_col + 2, $row]));
                $temp_col += 3;

                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "RL");
                $event->sheet->mergeCells($this->toRange([$temp_col, $row, $temp_col, $row + 1]));
                $temp_col++;

                ###jarak untuk yang tidak ada zinc nya :D
                $temp_col += 2;

                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "Oralit");
                $event->sheet->mergeCells($this->toRange([$temp_col, $row, $temp_col, $row + 1]));
                $temp_col++;

                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "ZINC");
                $event->sheet->mergeCells($this->toRange([$temp_col, $row, $temp_col + 2, $row]));
                $temp_col += 3;

                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "RL");
                $event->sheet->mergeCells($this->toRange([$temp_col, $row, $temp_col, $row + 1]));
                $temp_col++;

                $row++;
                ##header col 3
                $temp_col = 3;
                for ($i = 0; $i < 16; $i++) {
                    $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "L");
                    $temp_col++;
                    $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "P");
                    $temp_col++;
                }

                $temp_col++;
                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "0 - 5 bln");
                $temp_col++;
                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "≥ 6 Bln - < 1 Th");
                $temp_col++;
                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "1 - 4 Th");
                $temp_col++;
                $temp_col++;
                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "Oralit");
                $temp_col++;
                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "RL");
                $temp_col++;
                $temp_col++;
                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "0 - 5 bln");
                $temp_col++;
                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "≥ 6 Bln - < 1 Th");
                $temp_col++;
                $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "1 - 4 Th");
                $row++;

                #data
                $row_start_data = $row;
                foreach ($this->data as $item) {
                    foreach ($item as $key => $value) {
                        $event->sheet->setCellValue($this->toRange([$key + 1, $row]), $value);
                    }
                    $row++;
                }

                #footer
                $event->sheet->setCellValue($this->toRange([1, $row]), "Jumlah");
                $event->sheet->mergeCells($this->toRange([1, $row, 2, $row]));
                for ($temp_col = 3; $temp_col <= $this->max_column; $temp_col++) {
                    $event->sheet->setCellValue($this->toRange([$temp_col, $row]), "=SUM(" . $this->toRange([$temp_col, $row_start_data, $temp_col, $row - 1]) . ")");
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
                    $this->toRange([1, 1, $this->max_column, $start_row - 2]),
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
                #subHeader
                $event->sheet->styleCells(
                    $this->toRange([1, $start_row - 2, $this->max_column, $start_row - 1]),
                    [
                        'font' => [
                            'name' => 'Calibri',
                            'size' => 11,
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
                            'bottom' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
                                'color' => ['argb' => '00000000'],
                            ],
                        ],
                    ]
                );

                #table-headers
                $event->sheet->styleCells(
                    $this->toRange([1, $start_row, $this->max_column, $start_row + 3]),
                    [
                        'font' => [
                            'bold' => true,
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
                                'color' => ['argb' => '00000000'],
                            ],
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
                    ]
                );
            },
        ];
    }

    public function __construct($param)
    {
        if (is_array($param)) $param = (object) $param;

        $this->date_start = $param->date_start;
        $this->date_end = $param->date_end;
        $this->data = $param->data;
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

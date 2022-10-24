<?php

namespace App\Exports\Pasien;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class LaporanBulananKatarak implements WithEvents
{
    use Exportable;

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $this->max_row = 5;
                $this->max_column = 10;

                $event->sheet->setShowGridlines(false);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getColumnDimension('J')->setAutoSize(true);

                $event->sheet->setCellValue($this->toRange([1, 1]), "FORM LAPORAN PASIEN KATARAK DAN PASIEN KATARAK YANG SUDAH DIOPERASI");
                $event->sheet->mergeCells($this->toRange([1, 1, $this->max_column, 1]));
                $event->sheet->setCellValue($this->toRange([1, 2]), "RUMAH SAKIT ");
                $event->sheet->mergeCells($this->toRange([1, 2, 2, 2]));
                $event->sheet->setCellValue($this->toRange([1, 3]), "PERIODE ");
                $event->sheet->mergeCells($this->toRange([1, 3, 2, 3]));
                $event->sheet->setCellValue($this->toRange([3, 2]), ":  ".config('app.name'));
                $event->sheet->setCellValue($this->toRange([3, 3]), ":  ".$this->date_start->format('d-m-Y').' - '.$this->date_end->format('d-m-Y'));

                $start_row = 5;
                $event->sheet->freezePane($this->toRange([1, $start_row + 3]));

                $row = $start_row;
                #header
                ##header row 1
                $event->sheet->setCellValue($this->toRange([1, $row]), "No");
                $event->sheet->mergeCells($this->toRange([1, $row, 1, $row + 1]));
                $event->sheet->setCellValue($this->toRange([2, $row]), "NAMA PASIEN");
                $event->sheet->mergeCells($this->toRange([2, $row, 2, $row + 1]));
                $event->sheet->setCellValue($this->toRange([3, $row]), "NIK");
                $event->sheet->mergeCells($this->toRange([3, $row, 3, $row + 1]));
                $event->sheet->setCellValue($this->toRange([4, $row]), "ALAMAT");
                $event->sheet->setCellValue($this->toRange([5, $row]), "UMUR");
                $event->sheet->mergeCells($this->toRange([5, $row, 6, $row]));
                $event->sheet->mergeCells($this->toRange([4, $row, 4, $row + 1]));
                $event->sheet->setCellValue($this->toRange([7, $row]), "DIAGNOSA / KODE ICD X");
                $event->sheet->mergeCells($this->toRange([7, $row, 7, $row + 1]));
                $event->sheet->setCellValue($this->toRange([8, $row]), "OPERASI KATARAK");
                $event->sheet->mergeCells($this->toRange([8, $row, 9, $row]));
                $event->sheet->setCellValue($this->toRange([10, $row]), "TANGGAL OPERASI");
                $event->sheet->mergeCells($this->toRange([10, $row, 10, $row + 1]));

                $row++;

                #header row 2
                $event->sheet->setCellValue($this->toRange([5, $row]), "L");
                $event->sheet->setCellValue($this->toRange([6, $row]), "P");
                $event->sheet->setCellValue($this->toRange([8, $row]), "SUDAH");
                $event->sheet->setCellValue($this->toRange([9, $row]), "BELUM");
                $row++;

                #header row3
                for($i = 1; $i <= $this->max_column; $i++){
                    $event->sheet->setCellValue($this->toRange([$i, $row]), $i);
                }
                $row++;
                
                #data
                foreach ($this->data as $item) {
                    foreach ($item as $key => $value) {
                        $event->sheet->setCellValue($this->toRange([$key + 1, $row]), $value);
                    }
                    $row++;
                }

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
                    $this->toRange([1, $start_row, $this->max_column, $start_row + 2]),
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

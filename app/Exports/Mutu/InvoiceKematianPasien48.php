<?php

namespace App\Exports\Mutu;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use Datetime;

class InvoiceKematianPasien48 implements FromView, WithEvents
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $rows = $event->sheet->getDelegate()->toArray();
                $rows = count($rows);

                $event->sheet->getColumnDimension('A')->setWidth(5);
                $event->sheet->getColumnDimension('B')->setWidth(30);
                $event->sheet->getColumnDimension('C')->setWidth(23);
                $event->sheet->getColumnDimension('D')->setWidth(23);
                $event->sheet->getColumnDimension('E')->setWidth(20);
                $event->sheet->getColumnDimension('F')->setWidth(12);
                $event->sheet->getColumnDimension('G')->setWidth(30);
                $event->sheet->getColumnDimension('H')->setWidth(15);

                $event->sheet->styleCells(
                    'A1:H'.$rows,
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ],
                    ]
                );

                $event->sheet->styleCells(
                    'A1:H2',
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'textRotation' => 0
                        ],
                        'font' => [
                            'size' => 12,
                            'bold' => true,
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A7:A'.$rows,
                    [
                        'alignment' => [
                            'horizontal'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ],
                    ]
                );

                $event->sheet->styleCells(
                    'H7:H'.$rows,
                    [
                        'alignment' => [
                            'horizontal'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText'     => TRUE,
                            'textRotation' => 0
                        ],
                    ]
                );

                foreach($this->header as $item)
                {
                    $event->sheet->styleCells(
                        'A'.$item.':H'.$item,
                        [
                            'alignment' => [
                                'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                                'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                'textRotation' => 0
                            ],
                            'font' => [
                                'bold'  =>  true
                            ]
                        ]
                    );
                }
            },
        ];
    }


    public function __construct($data){
        $this->data = $data;
        $row = 7;
        $header = [];
        $lokasi = -1;
        foreach($data['data'] as $index => $item)
        {
            $lokasi_current = (!empty($item->lokasi->lokasi) ? $item->lokasi->lokasi->id : 0);
            $count_diagnosis = count($item->diagnosis);
            if($lokasi != $lokasi_current){
                if ($lokasi == -1) {
                    array_push($header, $row-1);
                    array_push($header, $row-2);
                    array_push($header, $row-3);
                } else {
                    $row += 8;
                    array_push($header, $row-1);
                    array_push($header, $row-2);
                    array_push($header, $row-3);
                }
                $lokasi = $lokasi_current;
            }
            $row += $count_diagnosis>0 ? $count_diagnosis : 1;
        }
        $this->header = $header;
    }

    public function view(): View
    {
        $data = $this->data;
        $this->row_number=count($data['data'])*10;
        return view('mutu.laporan.kematian-pasien-48',$data);
    }
}

<?php

namespace App\Exports\Farmasi;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class LaporanBeritaAcaraPemeriksaaanFormatBA implements FromView, WithEvents, WithColumnFormatting, WithDrawings
{
    use Exportable;

    public function registerEvents(): array
    {
        $config_excel['text_center'] = [
            'alignment' => [
                'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'textRotation' => 0
            ]
        ]; 
        $config_excel['text_bold'] = [
            'font' => [
                'bold' => true
            ],
        ];
        $config_excel['border_bottom'] = [
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ]
        ];
        return [
            AfterSheet::class    => function(AfterSheet $event) use ($config_excel) {

                $event->sheet->getColumnDimension('A')->setWidth(12);
                $event->sheet->getColumnDimension('B')->setWidth(12);
                $event->sheet->getColumnDimension('C')->setWidth(12);
                $event->sheet->getColumnDimension('D')->setWidth(12);
                $event->sheet->getColumnDimension('E')->setWidth(12);
                $event->sheet->getColumnDimension('F')->setWidth(12);
                $event->sheet->getColumnDimension('G')->setWidth(12);

                $event->sheet->styleCells('A8:A9',$config_excel['text_center']); 
                $event->sheet->styleCells('A8:A9',$config_excel['text_bold']);  

                $row_total = 29 + $this->count_data;
                $event->sheet->styleCells('B'.$row_total.':E'.$row_total,$config_excel['border_bottom']);  

                
                $jabatan_ttd = 35 + $this->count_data;
                $event->sheet->styleCells('A'.$jabatan_ttd.':G'.$jabatan_ttd,$config_excel['text_center']);  
                
                $jabatan_ttd = 39 + $this->count_data;
                $event->sheet->styleCells('A'.$jabatan_ttd.':G'.$jabatan_ttd,$config_excel['text_center']); 
                $event->sheet->styleCells('A'.$jabatan_ttd.':G'.$jabatan_ttd,$config_excel['text_bold']);   
                $jabatan_ttd = 40 + $this->count_data;
                $event->sheet->styleCells('A'.$jabatan_ttd.':G'.$jabatan_ttd,$config_excel['text_center']); 

            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => '#,##0',
        ];
    }

    public function drawings()
    {
        $path = config('app.kop_lg');
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path($path));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function __construct($data)
    {
        $this->data = $data;
        $this->count_data = count($data['data']);
    }

    public function view(): View
    {
        return view('farmasi.laporan.view.laporan-berita-acara-pemeriksaan-format-ba', $this->data);
    }
}

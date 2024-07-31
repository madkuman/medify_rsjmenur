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

class LaporanBeritaAcaraPemeriksaanFormatLampiran implements FromView, WithEvents, WithColumnFormatting, WithDrawings
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
        $config_excel['wrap_text'] = [
            'alignment' => [
                'wrapText'     => TRUE,
            ]
        ];
        $config_excel['border_bottom'] = [
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ]
        ];
        $config_excel['border_all'] = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ]
        ];
        return [
            AfterSheet::class    => function(AfterSheet $event) use ($config_excel) {

                $event->sheet->getColumnDimension('A')->setWidth(6);
                $event->sheet->getColumnDimension('B')->setWidth(9);
                $event->sheet->getColumnDimension('C')->setWidth(9);
                $event->sheet->getColumnDimension('D')->setWidth(25);
                $event->sheet->getColumnDimension('E')->setWidth(9);
                $event->sheet->getColumnDimension('F')->setWidth(11);
                $event->sheet->getColumnDimension('G')->setWidth(11);
                $event->sheet->getColumnDimension('H')->setWidth(11);

                $event->sheet->styleCells('A8:A9',$config_excel['text_center']); 
                $event->sheet->styleCells('A8:A9',$config_excel['text_bold']);  
                $event->sheet->styleCells('A15:H16',$config_excel['text_bold']);  
                $event->sheet->styleCells('A15:H16',$config_excel['text_center']);  
                $event->sheet->styleCells('A15:H16',$config_excel['wrap_text']);  

                $row = 17;
                foreach($this->data['data'] as $item)
                {
                    if(empty($item->item_template_list)) continue;
                    
                    $event->sheet->styleCells('A'.$row.':H'.$row,$config_excel['text_bold']);
                    $event->sheet->styleCells('A'.$row.':B'.$row,$config_excel['text_center']);
                    $row++;
                    foreach($item->item_template_list as $item_template){
                        $row++;
                    }
                    $event->sheet->styleCells('A'.$row.':H'.$row,$config_excel['text_bold']);
                    $row++;
                    $row++;
                }
                $event->sheet->styleCells('A'.$row.':H'.$row,$config_excel['text_bold']); 

                $event->sheet->styleCells('A15:H'.$row,$config_excel['border_all']);  
                
                $jabatan_ttd = $row + 2;
                $event->sheet->styleCells('A'.$jabatan_ttd.':G'.$jabatan_ttd,$config_excel['text_center']);  
                $jabatan_ttd = $row + 3;
                $event->sheet->styleCells('A'.$jabatan_ttd.':G'.$jabatan_ttd,$config_excel['text_center']);  
                
                $jabatan_ttd = $row + 6;
                $event->sheet->styleCells('A'.$jabatan_ttd.':G'.$jabatan_ttd,$config_excel['text_center']); 
                $event->sheet->styleCells('A'.$jabatan_ttd.':G'.$jabatan_ttd,$config_excel['text_bold']);   
                $jabatan_ttd = $row + 7;
                $event->sheet->styleCells('A'.$jabatan_ttd.':G'.$jabatan_ttd,$config_excel['text_center']); 

            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => '#,##0',
            'G' => '#,##0',
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
        return view('farmasi.laporan.view.laporan-berita-acara-pemeriksaan-format-lampiran', $this->data);
    }
}

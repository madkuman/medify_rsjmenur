<?php

namespace App\Exports\General;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class TemplateGeneralExcel implements FromView, WithEvents, WithColumnFormatting
{

    use Exportable;

    public function registerEvents(): array
    {

        $cell_configs['config_cells_border'] = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ]
        ];
        $cell_configs['config_cells_text_center'] = [
            'alignment' => [
                'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'wrapText'     => TRUE,
                'textRotation' => 0
            ]
        ];
        $cell_configs['config_cells_text_center_vertical'] = [
            'alignment' => [
                'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText'     => TRUE,
                'textRotation' => 0
            ]
        ];


        return [
            AfterSheet::class    => function (AfterSheet $event) use ($cell_configs) {

                if (!empty($this->data['cellBorder'])) {
                    foreach ($this->data['cellBorder'] as $cells) {
                        $event->sheet->styleCells($cells, $cell_configs['config_cells_border']);
                    }
                }
                if (!empty($this->data['cellCenterText'])) {
                    foreach ($this->data['cellCenterText'] as $cells) {
                        $event->sheet->styleCells($cells, $cell_configs['config_cells_text_center']);
                    }
                }
                if (!empty($this->data['cellCenterTextVertical'])) {
                    foreach ($this->data['cellCenterTextVertical'] as $cells) {
                        $event->sheet->styleCells($cells, $cell_configs['config_cells_text_center_vertical']);
                    }
                }

                if (!empty($this->data['cellWidth'])) {
                    foreach ($this->data['cellWidth'] as $cells) {
                        $event->sheet->getColumnDimension($cells['col'])->setWidth($cells['width']);
                    }
                }
            },
        ];
    }



    public function columnFormats(): array
    {
        $array = [];
        if (!empty($this->data['numberFormat'])) {
            foreach ($this->data['numberFormat'] as $col) {
                $array[$col] = '#,##0';
            }
        }

        return $array;
    }

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view($this->data['view'], $this->data);
    }
}

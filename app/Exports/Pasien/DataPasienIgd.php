<?php

namespace App\Exports\Pasien;

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

class DataPasienIgd implements FromView, WithEvents
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(6);
                $event->sheet->getColumnDimension('B')->setWidth(9);
                $event->sheet->getColumnDimension('C')->setWidth(30);
                $event->sheet->getColumnDimension('D')->setWidth(15);
                $event->sheet->getColumnDimension('E')->setWidth(30);
                $event->sheet->getColumnDimension('F')->setWidth(10);
                $event->sheet->getColumnDimension('G')->setWidth(13);
                $event->sheet->getColumnDimension('H')->setWidth(10);
                $event->sheet->getColumnDimension('I')->setWidth(10);
                $event->sheet->getColumnDimension('J')->setWidth(12);
                $event->sheet->getColumnDimension('K')->setWidth(6);
                $event->sheet->getColumnDimension('L')->setWidth(10);
                $event->sheet->getColumnDimension('M')->setWidth(10);
                $event->sheet->getColumnDimension('N')->setWidth(12);
                $event->sheet->getColumnDimension('O')->setWidth(10);
                $event->sheet->getColumnDimension('P')->setWidth(10);
                $event->sheet->getColumnDimension('Q')->setWidth(15);
                $event->sheet->getColumnDimension('R')->setWidth(10);
                $event->sheet->getColumnDimension('S')->setWidth(15);
                $event->sheet->getColumnDimension('T')->setWidth(15);
                $event->sheet->getColumnDimension('U')->setWidth(15);
                $event->sheet->getColumnDimension('V')->setWidth(12);
                $event->sheet->getColumnDimension('W')->setWidth(12);
                $event->sheet->getColumnDimension('X')->setWidth(30);
                $event->sheet->getColumnDimension('Y')->setWidth(10);
                $event->sheet->getColumnDimension('Z')->setWidth(15);
                $event->sheet->getColumnDimension('AA')->setWidth(30);

                $event->sheet->getColumnDimension('AB')->setWidth(10);
                $event->sheet->getColumnDimension('AC')->setWidth(30);
                $event->sheet->getColumnDimension('AF')->setWidth(10);
                $event->sheet->getColumnDimension('AE')->setWidth(15);
                $event->sheet->getColumnDimension('AF')->setWidth(15);
                $event->sheet->getColumnDimension('AG')->setWidth(12);
                $event->sheet->getColumnDimension('AH')->setWidth(15);
                $event->sheet->getColumnDimension('AI')->setWidth(12);
                $event->sheet->getColumnDimension('AJ')->setWidth(12);
                $event->sheet->getColumnDimension('AK')->setWidth(12);
                $event->sheet->getColumnDimension('AL')->setWidth(12);
                $event->sheet->getColumnDimension('AM')->setWidth(12);
                $event->sheet->getColumnDimension('AN')->setWidth(12);
                $event->sheet->getColumnDimension('AO')->setWidth(12);
                $event->sheet->getColumnDimension('AP')->setWidth(12);
                $event->sheet->getColumnDimension('AQ')->setWidth(12);
                $event->sheet->getColumnDimension('AR')->setWidth(12);
                $event->sheet->getColumnDimension('AS')->setWidth(15);
                $event->sheet->getColumnDimension('AT')->setWidth(12);
                $event->sheet->getColumnDimension('AU')->setWidth(12);
                $event->sheet->getColumnDimension('AV')->setWidth(12);
                $event->sheet->getColumnDimension('AW')->setWidth(12);

                $event->sheet->styleCells(
                    'A1:AV7',
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'textRotation' => 0,
                            'wrapText'     => TRUE,
                        ]
                    ]
                );
            },
        ];
    }


    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View
    {
        $data = $this->data;
        return view('pasien.laporan.data-pasien-igd',$data);
    }
}

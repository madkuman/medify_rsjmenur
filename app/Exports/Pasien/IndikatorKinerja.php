<?php

namespace App\Exports\Pasien;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;
use Datetime;

class IndikatorKinerja implements FromView, WithEvents
{
	use Exportable;

	public function registerEvents(): array
	{
		return [
			AfterSheet::class=>function(AfterSheet $event) {
				$event->sheet->getColumnDimension('A')->setWidth(4);
				$event->sheet->getColumnDimension('B')->setWidth(13);
				$event->sheet->getColumnDimension('C')->setWidth(11);
				$event->sheet->getColumnDimension('D')->setWidth(11);
				$event->sheet->getColumnDimension('E')->setWidth(7);
				$event->sheet->getColumnDimension('F')->setWidth(7);
				$event->sheet->getColumnDimension('G')->setWidth(7);
				$event->sheet->getColumnDimension('H')->setWidth(7);
				$event->sheet->getColumnDimension('I')->setWidth(7);
				$event->sheet->getColumnDimension('J')->setWidth(7);
				$event->sheet->getColumnDimension('K')->setWidth(7);
				$event->sheet->getColumnDimension('L')->setWidth(7);
				$event->sheet->getColumnDimension('M')->setWidth(7);
				$event->sheet->getColumnDimension('N')->setWidth(11);
				$event->sheet->getColumnDimension('O')->setWidth(11);
				$event->sheet->getColumnDimension('P')->setWidth(10);
				$event->sheet->getColumnDimension('Q')->setWidth(10);
				$event->sheet->getColumnDimension('R')->setWidth(10);
				$event->sheet->getColumnDimension('S')->setWidth(10);
				$event->sheet->getColumnDimension('T')->setWidth(7);
				$event->sheet->getColumnDimension('U')->setWidth(7);
				$event->sheet->getColumnDimension('V')->setWidth(7);
				$event->sheet->getColumnDimension('W')->setWidth(7);
				$event->sheet->getColumnDimension('X')->setWidth(7);
				$event->sheet->getColumnDimension('Y')->setWidth(7);
				$event->sheet->getColumnDimension('Z')->setWidth(7);

				$event->sheet->styleCells(
					'A5:Y20',
					[
						'borders' => [
							'allBorders' => [
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
								'color' => ['argb' => '00000000'],
							],
						],
						'font' => [
							'size' => 12
						]
					]
				);

				$event->sheet->styleCells(
					'A5:Y8',
					[
						'alignment' => [
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'textRotation' => 0,
                            'wrapText' => true
						]
					]
				);

				$event->sheet->styleCells(
					'A9:A21',
					[
						'alignment' => [
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'textRotation' => 0
						]
					]
				);

				$event->sheet->styleCells(
					'N22:N28',
					[
						'alignment' => [
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'textRotation' => 0
						]
					]
				);

				$event->sheet->styleCells(
					'A1:A4',
					[
						'alignment' => [
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'textRotation' => 0
						]
					]
				);

				$event->sheet->styleCells(
                    'A6:S9',
                    [
                        'alignment' => [
                            'wrapText' => true
                        ]
                    ]
                );

				$event->sheet->styleCells(
					'C5:C19',
					[
						'alignment' => [
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'textRotation' => 0
						]
					]
				);
			},
		];
	}

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function view(): View
	{
		return view ('pasien.laporan.indikator-kinerja',$this->data);
	}
}

?>
<?php

namespace App\Exports\Keuangan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Datetime;

class BukuUtang implements FromView, WithEvents, ShouldAutoSize
{
	use Exportable;

	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {
				$event->sheet->styleCells(
					'A1:I2',
					[
						'alignment' => [
							'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
						],
						'font' => [
							'size' => 10,
						]
					]
				);
				$event->sheet->styleCells(
					'A3:I5',
					[
						'alignment' => [
							'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
						],
						'font' => [
							'size' => 12,
							'bold' => true,
						]
					]
				);

				$event->sheet->styleCells(
					'A7:I8',
					[
						'alignment' => [
							'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
						],
						'borders' => [
							'allBorders' => [
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
								'color' => ['argb' => '00000000'],
							],

						],
						'font' => [
							'size' => 10,
							'bold' => true,
						]
					]
				);
				for($i = 'A'; $i <= 'I'; $i++) 
				{
					for($j=8;$j<=$this->rowNumber+8;$j++)
					{
						$event->sheet->styleCells(
							$i.$j,
							[
								'borders' => [
									'right' => [
										'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
										'color' => ['argb' => '00000000'],
									],
									'left' => [
										'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
										'color' => ['argb' => '00000000'],
									],

								],
								'font' => [
									'size' => 10,
								]
							]
						);
					}
					$event->sheet->styleCells(
						$i.($this->rowNumber+8),
						[
							'borders' => [
								'bottom' => [
									'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
									'color' => ['argb' => '00000000'],
								],

							],
						]
					);
				}
				$event->sheet->styleCells(
					'C9:I'.($this->rowNumber+8),
					[
						'alignment' => [
							'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
						],
					]
				);

			},
		];
	}

	public function __construct($utang){
		$this->utang = $utang;
	}

	public function view(): View
	{
		//$utang = app('App\Http\Controllers\Keuangan\Laporan\PemasukanController')->rekapPemasukanPasien($this->start_date,$this->end_date);
		$this->rowNumber = count($this->utang['perusahaan']);
		return view('keuangan.laporan.utang.buku-utang-print',$this->utang);
	}
}
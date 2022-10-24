<?php
namespace App\Exports\Kepegawaian;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;
use Datetime;

class Nominatif implements FromView, WithEvents
{
	use Exportable;

	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {
				$event->sheet->getColumnDimension('A')->setWidth(6);
				$event->sheet->getColumnDimension('B')->setWidth(19);
				$event->sheet->getColumnDimension('C')->setWidth(8);
				$event->sheet->getColumnDimension('D')->setWidth(7);
				$event->sheet->getColumnDimension('E')->setWidth(7);
				$event->sheet->getColumnDimension('F')->setWidth(7);
				$event->sheet->getColumnDimension('G')->setWidth(7);
				$event->sheet->getColumnDimension('H')->setWidth(12);
				$event->sheet->getColumnDimension('I')->setWidth(7);
				$event->sheet->getColumnDimension('J')->setWidth(14);
				$event->sheet->getColumnDimension('K')->setWidth(14);
				$event->sheet->getColumnDimension('L')->setWidth(5);
				$event->sheet->getColumnDimension('M')->setWidth(7);
				$event->sheet->getColumnDimension('N')->setWidth(6);
				$event->sheet->getColumnDimension('O')->setWidth(16);

				//header dinas kesehatan
				$event->sheet->styleCells(
					'A1:D1',
					[
						'alignment' => [
							'horizontal'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'textRotation' => 0,
						],
					]
				);
				$event->sheet->styleCells(
					'A2:D2',
					[
						'alignment' => [
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'horizontal'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'textRotation' => 0,
						],
						'borders' => [
							'bottom' => [
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
								'color' => ['argb' => '00000000'],
							],
						],
					]
				);
				//LAMPIRAN DAN KEPALA RUMKITAL
				$event->sheet->styleCells(
					'L1:O2',
					[
						'alignment' => [
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'textRotation' => 0,
						],
					]
				);

				//

				$event->sheet->styleCells(
					'L3:N4',
					[
						'alignment' => [
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'textRotation' => 0,
						],
					]
				);
				$event->sheet->styleCells(
					'O3:O4',
					[
						'alignment' => [
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'textRotation' => 0,
						],
					]
				);

				$event->sheet->styleCells(
						'A5:O6',
						[
							'alignment' => [
								'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
								'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
								'textRotation' => 0,
								'wrapText'     => TRUE
							],
						]
					);



				//konten tabel border
				$event->sheet->styleCells(
					'A8:O'.($this->rowNumber+9),
					[
						'alignment' => [
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'textRotation' => 0,
							'wrapText'     => TRUE
						],
						'borders' => [
							'allBorders' => [
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
								'color' => ['argb' => '00000000'],
							],
						],
						'font' => [
							'size' => 9
						]
					]
				);

				//kontent tabel rata tengah
				$letters = ['A','C','D','E','F','G','I','L','M','N'];

				foreach($letters as $letter)
				{
					$event->sheet->styleCells(
						$letter.'8:'.$letter.($this->rowNumber+9),
						[
							'alignment' => [
								'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
								'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
								'textRotation' => 0,
								'wrapText'     => TRUE
							],
							'font' => [
								'size' => 9
							]
						]
					);
				}

				//table header
				$event->sheet->styleCells(
					'A8:O9',
					[
						'alignment' => [
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'textRotation' => 0,
							'wrapText'     => TRUE
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

				//tanda tangan
				$event->sheet->styleCells(
					'K'.($this->rowNumber+10).':K'.($this->rowNumber+21),
					[
						'alignment' => [
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'textRotation' => 0
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
		$this->rowNumber = count($this->data['items']);
		return view ('kepegawaian.laporan.nominative-report', $this->data);
	}
}

?>
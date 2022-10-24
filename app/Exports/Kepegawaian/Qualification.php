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

/**
 * 
 */
class Qualification implements FromView, WithEvents
{
	use Exportable;
	
	function __construct($data) {
		$this->data = $data;
	}

	public function columnFormats(): array{
		return [
			'D' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
		];
	}


	public function registerEvents(): array {
		return [
			AfterSheet::class => function(AfterSheet $event) {
				$event->sheet->getColumnDimension('A')->setWidth(6);
				$event->sheet->getColumnDimension('B')->setWidth(19);
				$event->sheet->getColumnDimension('C')->setWidth(8);
				$event->sheet->getColumnDimension('D')->setWidth(15);
				$event->sheet->getColumnDimension('E')->setWidth(10);
				$event->sheet->getColumnDimension('F')->setWidth(12);
				$event->sheet->getColumnDimension('G')->setWidth(12);

				//header dinas kesehatan
				$event->sheet->styleCells(
					'A1:C1',
					[
						'alignment' => [
							'horizontal'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'textRotation' => 0,
						],
					]
				);
				$event->sheet->styleCells(
					'A2:C2',
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
				//judul laporan
				$event->sheet->styleCells(
						'A4:G5',
						[
							'alignment' => [
								'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
								'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
								'textRotation' => 0,
								'wrapText'     => TRUE
							],
						]
					);

				//konten
				$event->sheet->styleCells(
					'A7:G'.($this->rowNumber + 8),
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

				//konten format
				$letters = ['A', 'C'];
				foreach ($letters as $letter) {
					$event->sheet->styleCells(
						$letter.'7:'.$letter.($this->rowNumber + 2),
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
					'A7:G8',
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
					'F'.($this->rowNumber+7).':F'.($this->rowNumber+22),
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

	public function view(): View {
		$this->rowNumber = count($this->data['items']);
		return view('kepegawaian.laporan.qualification-report', $this->data);
	}
}
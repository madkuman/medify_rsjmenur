<?php
namespace App\Exports\Pasien;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Carbon\Carbon;
use Datetime;

class RekapTransaksiRJPembayaran implements FromView, WithEvents, WithColumnFormatting
{
	use Exportable;

	public function columnFormats(): array
	{
		return [
			'L' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
		];
	}


	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {
				$event->sheet->getColumnDimension('A')->setWidth(5);
				$event->sheet->getColumnDimension('B')->setWidth(22);
				$event->sheet->getColumnDimension('C')->setWidth(9);
				$event->sheet->getColumnDimension('D')->setWidth(11);
				$event->sheet->getColumnDimension('E')->setWidth(7);
				$event->sheet->getColumnDimension('F')->setWidth(7);
				$event->sheet->getColumnDimension('G')->setWidth(12);
				$event->sheet->getColumnDimension('H')->setWidth(12);
				$event->sheet->getColumnDimension('I')->setWidth(12);
				$event->sheet->getColumnDimension('J')->setWidth(22);
				$event->sheet->getColumnDimension('K')->setWidth(9);
				$event->sheet->getColumnDimension('L')->setWidth(14);


				$event->sheet->styleCells(
					'A1:O1',
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
					'A2:L2',
					[
						'alignment' => [
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'textRotation' => 0
						],
						'font' => [
							'size' => 11,
							'bold' => true,
						]
					]
				);

				$start_row = 4;
				foreach($this->data['perusahaan'] as $pt)
				{
					$start_pt_row = $start_row;
					$start_pt_row_table = $start_row+1;
					if(count($pt->transaksi_rj) > 0)
					{
						$event->sheet->styleCells(
							'A'.$start_pt_row_table.':L'.($start_pt_row_table + count($pt->transaksi_rj)),
							[
								'borders' => [
									'allBorders' => [
										'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
										'color' => ['argb' => '00000000'],
									],
								]
							]
						);

						$event->sheet->styleCells(
							'A'.$start_pt_row_table.':L'.$start_pt_row_table,
							[
								'font' => [
									'size' => 12,
									'bold' => true,
								],
								'alignment' => [
									'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
									'textRotation' => 0
								],
							]
						);

						$start_row = $start_pt_row_table + count($pt->transaksi_rj) + 2;
					}
				}

				$event->sheet->styleCells(
					'A'.$start_row.':C'.($start_row + count($this->data['perusahaan']) + 1),
					[
						'borders' => [
							'allBorders' => [
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
								'color' => ['argb' => '00000000'],
							],
						]
					]
				);

				$event->sheet->styleCells(
					'A'.$start_row.':C'.$start_row,
					[
						'font' => [
							'size' => 11,
							'bold' => true,
						],
						'alignment' => [
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'textRotation' => 0
						],
					]
				);

				$event->sheet->styleCells(
					'A'.($start_row + count($this->data['perusahaan']) + 1).':C'.($start_row + count($this->data['perusahaan']) + 1),
					[
						'font' => [
							'size' => 11,
							'bold' => true,
						],
						'alignment' => [
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'textRotation' => 0
						],
					]
				);



				$event->sheet->styleCells(
					'A'.$start_row.':A'.($start_row + count($this->data['perusahaan']) + 1),
					[
						'alignment' => [
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'textRotation' => 0
						],
					]
				);
				$event->sheet->styleCells(
					'C'.$start_row.':C'.($start_row + count($this->data['perusahaan']) + 1),
					[
						'alignment' => [
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'textRotation' => 0
						],
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
		$this->perusahaanCount = count($this->data['perusahaan']);
		return view ('pasien.laporan.rawatjalan-riwayat',$this->data);
	}
}

?>
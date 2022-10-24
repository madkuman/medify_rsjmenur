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

class IndeksPenyakit implements FromView, WithEvents
{
	use Exportable;


	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {
				$event->sheet->getColumnDimension('A')->setWidth(5);
				$event->sheet->getColumnDimension('B')->setWidth(7);
				$event->sheet->getColumnDimension('C')->setWidth(3);
				$event->sheet->getColumnDimension('D')->setWidth(3);
				$event->sheet->getColumnDimension('E')->setWidth(3);
				$event->sheet->getColumnDimension('F')->setWidth(3);
				$event->sheet->getColumnDimension('G')->setWidth(3);
				$event->sheet->getColumnDimension('H')->setWidth(3);
				$event->sheet->getColumnDimension('I')->setWidth(3);
				$event->sheet->getColumnDimension('J')->setWidth(3);
				$event->sheet->getColumnDimension('K')->setWidth(3);
				$event->sheet->getColumnDimension('L')->setWidth(3);
				$event->sheet->getColumnDimension('M')->setWidth(3);
				$event->sheet->getColumnDimension('N')->setWidth(3);
				$event->sheet->getColumnDimension('O')->setWidth(3);
				$event->sheet->getColumnDimension('P')->setWidth(3);
				$event->sheet->getColumnDimension('Q')->setWidth(7);
				$event->sheet->getColumnDimension('R')->setWidth(7);
				$event->sheet->getColumnDimension('S')->setWidth(7);
				$event->sheet->getColumnDimension('T')->setWidth(7);
				$event->sheet->getColumnDimension('U')->setWidth(5);
				$event->sheet->getColumnDimension('V')->setWidth(7);
				$event->sheet->getColumnDimension('W')->setWidth(7);
				$event->sheet->getColumnDimension('X')->setWidth(7);
				$event->sheet->getColumnDimension('Y')->setWidth(7);
				$event->sheet->getColumnDimension('Z')->setWidth(7);
				$event->sheet->getColumnDimension('AA')->setWidth(8);
				$event->sheet->getColumnDimension('AB')->setWidth(7);


				$event->sheet->styleCells(
					'A1:V1',
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
				foreach($this->data['diagnosis'] as $item)
				{
					$start_table_header = $start_row+2;
					$start_row_content = $start_row+5;
					if(count($item->kasus) > 0)
					{
						$event->sheet->styleCells(
							'A'.$start_table_header.':AB'.($start_row_content + count($item->kasus) - 1),
							[
								'borders' => [
									'allBorders' => [
										'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
										'color' => ['argb' => '00000000'],
									],
								],
								'font' => [
									'size' => 9,
								],
								'alignment' => [
									'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
									'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
									'textRotation' => 0,
									'wrapText' => TRUE,
								],
							]
						);

						$event->sheet->styleCells(
							'A'.$start_table_header.':AB'.($start_table_header + 2),
							[
								'font' => [
									'bold' => true,
								],
							]
						);

						$start_row = $start_row + count($item->kasus) + 6;
					}
				}

			},
		];
	}

	public function __construct($data){
		$this->data = $data;
	}

	public function view(): View
	{
		return view ('pasien.laporan.indeks-penyakit',$this->data);
	}
}

?>
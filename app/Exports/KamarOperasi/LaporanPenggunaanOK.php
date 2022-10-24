<?php
namespace App\Exports\KamarOperasi;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;
use Datetime;

class LaporanPenggunaanOK implements FromView, WithEvents
{
	use Exportable;


	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {
				$event->sheet->getColumnDimension('A')->setWidth(9);
				$event->sheet->getColumnDimension('B')->setWidth(9);
				$event->sheet->getColumnDimension('C')->setWidth(9);
				$event->sheet->getColumnDimension('D')->setWidth(9);
				$event->sheet->getColumnDimension('E')->setWidth(9);
				$event->sheet->getColumnDimension('F')->setWidth(9);
				$event->sheet->getColumnDimension('G')->setWidth(9);
				$event->sheet->getColumnDimension('H')->setWidth(9);
				$event->sheet->getColumnDimension('I')->setWidth(9);
				$event->sheet->getColumnDimension('J')->setWidth(9);
				$event->sheet->getColumnDimension('K')->setWidth(9);
				$event->sheet->getColumnDimension('L')->setWidth(9);
				$event->sheet->getColumnDimension('M')->setWidth(9);
				$event->sheet->getColumnDimension('N')->setWidth(9);
				$event->sheet->getColumnDimension('O')->setWidth(9);
				$event->sheet->getColumnDimension('P')->setWidth(9);
				$event->sheet->getColumnDimension('Q')->setWidth(9);
				$event->sheet->getColumnDimension('R')->setWidth(9);
				$event->sheet->getColumnDimension('S')->setWidth(9);


				$event->sheet->styleCells(
					'A1:S2',
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
					'A4:'.$this->last_column.$this->row_count,
					[
						'alignment' => [
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
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
							'size' => 10
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
		$this->row_count = (count($this->data['ruangan'])) + 3 + 3;
		$this->last_column = $this->getLastColumn($this->data['count_date'] + 1);

		return view('kamaroperasi.laporan.laporan-penggunaan-ruangan',$this->data);
	}

	private function getLastColumn($n)
	{
		for($r = ""; $n >= 0; $n = intval($n / 26) - 1)
			$r = chr($n%26 + 0x41) . $r;
		return $r;
	}
}

?>
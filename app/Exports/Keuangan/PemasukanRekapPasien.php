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

class PemasukanRekapPasien implements FromView, WithEvents, ShouldAutoSize
{
	use Exportable;

	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {


				for($i = 0; $i <= $this->columnNumber; $i++) 
				{
					$current_column = $this->getLastColumn($i);
					for($j=1;$j<=2;$j++)
					{
						$event->sheet->styleCells(
							$current_column.$j,
							[
								'alignment' => [
									'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
									'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
								],
								'borders' => [
									'top' => [
										'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
										'color' => ['argb' => '00000000'],
									],
									'bottom' => [
										'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
										'color' => ['argb' => '00000000'],
									],
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
									'size' => 12,
									'bold' => true,
								]
							]
						);
					}
					for($j=3;$j<=$this->rowNumber+2;$j++)
					{
						$event->sheet->styleCells(
							$current_column.$j,
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
						$current_column.($this->rowNumber+2),
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
					'F3:V'.($this->rowNumber+2),
					[
						'alignment' => [
							'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
						],
					]
				);

			},
		];
	}

	public function __construct($start_date,$end_date){
		$this->start_date = $start_date;
		$this->end_date = $end_date;
	}

	public function view(): View
	{
		$data = app('App\Http\Controllers\Keuangan\Laporan\RiwayatPemasukanController')->riwayatPemasukanPasien($this->start_date,$this->end_date);
		$this->rowNumber = count($data['pemasukan']);
		$this->columnNumber = count($data['kategori_2']) + 8;

		return view('keuangan.laporan.riwayatpemasukan.riwayat-pemasukan-pasien-print',$data);
	}
	private function getLastColumn($n)
	{
		for($r = ""; $n >= 0; $n = intval($n / 26) - 1)
			$r = chr($n%26 + 0x41) . $r;
		return $r;
	}
}
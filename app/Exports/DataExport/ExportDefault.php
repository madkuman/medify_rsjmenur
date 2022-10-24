<?php
namespace App\Exports\DataExport;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;
use Datetime;

class ExportDefault implements FromView, WithEvents
{
	use Exportable;


	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {
			},
		];
	}

	public function __construct($data){
		$this->data = $data;
	}

	public function view(): View
	{
		return view('admin.data-export.'.$this->data['blade'],$this->data);
	}
}

?>
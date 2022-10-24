<?php

namespace App\Exports\LabPA;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\LabPA\Transaction;
use App\Models\LabPA\TransactionDetail;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Datetime;

class InvoiceDiagnosis implements FromView, WithEvents, ShouldAutoSize
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                
                $event->sheet->styleCells(
                    'A2:K2',
                    [
                        'borders' => [
                            'left' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => '00000000'],
                            ],
                            'right' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => '00000000'],
                            ],
                            'top' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => '00000000'],
                            ],

                        ],
                        'font' => [
                            'size' => 12
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'B1',
                    [
                        'font' => [
                            'bold' => true,
                            'size' => 10
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'A3:K'.($this->rowNumber+2),
                    [
                        'font' => [
                            'size' => 10
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
                                'color' => ['argb' => '00000000'],
                            ],
                        ],
                    ]
                );

                $event->sheet->styleCells(
                    'I12',
                    [
                        'alignment' => [
                            'wrapText' => true
                        ]
                    ]
                );

            },
        ];
    }

    public function __construct($date){
		$month = explode("-", $date)[1];
		$year = explode("-", $date)[0];
		$formattedDate = Carbon::createFromDate($year, $month, 1);
        $this->formattedDate = $formattedDate;
        $this->requestedDate = $formattedDate->toDateString();
		$this->nextDate = $formattedDate->addMonth()->toDateString();
        $month = Datetime::createFromFormat('Y-m-d', $this->requestedDate);
        $this->month = $month->format('F');
    }

    public function view(): View
    {
        \Blade::setEchoFormat('nl2br(e(%s))');
        $data['month'] = $this->month;
        $requestDate = $this->requestedDate;
        $nextDate = $this->nextDate;
		$data['transaksi'] = TransactionDetail::whereHas('transaction', function($q) use($requestDate, $nextDate){
          $q->whereDate('result_created_at', '>=', $requestDate)->whereDate('result_created_at', '<=', $nextDate);  
        })->with(['transaction.pasien', 'transaction.pemeriksa'])->get();
        $this->rowNumber = count($data['transaksi']);
        return view('labpa.laporan.diagnosis', [
            'invoices' => $data
        ]);
    }
}

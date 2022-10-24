<?php

namespace App\Exports\Kepegawaian;

use App\Models\Kepegawaian\Pegawai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class PegawaiExport implements FromView
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function view(): View
    {
        return view('kepegawaian.pegawai.export-pegawai.index', [
            'pegawai' => $this->data
        ]);
    }
}

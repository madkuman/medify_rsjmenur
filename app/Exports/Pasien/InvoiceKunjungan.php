<?php

namespace App\Exports\Pasien;

use App\Models\UnitTindakan\UnitTindakan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\LabPA\Transaction;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Resep;
use App\Models\Kasus\Penunjang;
use App\Models\Kasus\Diagnosis;
use App\Models\Pasien\ListLaporan;
use App\Models\Kasus\PenunjangPermintaan;
use App\Models\Pasien\AlamatKecamatan;
use App\Models\Pasien\AlamatKota;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\AsalRujukan;
use App\Models\RawatJalan\PermintaanRujuk;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;

use App\Models\Hospital\TransaksiMasukDetail as TransaksiDetail;
use App\Models\Hospital\TransaksiMasuk as Transaksi;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Datetime;

class InvoiceKunjungan implements FromView, WithEvents, ShouldAutoSize
{
	use Exportable;
    protected $last_column = 0;
    protected $last_row = 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->styleCells(
                    'A4:'.$this->last_column.$this->last_row,
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ]
                    ]
                );

                $event->sheet->styleCells(
                    'A4:'.$this->last_column.$this->last_row,
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );

                

            }
        ];
    }

    public function __construct($data){
        $this->data = $data;
    }

    public function view(): View
    {
        $triwulan=$this->data['triwulan'];
        $tahun=$this->data['tahun'];
        $tipe=$this->data['tipe'];
        $divisi=$this->data['divisi'];
        $nama_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        if ($triwulan==1) {
            $bulan = [1,2,3];
            $triwulan_romawi = 'I';
        }
        elseif ($triwulan==2) {
            $bulan = [4,5,6];
            $triwulan_romawi = 'II';
        }
        elseif ($triwulan==3) {
            $bulan = [7,8,9];
            $triwulan_romawi = 'III';
        }
        elseif ($triwulan==4) {
            $bulan = [10,11,12];
            $triwulan_romawi = 'IV';
        }

        foreach ($bulan as $b) {
            $monthName[] = $nama_bulan[$b-1];
        }

        if ($divisi == 'rawatjalan') {
            $poli = Poliklinik::whereDoesntHave('unit_tindakan',function ($query) {
                $query->from(config('app.db_name').'_unit_tindakan.unit_tindakan');
            })->get();
            if($tipe == 'kunjungan') {
                $laporan = app('App\Http\Controllers\Pasien\Laporan\ReadController')->laporan_kunjungan($triwulan,$tahun);
                $data['title'] =  'KUNJUNGAN';
            }
            elseif($tipe == 'pengunjung') 
            {
                $laporan = app('App\Http\Controllers\Pasien\Laporan\PengunjungRJTriwulan')->get($triwulan,$tahun);
                $data['title'] =  'PENGUNJUNG';
            }
            $data['division'] = 'POLIKLINIK';
        } elseif ($divisi == 'unittindakan'){
            $poli = UnitTindakan::all();
            foreach ($poli as $item)
            {
                $item->name = $item->nama;
            }

            if($tipe == 'kunjungan') {
                $laporan = app('App\Http\Controllers\Pasien\Laporan\PengunjungKunjunganUnitTindakanTriwulan')->laporan_kunjungan($triwulan,$tahun);
                $data['title'] =  'KUNJUNGAN';
            }
            $data['division'] = 'UNIT TINDAKAN';
        }
        else {
            $poli = app('App\Http\Controllers\IGD\Ruangan\ReadController')->allRuanganPrint();
            if($tipe == 'kunjungan') {
                $laporan = app('App\Http\Controllers\Pasien\Laporan\PengunjungKunjunganIGDTriwulan')->getKunjungan($triwulan,$tahun);
                $data['title'] =  'KUNJUNGAN';
            }
            elseif($tipe == 'pengunjung') 
            {
                $laporan = app('App\Http\Controllers\Pasien\Laporan\PengunjungKunjunganIGDTriwulan')->getPengunjung($triwulan,$tahun);
                $data['title'] =  'PENGUNJUNG';
            }
            $data['division'] = 'IGD';
        }

        $data['triwulan'] =  $triwulan_romawi;
        $data['tahun'] =  $tahun;
        $data['poli'] =  $poli;
        $data['perusahaan_tipe'] = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getAllTipe();
        $data['perusahaan'] = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getAllPerusahaan();
        $data['laporan'] =  $laporan;
        $data['bulan'] =  $monthName;
        $data['jumlahKolom'] = (count($data['perusahaan'])*2)+5;
        

        $last_column = $data['jumlahKolom'];
        $this->last_column = 'C';
        for($i=0;$i<$last_column;$i++)
        {
            $this->last_column++;
        }
        $count_poli = count($data['laporan']);
        $this->last_row = 3+$count_poli*4+3+$count_poli-1;
        return view('pasien.laporan.kunjungan',$data);
    }
}

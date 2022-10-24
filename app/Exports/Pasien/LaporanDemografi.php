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

class LaporanDemografi implements FromView, WithEvents
{
	use Exportable;


	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {
				$event->sheet->getColumnDimension('A')->setWidth(8);
				$event->sheet->getColumnDimension('B')->setWidth(25);
				$event->sheet->getColumnDimension('C')->setWidth(25);
				$event->sheet->getColumnDimension('D')->setWidth(25);
				$event->sheet->getColumnDimension('E')->setWidth(10);

				$event->sheet->styleCells(
					'A1:N1',
					[
						'alignment' => [
							'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
							'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
							'wrapText' => true
						],
                        'font' => [
                            'bold' => true
                        ]
					]
				);
                $event->sheet->styleCells(
                    'A2:N4',
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText' => true
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'A5:N6',
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText' => true
                        ],
                        'font' => [
                            'bold' => true
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'A7:A'.($this->row_number),
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'wrapText' => true
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'B7:D'.($this->row_number),
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'wrapText' => true
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'E7:N'.($this->row_number),
                    [
                        'alignment' => [
                            'vertical'     => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                            'wrapText' => true
                        ],
                    ]
                );
			},
		];
	}

	public function __construct($data){
		$row=0;
        foreach ($data['data'] as $p=> $provinsi){
            $data_provinsi=0;
            $jumlah_kecamatan_provinsi=0;
            foreach ($provinsi->kota as $k=> $kota){
                $data_kota=0;
                $jumlah_kecamatan_kabupaten=0;
                foreach ($kota->kecamatan as $ke => $kecamatan){
                    $data_kecamatan=0;
                    $umur_0_14_l=0;
                    $umur_0_14_p=0;
                    $umur_15_24_l=0;
                    $umur_15_24_p=0;
                    $umur_25_44_l=0;
                    $umur_25_44_p=0;
                    $umur_45_64_l=0;
                    $umur_45_64_p=0;
                    $umur_65_l=0;
                    $umur_65_p=0;
                    $kasus_ids_used = [];

                    if(!empty($kecamatan->pasien)){
                        foreach ($kecamatan->pasien as $pas => $pasien){
                            if(!empty($pasien->kasus)){
                                foreach ($pasien->kasus as $kasus){
                                    if(in_array($kasus->id, $kasus_ids_used)) continue;
                                    if(isset($kasus->TransaksiIGD) && !empty($kasus->TransaksiIGD)){
                                        foreach ($kasus->TransaksiIGD as $transaksi_igd){
                                            $kasus_ids_used[] = $kasus->id;
                                            if($transaksi_igd->usia_masuk > 0 && $transaksi_igd->usia_masuk < (15*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_0_14_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_0_14_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }elseif ($transaksi_igd->usia_masuk > (15*365) && $transaksi_igd->usia_masuk < (25*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_15_24_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_15_24_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }elseif ($transaksi_igd->usia_masuk > (25*365) && $transaksi_igd->usia_masuk < (45*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_25_44_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_25_44_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }elseif ($transaksi_igd->usia_masuk > (45*365) && $transaksi_igd->usia_masuk < (65*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_45_64_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_45_64_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }elseif ($transaksi_igd->usia_masuk > (65*365) && $transaksi_igd->usia_masuk < (1000*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_65_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_65_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }
                                        }
                                    }
                                    if(in_array($kasus->id, $kasus_ids_used)) continue;
                                    if(isset($kasus->TransaksiRawatJalan) && !empty($kasus->TransaksiRawatJalan)){
                                        foreach ($kasus->TransaksiRawatJalan as $transaksi_rawat_jalan){
                                            $kasus_ids_used[] = $kasus->id;
                                            if($transaksi_rawat_jalan->usia_masuk > 0 && $transaksi_rawat_jalan->usia_masuk < (15*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_0_14_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_0_14_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }elseif ($transaksi_rawat_jalan->usia_masuk > (15*365) && $transaksi_rawat_jalan->usia_masuk < (25*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_15_24_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_15_24_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }elseif ($transaksi_rawat_jalan->usia_masuk > (25*365) && $transaksi_rawat_jalan->usia_masuk < (45*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_25_44_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_25_44_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }elseif ($transaksi_rawat_jalan->usia_masuk > (45*365) && $transaksi_rawat_jalan->usia_masuk < (65*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_45_64_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_45_64_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }elseif ($transaksi_rawat_jalan->usia_masuk > (65*365) && $transaksi_rawat_jalan->usia_masuk < (1000*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_65_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_65_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }
                                        }
                                    }
                                    if(in_array($kasus->id, $kasus_ids_used)) continue;
                                    if(isset($kasus->TransaksiRawatInap) && !empty($kasus->TransaksiRawatInap)){
                                        foreach ($kasus->TransaksiRawatInap as $transaksi_rawat_inap){
                                            $kasus_ids_used[] = $kasus->id;
                                            if($transaksi_rawat_inap->usia_masuk > 0 && $transaksi_rawat_inap->usia_masuk < (15*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_0_14_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_0_14_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }elseif ($transaksi_rawat_inap->usia_masuk > (15*365) && $transaksi_rawat_inap->usia_masuk < (25*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_15_24_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_15_24_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }elseif ($transaksi_rawat_inap->usia_masuk > (25*365) && $transaksi_rawat_inap->usia_masuk < (45*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_25_44_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_25_44_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }elseif ($transaksi_rawat_inap->usia_masuk > (45*365) && $transaksi_rawat_inap->usia_masuk < (65*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_45_64_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_45_64_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }elseif ($transaksi_rawat_inap->usia_masuk > (65*365) && $transaksi_rawat_inap->usia_masuk < (1000*365-1)){
                                                if($data['data'][$p]->kota[$k]->kecamatan[$ke]->pasien[$pas]->gender == 1){
                                                    $umur_65_l+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }else{
                                                    $umur_65_p+=1;
                                                    $data_kecamatan+=1;
                                                    $data_kota+=1;
                                                    $data_provinsi+=1;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if($data_kecamatan==0){
                            unset($data['data'][$p]->kota[$k]->kecamatan[$ke]);
                        }else{
                            $data['data'][$p]->kota[$k]->kecamatan[$ke]['0-14'.'L']=$umur_0_14_l;
                            $data['data'][$p]->kota[$k]->kecamatan[$ke]['0-14'.'P']=$umur_0_14_p;
                            $data['data'][$p]->kota[$k]->kecamatan[$ke]['15-24'.'L']=$umur_15_24_l;
                            $data['data'][$p]->kota[$k]->kecamatan[$ke]['15-24'.'P']=$umur_15_24_p;
                            $data['data'][$p]->kota[$k]->kecamatan[$ke]['25-44'.'L']=$umur_25_44_l;
                            $data['data'][$p]->kota[$k]->kecamatan[$ke]['25-44'.'P']=$umur_25_44_p;
                            $data['data'][$p]->kota[$k]->kecamatan[$ke]['45-64'.'L']=$umur_45_64_l;
                            $data['data'][$p]->kota[$k]->kecamatan[$ke]['45-64'.'P']=$umur_45_64_p;
                            $data['data'][$p]->kota[$k]->kecamatan[$ke]['>65'.'L']=$umur_65_l;
                            $data['data'][$p]->kota[$k]->kecamatan[$ke]['>65'.'P']=$umur_65_p;
                            $jumlah_kecamatan_kabupaten+=1;
                            $jumlah_kecamatan_provinsi+=1;
                            $row+=1;
                        }
                    }
                    else{
                        unset($data['data'][$p]->kota[$k]->kecamatan[$ke]);
                    }
                }
                if($data_kota==0){
                    unset($data['data'][$p]->kota[$k]);
                }else{
                    $data['data'][$p]->kota[$k]->jumlah_kecamatan_kabupaten=$jumlah_kecamatan_kabupaten;
                }
            }
            if($data_provinsi==0){
                unset($data['data'][$p]);
            }else{
                $data['data'][$p]->jumlah_kecamatan_provinsi=$jumlah_kecamatan_provinsi;
            }
        }
        $this->row_number = $row+10;
        $this->data = $data;
	}

	public function view(): View
	{
		return view ('pasien.laporan.laporan-demografi', $this->data);
	}
}

?>
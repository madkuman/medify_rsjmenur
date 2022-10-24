<?php

namespace App\Http\Controllers\Remunerasi\Pajak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\{Pegawai, MasterJenisPegawai, MasterPangkat, MasterKategoriPegawai, MasterJabatan , MasterGolongan, MasterMasaKerja};
use App\Models\Remunerasi\{Pajak, ResikoKerja, BebanKerja};
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Auth;


class CreateController extends Controller
{
    public function create($request){
        $countExecuteData = 0;
        $bulan = substr($request->bulan_tahun,3);
        $data = Pegawai::where('status_pegawai_id',1)->with(['MasterJabatan','masterPangkat','masterJenisPegawai','masterKategoriPegawai','masterGolonganPegawai'])->get(); // init data pegawai then insert to pajak
        $data_masa_kerja = MasterMasaKerja::all();
        $pajak = [];
        foreach($data as $pegawai){
            
                //check duplicate data pegawai & bulan ;
                $check = Pajak::where('pegawai_id',$pegawai->id)->where('bulan',$bulan)->first();
                if(empty($check)){
                     // define jumlah index 'MasterJabatan','masterPangkat','masterJenisPegawai','masterKategoriPegawai','masterGolonganPegawai','masterMasaKerja','resikoKerja','bebanKerja';
                    $resiko_kerja = ResikoKerja::where('pegawai_id',$pegawai->id)->where('bulan',$bulan)->first();
                    $beban_kerja  = BebanKerja::where('pegawai_id',$pegawai->id)->where('bulan',$bulan)->first();
                    
                    $masa_kerja = Carbon::parse($pegawai->tmt)->age;
                            foreach ($data_masa_kerja as $row){
                                $awal = $row->awal;
                                $akhir = $row->akhir;
                                //--- check and get index masa kerja
                                $check = ($awal <= $masa_kerja) && ($masa_kerja <= $akhir);
                            }
                            if($check == true){
                                $index_masa_kerja = $row->indek;
                            }else{
                                $index_masa_kerja = 0;
                            }
                            $golongan=!empty($pegawai->masterGolonganPegawai->indek) ? $pegawai->masterGolonganPegawai->indek : 0;

                        $index_jabatan = !empty($pegawai->MasterJabatan->index) ? $pegawai->MasterJabatan->index : 0;
                        $index_jenis = !empty($pegawai->masterJenisPegawai->index) ? $pegawai->masterJenisPegawai->index : 0;
                        $index_pendidikan = !empty($pegawai->masterGelar->index) ? $pegawai->masterGelar->index : 0;
                        $index_golongan = isset($pegawai->masterJenisPegawai->nama) && $pegawai->masterJenisPegawai->nama == 'PNS' ? $golongan : $index_masa_kerja;
                        $index_tim_pembagi_jasa = !empty($pegawai->masterTimPembagiJasa->indek) ? $pegawai->masterTimPembagiJasa->indek : 0;
                        $index_resiko = $resiko_kerja->index;
                        $index_beban  = $beban_kerja->index;
                        if(!empty($pegawai->masterGolonganPegawai->pajak)){
                            $golongan_pajak = (100 - $pegawai->masterGolonganPegawai->pajak);
                             // calculate jumlah pajak
                            $jumlah = round(($index_jabatan  + $index_jenis + $index_tim_pembagi_jasa + $index_golongan + $index_resiko + $index_beban + $index_pendidikan) / $golongan_pajak *100,2);
                        }else{
                            $jumlah = 0;
                        }

                    // then insert to Pajak;
                    $new_pajak = array(
                        'pegawai_id' => $pegawai->id,
                        'jumlah' => $jumlah,
                        'bulan' => $bulan,
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    );
                    $pajak [] = $new_pajak;
                    $countExecuteData++;
                }
            }

        if(!empty($pajak)){
            Pajak::insert($pajak);
        }
        return $countExecuteData;   
    }
}
<?php

namespace App\Console\Commands\DataImport;

use Illuminate\Console\Command;
use App\Imports\DefaultImporter;
use App\Models\LabPK\Form;
use App\Models\LabPK\FormDetail;
use App\Models\LabPK\FormTarif;
use App\Models\Hospital\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Auth;

class LabPKFormImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-import:labpk-form {id=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $arguments = $this->arguments();
        $id = $arguments['id'];
        $data_import = [];

        
        if(!empty($id)){
            $data_import = DataImport::find($id);
            $data_import->status = null;
            $data_import->keterangan = null;
            $data_import->current_row = 0;
        }

        if(empty($data_import) || $data_import->jenis != 'labpk-form')
        {
            $data_import = DataImport::whereNull('status')->where('jenis','labpk-form')->first();
        }

        $path = 'public/'.$data_import->file_path;

        echo "Reading File : ".$path."\n";

        $data = Excel::toArray(new DefaultImporter, $path)[0];
        $max_column = count($data[0])-1;

        $data_import->status = 'progress';
        $data_import->total_row = count($data)-1;
        $data_import->save();

        $this->current_data_import_id = $data_import->id;

        Auth::loginUsingId($data_import->created_by);

        foreach($data as $index => $item)
        {
            if($index == 0) continue;
            try {

                echo $index;

                if(empty($item[0])){
                    echo " -- Empty Tarif";
                    $keterangan = 'INDEX : '.$index.' Empty Tarif '. $item[1];
                    $this->dataImportUpdateKeterangan($keterangan,$data_import->id);
                    echo "\n";
                    continue;
                }
                DB::connection('lab_pk')->beginTransaction();

                if(empty($item[4])) $type = 'parameter-text';
                else $type = 'parameter-number';

                $form = Form::where('parameter',$item[1])->where('type',$type)->first();
                if(empty($form->id))
                {
                    echo " -- Creating Form";


                    $data = [
                        'type' => $type,
                        'parameter' => $item[1],
                        'slug' => slug($item[1]),
                        'satuan' => $item[2],
                        'metode' => $item[3],
                    ];


                    $form = app('App\Http\Controllers\LabPK\Form\CreateController')->create($data);
                }

                $jk_pria = $item[9];
                $jk_wanita = $item[10];
                $usia_min = $item[11];
                $usia_max = $item[12];

                $form_detail = FormDetail::where('form_id',$form->id)->where('jk_pria',$jk_pria)->where('jk_wanita',$jk_wanita)->where('usia_min',$usia_min)->where('usia_max',$usia_max)->first();
                
                if(empty($form_detail->id))
                {
                    echo " -- Creating Form Detail";
                    $form_detail = new FormDetail;
                    $form_detail->form_id = $form->id;
                    $form_detail->referensi_lainnya = $item['6'];
                    $form_detail->referensi_min = $item['4'];
                    $form_detail->referensi_max = $item['5'];
                    $form_detail->kritis_min = $item['7'];
                    $form_detail->kritis_max = $item['8'];
                    $form_detail->jk_pria = $jk_pria;
                    $form_detail->jk_wanita = $jk_wanita;
                    $form_detail->usia_min = $usia_min;
                    $form_detail->usia_max = $usia_max;
                    $form_detail->created_by = Auth::user()->id;
                    $form_detail->save();
                }
                else
                {
                    echo " -- Duplicated Form Detail";
                    $keterangan = 'INDEX : '.$index.' Duplicated Form Detail '. $item[1];
                    $this->dataImportUpdateKeterangan($keterangan,$data_import->id);
                }

                $form_detail = FormTarif::where('form_id',$form->id)->where('tarif_master_id',$item[0])->first();

                if(empty($form_detail->id))
                {
                    echo " -- Creating Form Tarif";
                    $form_detail = new FormTarif;
                    $form_detail->form_id = $form->id;
                    $form_detail->tarif_master_id = $item[0];
                    $form_detail->created_by = Auth::user()->id;
                    $form_detail->save();
                }
                else
                {
                    echo " -- Duplicated Form Tarif";
                    $keterangan = 'INDEX : '.$index.' Duplicated Form Tarif '. $item[1];
                    $this->dataImportUpdateKeterangan($keterangan,$data_import->id);
                }


                $data_import->current_row = $index+1;
                $data_import->save();
                echo " -- Success";
                DB::connection('lab_pk')->commit();
            }
            catch (\Exception $e) {
                echo " -- Error";
                $keterangan = 'INDEX : '.$index.' Error '.$e->getMessage();
                $this->dataImportUpdateKeterangan($keterangan,$data_import->id);

                DB::connection('lab_pk')->rollBack();
            }
            echo "\n";
        }

        $data_import->status = 'done';
        $data_import->save();
    }

    private function dataImportUpdateKeterangan($keterangan,$data_import_id)
    {
        $data_import = DataImport::find($data_import_id);
        $data_import->keterangan = $data_import->keterangan.$keterangan."\n";
        $data_import->save();
        return 1;
    }
}

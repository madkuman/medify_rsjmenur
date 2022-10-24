<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-evaluasi"><i class="fa fa-pencil"></i> Buat Evaluasi Klinis</button>
        </div>
    </div>
    <div class="row">
        @if(count($evaluasi)==0)
        <div class="col-12 text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada Evaluasi Klinis</h4><br>
            <p>Klik tombol <b>Buat Evaluasi Klinis</b> untuk menambahkan Evaluasi Klinis baru</p>
        </div>

        @endif
        @php $i = count($evaluasi); @endphp
        @foreach ($evaluasi as $key => $eval)
        <div class="col-md-8">
            <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-delete-eval{{$key}}">
                <i class="fa fa-trash"></i>
            </button>
            <button type="button" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-edit-eval{{$key}}">
                <i class="fa fa-pencil"></i>
            </button>

            <h5 class="font-w600 mb-5">EVALUASI {{$i}}</h5>

            <!-- INFO UMUM -->
            INFO UMUM
            <div class="block-content">
                <!-- <h5 class="font-w400 mb-0"><small>Anamnesa</small></h5>
                <h5 class="mb-15 font-w400" style="white-space: pre">@if(!empty($eval->anamnesa)){{$eval->anamnesa}} @else - @endif</h5> -->

                <h5 class="font-w400 mb-0"><small>Tujuan Pemeriksaan</small></h5>
                <h5 class="mb-15 font-w400" style="white-space: pre">@if(!empty($eval->tujuan_pemeriksaan)){{$eval->tujuan_pemeriksaan}} @else - @endif</h5>
                <h5 class="font-w400 mb-0"><small>Riwayat Sakit</small></h5>
                <h5 class="mb-15 font-w400" style="white-space: pre">@if(!empty($eval->riwayat_sakit)){{$eval->riwayat_sakit}} @else - @endif</h5>

                <h5 class="font-w400 mb-0"><small>Bentuk Badan</small></h5>
                <h5 class="mb-15 font-w400">{{$identitas->bentuk_badan}}</h5>

                <div class="row">
                    <h5 class="font-w400 col-12"><small>Tinggi Badan</small><br>
                        @if(!empty($eval->tinggi_badan))
                        {{ $eval->tinggi_badan}} 
                        @else
                        {{ $identitas->tinggi_badan}} 
                        @endif cm
                    </h5>
                    <h5 class="font-w400 col-12"><small>Berat Badan</small><br>
                        @if(!empty($eval->berat_badan))
                        {{ $eval->berat_badan}} 
                        @else
                        {{ $identitas->berat_badan}} 
                        @endif kg
                    </h5>
                    <h5 class="font-w400 col-12"><small>Lingkar Perut</small><br>
                        @if(!empty($eval->lingkar_perut))
                        {{ $eval->lingkar_perut}} 
                        @else
                        {{ $identitas->lingkar_perut}} 
                        @endif cm
                    </h5>
                    <h5 class="font-w400 col-12"><small>Tekanan Darah / Tensi</small><br>
                        @if(!empty($eval->tekanan_darah))
                        {{ $eval->tekanan_darah}} 
                        @else
                        {{ $identitas->tekanan_darah_tensi}}
                        @endif 
                    </h5>
                    <h5 class="font-w400 col-12"><small>Nadi</small><br>
                        @if(!empty($eval->nadi))
                        {{ $eval->nadi}} 
                        @else
                        {{ $identitas->nadi}}
                        @endif per menit
                    </h5>
                </div>

                <h5 class="font-w400 mb-0"><small>Golongan Darah</small></h5>
                <h5 class="mb-15 font-w400">{{$eval->gol_darah}}</h5>
            </div>
            <br>

            <!-- EVALUASI KLINIS -->
            EVALUASI KLINIS
            <div class="block-content">
                <h5 class="font-w400 mb-0"><small>Kepala</small></h5>
                @if ($eval->kepala == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_kepala}}</h5>
                @elseif($eval->kepala == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif

                <h5 class="font-w400 mb-0"><small>Leher</small></h5>
                @if ($eval->leher == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_leher}}</h5>
                @elseif($eval->leher == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Kelenjar Gondok</small></h5>
                @if ($eval->gondok == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_gondok}}</h5>
                @elseif($eval->gondok == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Hidung</small></h5>
                @if ($eval->hidung == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_hidung}}</h5>
                @elseif($eval->hidung == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Sinus / Foto Water</small></h5>
                @if ($eval->sinus == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_sinus}}</h5>
                @elseif($eval->sinus == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Mulut</small></h5>
                @if ($eval->mulut == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_mulut}}</h5>
                @elseif($eval->mulut == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Lidah</small></h5>
                @if ($eval->lidah == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_lidah}}</h5>
                @elseif($eval->lidah == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Tenggorokan</small></h5>
                @if ($eval->tenggorokan == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_tenggorokan}}</h5>
                @elseif($eval->tenggorokan == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Tonsil</small></h5>
                @if ($eval->tonsil == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_tonsil}}</h5>
                @elseif($eval->tonsil == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Telinga</small></h5>
                @if ($eval->telinga == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_telinga}}</h5>
                @elseif($eval->telinga == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Audiometri (AD)</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->telinga_cek)){{$eval->telinga_cek->audio_ad}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Audiometri (AS)</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->telinga_cek)){{$eval->telinga_cek->audio_as}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Suara Bisikan (AD)</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->telinga_cek)){{$eval->telinga_cek->suara_ad}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Suara Bisikan (AS)</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->telinga_cek)){{$eval->telinga_cek->suara_as}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Liang</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->telinga_cek)){{$eval->telinga_cek->liang}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Tajam Pendengaran</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->telinga_cek)){{$eval->telinga_cek->tajam_pendengaran}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Gendang Kanan</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->telinga_cek)){{$eval->telinga_cek->gendang_kanan}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Gendang Kiri</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->telinga_cek)){{$eval->telinga_cek->gendang_kiri}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Membran Tympani</small></h5>
                @if ($eval->membran_tympani == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_membran_tympani}}</h5>
                @elseif($eval->membran_tympani == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Mata</small></h5>
                @if ($eval->mata == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_mata}}</h5>
                @elseif($eval->mata == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Ophtalmoscopy</small></h5>
                @if ($eval->ophtalmoscopy == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_ophtalmoscopy}}</h5>
                @elseif($eval->ophtalmoscopy == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Pupil</small></h5>
                @if ($eval->pupil == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_pupil}}</h5>
                @elseif($eval->pupil == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Gerakan Mata</small></h5>
                @if ($eval->gerakan_mata == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_ger_mat}}</h5>
                @elseif($eval->gerakan_mata == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Dada dan Paru Paru</small></h5>
                @if ($eval->dada_paru == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_dada_paru}}</h5>
                @elseif($eval->dada_paru == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Jantung</small></h5>
                @if ($eval->jantung == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_jantung}}</h5>
                @elseif($eval->jantung == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Abdomen & Viscera</small></h5>
                @if ($eval->abdomen_viscera == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_abdomen_viscera}}</h5>
                @elseif($eval->abdomen_viscera == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Anus dan Rectum dan Fistula</small></h5>
                @if ($eval->arf == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_arf}}</h5>
                @elseif($eval->arf == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Sistem Endokrin</small></h5>
                @if ($eval->endokrin == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_endokrin}}</h5>
                @elseif($eval->endokrin == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Sistem Genito Urinaria</small></h5>
                @if ($eval->genito_urin == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_genito_urinaria}}</h5>
                @elseif($eval->genito_urin == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Extrimitas Bawah</small></h5>
                @if ($eval->extrimitas_bwh == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_extrim_bwh}}</h5>
                @elseif($eval->extrimitas_bwh == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Extrimitas Atas</small></h5>
                @if ($eval->extrimitas_atas == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_extrim_atas}}</h5>
                @elseif($eval->extrimitas_atas == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Kaki</small></h5>
                @if ($eval->kaki == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_kaki}}</h5>
                @elseif($eval->kaki == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                
                <h5 class="font-w400 mb-0"><small>Telapak Kaki</small></h5>
                @if ($eval->telapak_kaki == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_telapak_kaki}}</h5>
                @elseif($eval->telapak_kaki == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif

                <h5 class="font-w400 mb-0"><small>Kulit</small></h5>
                @if ($eval->kulit == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_kulit}}</h5>
                @elseif($eval->kulit == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif
                <h5 class="font-w400 mb-0"><small>Col Vertebralis dan Pelvis</small></h5>
                @if ($eval->col_vp == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_col_vp}}</h5>
                @elseif($eval->col_vp == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif

                <h5 class="font-w400 mb-0"><small>Thorax</small></h5>
                @if ($eval->thorax == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_thorax}}</h5>
                @elseif($eval->thorax == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif

                <h5 class="font-w400 mb-0"><small>Perut</small></h5>
                @if ($eval->perut == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_perut}}</h5>
                @elseif($eval->perut == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif

                <h5 class="font-w400 mb-0"><small>Hati</small></h5>
                @if ($eval->hati == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_hati}}</h5>
                @elseif($eval->hati == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif

                <h5 class="font-w400 mb-0"><small>Limpa</small></h5>
                @if ($eval->limpa == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_limpa}}</h5>
                @elseif($eval->limpa == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif

                <h5 class="font-w400 mb-0"><small>Hernia</small></h5>
                @if ($eval->hernia == '0')
                <h5 class="mb-15 font-w400" style="white-space: pre;">Tidak Normal, {{$eval->ket_hernia}}</h5>
                @elseif($eval->hernia == '1')
                <h5 class="mb-15 font-w400">Normal</h5>
                @endif

                <h5 class="font-w400 mb-0"><small>Neurologi</small></h5>
                <h5 class="mb-15 font-w400">{{$eval->neurologi or "-"}}</h5>

                <h5 class="font-w400 mb-0"><small>Spirometry</small></h5>
                <h5 class="mb-15 font-w400">{{$eval->spirometry or "-"}}</h5>
            </div>
            <br>
            <!-- PENUNJANG -->

            PENUNJANG
            <div class="block-content">
                <h5 class="font-w400 mb-0"><small>ECG</small></h5>
                <h5 class="mb-15 font-w400" style="white-space: pre">@if(!empty($eval->ecg)){{$eval->ecg}} @else - @endif</h5>

              
                <h5 class="font-w400 mb-0"><small>Mammae</small></h5>
                <h5 class="mb-15 font-w400" style="white-space: pre">@if(!empty($eval->mamae)){{$eval->mamae}} @else - @endif</h5>

                <h5 class="font-w400 mb-0"><small>Abdomen</small></h5>
                <h5 class="mb-15 font-w400" style="white-space: pre">@if(!empty($eval->abdomen)){{$eval->abdomen}} @else - @endif</h5>

                <h5 class="font-w400 mb-0"><small>Treadmill</small></h5>
                <h5 class="mb-15 font-w400" style="white-space: pre">@if(!empty($eval->treadmill)){{$eval->treadmill}} @else - @endif</h5>

                <h5 class="font-w400 mb-0"><small>X-Ray Foto</small></h5>
                <h5 class="mb-15 font-w400" style="white-space: pre">@if(!empty($eval->x_ray)){{$eval->x_ray}} @else - @endif</h5>
            </div>

            PAP SMEAR
            <div class="block-content">
                <h5 class="font-w400 mb-0"><small>PAP SMEAR</small></h5>
                <h5 class="mb-15 font-w400" style="white-space: pre">@if(!empty($eval->pap_smear)){{$eval->pap_smear}} @else - @endif</h5>
            </div>

            MATA
            <div class="block-content">
                <h5 class="font-w400 mb-0"><small>OD</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->mata_cek)) @if($eval->mata_cek->od == 1) Normal @else Tidak Normal, {{$eval->mata_cek->ket_od}} @endif @else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>OS</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->mata_cek)) @if($eval->mata_cek->os == 1) Normal @else Tidak Normal, {{$eval->mata_cek->ket_os}} @endif @else'-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Visus OD</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->mata_cek)){{$eval->mata_cek->visus_od}} @else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Visus OS</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->mata_cek)){{$eval->mata_cek->visus_os}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Visus ODS</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->mata_cek)){{$eval->mata_cek->visus_ods}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Bentuk Pupil</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->mata_cek)){{$eval->mata_cek->bentuk_pupil}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Membedakan Warna</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->mata_cek)){{$eval->mata_cek->membedakan_warna}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Koreksi Sampai OD</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->mata_cek)){{$eval->mata_cek->koreksi_od}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Koreksi Sampai OS</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->mata_cek)){{$eval->mata_cek->koreksi_os}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Add</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->mata_cek)){{$eval->mata_cek->add}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Pemeriksaan Perimetris</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->mata_cek)){{$eval->mata_cek->pemeriksaan_perimetris}}@else '-' @endif</h5>
                <h5 class="font-w400 mb-0"><small>Tekanan Intraokulair</small></h5>
                <h5 class="mb-15 font-w400">@if(!is_null($eval->mata_cek)){{$eval->mata_cek->tekanan_intraokulair}}@else '-' @endif</h5>
                <h6>
                    <small class="text-muted">Dibuat Oleh</small><br>
                    {{$eval->user->name}}
                    <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{date('l, j F Y H:i',strtotime($eval->updated_at))}}</span>
                </h6>
            </div>
        </div>
        @if ($key != count($evaluasi)-1)
        <div class="col-lg-12 mb-15"><hr></div>
        @endif
        @php $i--; @endphp
        @endforeach
    </div>
</div>
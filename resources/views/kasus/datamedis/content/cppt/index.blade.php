
<div class="content pt-0">
    @if(!empty($last_asesmen_awal))
        @if($last_asesmen_awal['wajib_isi'] == 1) 
            @include('kasus.datamedis.content.asesmenawal.warning-asesmen-awal')
        @endif
    @endif

        @php
            $status_covid = $kasus->covid_status->status ?? 'none';
            $covid_banner['text_color'] = 'text-white';
            $covid_banner['button_text'] = 'Lihat Hasil Asesmen';
            $covid_banner['button_url'] = url("kasus/".$kasus->nomor_kasus."/asesmen/pasien-covid");

            if (in_array($status_covid, ['suspek'])) {
                $covid_banner['tipe_bg'] = 'orange';
                $covid_banner['title'] = 'Pasien Suspek Covid-19';
                $covid_banner['subtitle'] = 'Berhati hati saat merawat pasien';
            } else if (in_array($status_covid, ['kontak erat'])) {
                $covid_banner['tipe_bg'] = 'info';
                $covid_banner['title'] = 'Pasien Kontak Erat Covid-19';
                $covid_banner['subtitle'] = 'Berhati hati saat merawat pasien';
            } else if (in_array($status_covid, ['meninggal', 'kematian'])) {
                $covid_banner['tipe_bg'] = 'warning';
                $covid_banner['title'] = 'Pasien Meninggal Dengan Status Konfirmasi/Probable Covid-19';
                $covid_banner['subtitle'] = 'Berhati hati saat berinteraksi dengan jenazah pasien';
            } else if (in_array($status_covid, ['pelaku perjalanan'])) {
                $covid_banner['tipe_bg'] = 'elegance-light';
                $covid_banner['title'] = 'Pasien Memiliki Riwayat Perjalanan Covid-19';
                $covid_banner['subtitle'] = 'Berhati hati saat merawat pasien';
            } else if (in_array($status_covid, ['discarded', 'negatif'])) {
                $covid_banner['tipe_bg'] = 'success';
                $covid_banner['title'] = 'Negatif Covid-19';
                $covid_banner['subtitle'] = 'Pasien telah didiagnosa negatif. Namun tetap berhati hati saat merawat pasien.';
            } else if (in_array($status_covid, ['konfirmasi', 'positif'])) {
                $covid_banner['tipe_bg'] = 'danger';
                $covid_banner['title'] = 'AWAS! Pasien Konfirmasi Positif Covid-19';
                $covid_banner['subtitle'] = 'Gunakan APD, dan berhati hati saat melakukan pemeriksaan pasien!';
            } else if (in_array($status_covid, ['probable', 'odp', 'pdp', 'otg'])) {
                $covid_banner['tipe_bg'] = 'warning';
                $covid_banner['title'] = 'Hati Hati! Pasien '.strtoupper($status_covid).' Covid-19';
                $covid_banner['subtitle'] = 'Gunakan APD, dan berhati hati saat melakukan pemeriksaan pasien!';
            } else {
                $status_covid = 'none';
            }
        @endphp
        @includeWhen($status_covid != 'none', 'kasus.datamedis.content.cppt.components.warning-cppt-covid', $covid_banner)
    
    <?php $i = sizeof($cppts); ?>

    <div class="row">
      <div class="col-lg-12 mb-20">
        @if($allow_crud)
        @if(session('my_invitation_'.$kasus->nomor_kasus)->user->profesi == 10)
        <button type="button" class="btn-alt btn-primary min-width-125 float-right" onclick="adimeCreate()"><i class="fa fa-pencil"></i> Buat ADIME Gizi</button>
        @else
        <button type="button" class="btn-alt btn-primary min-width-125 float-right" onclick="cpptCreate()"><i class="fa fa-pencil"></i> Buat CPPT</button>
        @endif
        @if(count($cppts) <= 100)
            <div class="dropdown">
                <button type="button" class="btn-alt btn-secondary min-width-125 float-right" id="print-rekap-cppt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-print"></i> Cetak Rekap CPPT <i class="fa fa-angle-down ml-5"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="print-rekap-cppt" x-placement="bottom-end">
                    <a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/cppt/print-all" target="_blink" class="dropdown-item" ><i class="fa fa-print"></i> Cetak Semua CPPT</a>
                    <a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/cppt/print-sebagian" target="_blink" class="dropdown-item" ><i class="fa fa-print"></i> Cetak Sebagian</a>
                </div>
            </div>
        @else
            @php
                $cppt_chunk = $cppts;
                $cppt_chunk = array_chunk($cppt_chunk->sortBy('created_at')->pluck('id')->toArray(),100);
            @endphp
            <div class="dropdown">
                <button type="button" class="btn-alt btn-secondary min-width-125 float-right" id="print-rekap-cppt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-print"></i> Cetak Rekap CPPT <i class="fa fa-angle-down ml-5"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="print-rekap-cppt" x-placement="bottom-end">
                    @php $last = 0 @endphp
                    @foreach($cppt_chunk as $index => $item)
                        @php $last += count($item)@endphp
                    <a class="dropdown-item" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/cppt/print-all?ids={{implode('%amp',$item)}}" target="_blink">
                        <i class="fa fa-file-text mr-5"></i> {{$index*100+1}} - {{$last}}
                     </a>
                    @endforeach
                    <a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/cppt/print-sebagian" target="_blink" class="dropdown-item" ><i class="fa fa-print"></i> Cetak Sebagian</a>
                </div>
            </div>
        @endif
        @endif
        <button type="button" id="cppt-histori-button" class="btn-alt btn-warning  min-width-125 float-right" ><i class="fa fa-loop"></i> Histori CPPT</button>
        <div class="dropdown">
        <button type="button" class="btn-alt btn-secondary min-width-125 float-right full-only" id="page-header-user-dropdown-full" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Print<i class="fa fa-angle-down ml-5"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="page-header-user-dropdown-full" x-placement="bottom-end">
            <a class="dropdown-item" href="javascript:void(0)" onclick="popupwindow('{{url('')}}/pasien/{{$kasus->pasien->id}}/print/ringkasan-ranap', 'Print', 800, 600)">
                <i class="fa fa-file-text mr-5"></i> Riwayat Rawat Inap
            </a>
            <a class="dropdown-item" href="javascript:void(0)" onclick="popupwindow('{{url('')}}/pasien/{{$kasus->pasien->id}}/print/ringkasan-rajal', 'Print', 800, 600)">
                <i class="fa fa-file-text mr-5"></i> Riwayat Rawat Jalan
            </a>
            <a class="dropdown-item" href="javascript:void(0)" onclick="popupwindow('{{url('')}}/pasien/{{$kasus->pasien->id}}/print/prmrj', 'Print', 800, 600)">
                <i class="fa fa-file-text mr-5"></i> PRMRJ
            </a>
        </div>
        </div>
    </div>
    @if (!empty($unread_readback)) 
        <div class="col-md-12">
            <div class="block block-bordered card bg-danger p-2" style="color:white; font-weight: 500">ada {{ $unread_readback }} cppt belum di readback</div>
        </div>
    @endif

    @forelse ($cppts as $cppt)

    @php
        $loop_iteration_cppt = $loop->iteration;
    @endphp

    <div class="col-md-12">
        <div class="block block-bordered block-mode-hidden">
            <div class="block-header block-header-default"> <!-- parent btn-edit-cppt -->
                <h3 class="block-title d-flex"><span style="white-space: nowrap;margin-right: .75rem">{{($cppt->jenis) ? strtoupper($cppt->jenis) : 'CPPT'}} {{ $i }}</span>
                    @php
                        $my_readback = $cppt->readbacks()->where('dokter_id', Auth::id())->first() ?? null;
                    @endphp
                    <small style="white-space: nowrap;margin-right: .75rem"> 
                        {{$cppt->created_at->format('d-m-Y')}} 
                        @if($cppt->creator && $cppt->creator->profesi == 1 ) @php $class_cppt = 'badge badge-primary' @endphp
                        @elseif($cppt->creator && $cppt->creator->profesi == 2 ) @php $class_cppt = 'badge badge-success' @endphp
                        @elseif($cppt->creator && $cppt->creator->profesi == 3 ) @php $class_cppt = 'badge badge-danger' @endphp
                        @elseif($cppt->creator && $cppt->creator->profesi == 10 ) @php $class_cppt = 'badge badge-warning' @endphp
                        @else @php $class_cppt = 'badge badge-secondary' @endphp 
                        @endif

                        <span class="{{$class_cppt}}"> 
                            {{$cppt->creator->profesi_detail->title ?? '-'}}
                            -
                            {{$cppt->creator->name ?? '-'}}
                        </span> 
                    </small>
                    <small style="white-space: normal">
                        @if (Auth::user()->profesi == 2 && !empty(session('my_role_'.request()->route('nomor_kasus'))))
                            @forelse ($cppt->readbacks as $readback)
                                @php
                                    $user_readback = $readback->user;
                                    $class_readback = 'badge badge-danger';
                                    if ($readback->verified_at != null) {
                                        $class_readback = 'badge badge-success';
                                    } else {
                                        $class_readback = 'badge badge-danger';
                                    }
                                @endphp
                                <span class="{{ $class_readback }}">{{ $user_readback->name }} - {{ $readback->verified_at . ' Read Back' ?? 'Belum Verifikasi' }}</span>
                            @empty
                                <span class="badge">readback belum dibuat</span>
                            @endforelse
                        @endif
                            @if (!empty($my_readback) && $my_readback->verified_at != null)
                                <span class="badge badge-success">Readback Terverifikasi</span>
                            @elseif(!empty($my_readback) )
                                <span class="badge badge-danger">Readback Butuh Verifikasi</span>
                            @endif
                    </small>
                        
                </h3>

                <!-- Marked Print -->
                @php $sudah_termarked_print = empty($cppt->marked_print_at) ? false : true; @endphp
                <div id="marked-print-cppt-{{$i}}">
                    <button type="button" class="btn-block-option"  title=" {{$sudah_termarked_print ? 'Hapus ' : ''}} Marked Print" onclick="markedPrintCPPT( {{$cppt->id}} , {{$i}}, {{$sudah_termarked_print}} )">
                        <i class="{{$sudah_termarked_print ? 'fa fa-flag' : 'si si-flag'}}"></i>
                    </button>
                </div>

                @if($allow_crud == 1 && ($cppt->created_by == Auth::user()->id) && !$cppt->jenis)
                <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Copy CPPT" onclick="cpptCopy({{$cppt->id}})">
                    <i class="fal fa-copy"></i>
                </button>
                @endif

                @if (Auth::user()->profesi == 2 && !empty(session('my_role_'.request()->route('nomor_kasus'))) && $cppt->readbacks()->count() == 0)
                    <button  type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Readback" onclick="readback({{$cppt->id}})">
                        <i class="far fa-file-alt"></i>
                    </button>
                @endif
                @if (!empty($my_readback) && $my_readback->verified_at == null)
                    <button  type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Verifikasi Readback" onclick="verifReadback({{$my_readback->id}})">
                        <i class="far fa-file-alt"></i>
                    </button>
                @endif

                @if(isset($cppt->jenis))
                    @if($cppt->jenis == 'rapt')
                    <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Print" onclick="raptPrint({{$cppt->id}})">
                        <i class="si si-printer"></i>
                    </button>
                    @endif
                @else
                <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Print" onclick="cpptPrint({{$cppt->id}})">
                    <i class="si si-printer"></i>
                </button>
                @endif

                @if($allow_crud == 1 && $cppt->jenis != 'adime' && in_array(Auth::user()->id,explode(',',$cppt->creator->user_allow_override)))
                <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Override" onclick="cpptOverrideModal({{$cppt->id}},{{$i}})">
                    <i class="si si-flag"></i>
                </button>
                @endif

                @php $need_verifikasi_dokter = 0 @endphp
                @php $slug_specialty_creator = $cppt->creator->specialty_detail->slug ?? '-' @endphp
                @php $slug_specialty_user = Auth::user()->specialty_detail->slug ?? '-' @endphp

                @if($slug_specialty_creator == 'perawat-vokasi')
                    @if(empty($cppt->verified_at) && $my_role && Auth::user()->profesi == 1 && !in_array(Auth::user()->specialty,[1,2,90])  && (Auth::user()->id != $cppt->created_by))
                        @php $need_verifikasi_dokter = 1 @endphp
                    @endif
                @else
                    @if(empty($cppt->verified_at) && $my_role_admin == 1  && (Auth::user()->id != $cppt->created_by) && $cppt->creator->profesi == 1 && !in_array($cppt->creator->specialty,[1,2]))
                        @php $need_verifikasi_dokter = 1 @endphp
                        @elseif(empty($cppt->verified_at) && $my_role && Auth::user()->profesi == 1 && !in_array(Auth::user()->specialty,[1,2])  && (Auth::user()->id != $cppt->created_by))
                        @php $need_verifikasi_dokter = 1 @endphp
                    @endif
                @endif
                @if($slug_specialty_user == 'magister-keperawatan')
                    @php $need_verifikasi_dokter = 1 @endphp
                @endif

                @if($need_verifikasi_dokter)
                <button type="button"  id="cppt_button_verifikasi_{{$i}}" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Verifikasi" onclick="cpptVerifikasi({{$cppt->id}},{{$i}})">
                    <i class="si si-check" id="cppt_button_verifikasi_check_{{$i}}"></i>
                    <span  id="cppt_button_verifikasi_loading_{{$i}}" class="hide"><i class="fa fa-spinner fa-spin"></i> Verifying</span>
                </button>
                @endif

                @if(empty($cppt->review) && $my_role_admin == 1 && $cppt->created_by != Auth::user()->id)
                <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Review" onclick="cpptReviewModal({{$cppt->id}},{{$i}})">
                    <i class="si si-eyeglasses"></i>
                </button>
                @endif

                @if(empty($cppt->verified_ners_at) && $slug_specialty_creator == 'perawat-vokasi' && $slug_specialty_user == 'perawat-ners')
                <button type="button"  id="cppt_button_verifikasi_ners_{{$i}}" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Verifikasi" onclick="cpptVerifikasiNERS({{$cppt->id}},{{$i}})">
                    <i class="si si-check" id="cppt_button_verifikasi_check_{{$i}}"></i>
                    <span  id="cppt_button_verifikasi_ners_loading_{{$i}}" class="hide"><i class="fa fa-spinner fa-spin"></i> Verifying</span>
                </button>
                @endif

                @if($allow_crud == 1 && ($cppt->created_by == Auth::user()->id))
                <button type="button" class="btn-block-option " data-toggle="tooltip" data-placement="top" title="Hapus" onclick="cpptDeleteModal({{$cppt->id}},{{$i}})">
                    <i class="si si-trash"></i>
                </button>

                @if($cppt->jenis == 'adime')
                <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Edit" onclick="adimeEdit({{$cppt}})">
                    <i class="si si-pencil"></i>
                </button> 
                @else
                <button type="button" class="btn-block-option btn-edit-cppt" data-toggle="tooltip" data-placement="top" title="Edit" onclick="cpptEditModal({{$cppt->id}},{{$i}})">
                    <i class="si si-pencil"></i> <!-- ini buttonnya -->
                </button>
                @endif

                @endif


                <div class="block-options">
                    <button type="button" class="btn-block-option btn-content-toogle" data-status="non-active" data-toggle="block-option" data-action="content_toggle"></button>
                </div>
            </div>
            <div class="block-content soap-item" id="cppt-item-{{$i}}">
                @if($cppt->jenis == 'adime')


                <h5 class="font-w400 mb-0">
                    <small>ASSESSMENT</small>
                </h5>
                <h5 class="font-w400" style="white-space: pre-line">{{$cppt->assessment }}</h5>

                <h5 class="font-w400 mb-0">
                    <small>DIAGNOSIS</small>
                </h5>
                <h5 class="font-w400" style="white-space: pre-line">{{$cppt->subjective }}</h5>


                <h5 class="font-w400 mb-0">
                    <small>INTERVENTION</small>
                </h5>
                <h5 class="font-w400" style="white-space: pre-line">{{$cppt->objective }}</h5>


                <h5 class="font-w400 mb-0">
                    <small>MONITORING</small>
                </h5>
                <h5 class="font-w400" style="white-space: pre-line">{{$cppt->plan }}</h5>

                <h5 class="font-w400 mb-0">
                    <small>EVALUATION</small>
                </h5>
                <h5 class="font-w400" style="white-space: pre-line">{{$cppt->ppa }}</h5>

                @if(!empty($cppt->review))
                <h5 class="font-w400 mb-0">
                    <small>Review</small>
                </h5>
                <h5 class="font-w400" style="white-space: pre-line">{{$cppt->review }}</h5>
                @endif
                
                @else
                @if($cppt->jenis == 'rapt')
                <div class="row">
                    <div class="col-4">
                        <h5 class="font-w400 mb-0">
                            <small>KEBUTUHAN PELAYANAN</small>
                        </h5>
                        <h5 class="font-w400" style="white-space: pre-line" id="kebutuhan_pelayanan_rapt">
                            @if($cppt->preventif) <i class="fa fa-check text-primary"></i> @else <i class="fa fa-close text-danger"></i> @endif Preventif
                            @if($cppt->kuratif) <i class="fa fa-check text-primary"></i> @else <i class="fa fa-close text-danger"></i> @endif Kuratif
                            @if($cppt->rehab) <i class="fa fa-check text-primary"></i> @else <i class="fa fa-close text-danger"></i> @endif Rehabilitatif
                            @if($cppt->paliatif) <i class="fa fa-check text-primary"></i> @else <i class="fa fa-close text-danger"></i> @endif Paliatif
                        </h5>
                    </div>
                    <div class="col-4">
                        <h5 class="font-w400 mb-0">
                            <small>PRIORITAS</small>
                        </h5>
                        <h5 class="font-w400" style="white-space: pre-line">
                            @if($cppt->prioritas == 'prioritas') <strong>Prioritas</strong>
                            @elseif($cppt->prioritas == 'tunda') Dapat Ditunda
                            @endif
                        </h5>

                    </div>
                    <div class="col-4">
                        <h5 class="font-w400 mb-0">
                            <small>PERKIRAAN HARI RAWAT</small>
                        </h5>
                        <h5 class="font-w400" style="white-space: pre-line">
                            {{$cppt->perkiraan_hari_rawat ?? '-'}} hari
                        </h5>
                    </div>
                </div>
                @endif
                <h5 class="font-w400 mb-0">
                    <small>SUBJECTIVE</small>
                </h5>
                <h5 class="font-w400" style="white-space: pre-line">{{$cppt->subjective }}</h5>


                <h5 class="font-w400 mb-0">
                    <small>OBJECTIVE</small>
                </h5>
                <h5 class="font-w400" style="white-space: pre-line">{{$cppt->objective }}</h5>


                <h5 class="font-w400 mb-0">
                    <small>ASSESSMENT</small>
                </h5>
                <h5 class="font-w400" style="white-space: pre-line">{{$cppt->assessment }}</h5>


                <h5 class="font-w400 mb-0">
                    <small>PLAN</small>
                </h5>
                <h5 class="font-w400" style="white-space: pre-line">{{$cppt->plan }}</h5>


                <h5 class="font-w400 mb-0">
                    <small>
                        @if($cppt->creator->profesi == 1)
                        INSTRUKSI DOKTER
                        @else
                        KETERANGAN
                        @endif
                    </small>
                </h5>
                <h5 class="font-w400" style="white-space: pre-line">{{$cppt->ppa }}</h5>
                @php
                    $files=json_decode($cppt->cppt_files); 
                    $loop=0;  
                @endphp
                @if(!empty($files))
                    <h5 class="font-w400 mb-0">
                        <small>File Upload</small>
                    </h5>
                    <div class="row" id="file-upload-row">
                        @foreach ($files as $key => $value)
                        {{-- <a href="{{ url($value->path) }}" style="display:block;width:130px">
                                <img src="{{URL::asset('assets/img/filetype.png')}}" align="middle" style="max-width: 100px;display: block;margin-left: auto;margin-right: auto">
                                <p style="text-align: center">{{ $value->nama_file }}</p>
                        </a> --}}

                        @include('kasus.datamedis.content.cppt.preview-modal')

                        <a href="" style="display:block;width:130px" data-toggle="modal" data-target="#preview-modal-{{ $loop_iteration_cppt }}-{{ $loop->iteration }}">
                            <img src="{{URL::asset('assets/img/filetype.png')}}" align="middle" style="max-width: 100px;display: block;margin-left: auto;margin-right: auto">
                            <p style="text-align: center">{{ $value->nama_file }}</p>
                        </a>
                            @if($allow_crud == 1 && ($cppt->created_by == Auth::user()->id))
                            <button type="button" style="height: 50px;" class="btn-block-option " data-toggle="tooltip" data-placement="top" title="Hapus" onclick="cpptDeletefileModal({{$cppt->id}},{{$value->id}})">
                                <i class="fa fa-trash" style="color: red;vertical-align: top"></i>
                            </button>
                            @endif
                         @endforeach
                    </div>
                @endif

                @if(!empty($cppt->review))
                <h5 class="font-w400 mb-0">
                    <small>Review</small>
                </h5>
                <h5 class="font-w400" style="white-space: pre-line">{{$cppt->review }}</h5>
                @endif

                @if(!empty($cppt->discharge_planning))
                    @php $item = json_decode($cppt->discharge_planning) @endphp
                    @php $item = (array) $item @endphp
                    @include('kasus.datamedis.content.asesmenawal.components.view-pulang',['item' => $item])
                @endif

                @endif

                <div class="row">
                    <div class="col-4">
                        <h6 class="p-10">
                            <small class="text-muted">Dibuat Oleh</small><br>
                            {{ $cppt->creator->name ?? '-'}}<br>
                            <span class="font-w400"> {{ $cppt->tanggal }}</span>
                        </h6>        
                    </div>
                    @if(!empty($cppt->updated_by))
                    <div class="col-4">
                        <h6 class="p-10">
                            <small class="text-muted">Diupdate Oleh</small><br>
                            {{ $cppt->updater->name }}<br>
                            <span class="font-w400"> {{ $cppt->tanggal_update }}</span>
                        </h6>                        
                    </div>                    
                    @endif

                    @if(!empty($cppt->verified_by))
                    <div class="col-4 ">
                        <h6 class="p-10">
                            <small class="text-muted">Verifikasi Dokter Oleh</small><br>
                            {{$cppt->verifier->name}}<br>
                            <span class="font-w400"> {{ $cppt->tanggal_verifikasi }}</span>
                        </h6>                        
                    </div>
                    @else
                    <div class="col-4 hide" id="cppt_container_verified_{{$i}}">
                        <h6 class="p-10">
                            <small class="text-muted">Verifikasi Dokter Oleh</small><br>
                            <span id="cppt_verified_by_{{$i}}"></span><br>
                            <span class="font-w400" id="cppt_verified_at_{{$i}}"></span>
                        </h6>                        
                    </div>
                    @endif


                    @if(!empty($cppt->review_by))
                    <div class="col-4">
                        <h6 class="p-10">
                            <small class="text-muted">Di Review Oleh</small><br>
                            {{ $cppt->reviewer->name }}<br>
                            <span class="font-w400"> {{ indonesian_date($cppt->review_at) }}</span>
                        </h6>                        
                    </div>                    
                    @endif

                    @if(!empty($cppt->verified_ners_by))
                    <div class="col-4 ">
                        <h6 class="p-10">
                            <small class="text-muted">Verifikasi NERS Oleh</small><br>
                            {{$cppt->verifikatorNers->name}}<br>
                            <span class="font-w400"> {{ indonesian_date($cppt->verified_ners_at) }}</span>
                        </h6>                        
                    </div>
                    @else
                    <div class="col-4 hide" id="cppt_ners_container_verified_{{$i}}">
                        <h6 class="p-10">
                            <small class="text-muted">Verifikasi NERS Oleh</small><br>
                            <span id="cppt_ners_verified_by_{{$i}}"></span><br>
                            <span class="font-w400" id="cppt_ners_verified_at_{{$i}}"></span>
                        </h6>                        
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <?php $i--; ?>
    @empty
    <div class="col-12 text-center py-50">
        <h4 class="font-w400 mb-5">Belum ada cppt</h4>
        <p>Klik tombol <b>Buat CPPT</b> untuk menambahkan cppt baru</p>
    </div>
    @endforelse


</div>
</div>


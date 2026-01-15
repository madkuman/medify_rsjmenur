<div class="block border" id="form-krs" @if(!empty($kasus->krs_at)) style="display:none;" @endif>
    <div class="block-header">
        <h5 class="block-title">Pasien Keluar Rumah Sakit <small>(Pasien KRS)</small></h5>
        <div class="block-options">
            <!-- To toggle block's content, just add the following properties to your button: data-toggle="block-option" data-action="content_toggle" -->
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
        </div>
    </div>

    <div class="col-12 pt-10">
        @if (empty($kasus->ringkasanPasienPulang))
            <div class="alert alert-warning alert-dismissible fade show mt-20" role="alert" style="background-color: red;color: white;">
                <strong style="font-size: 20px">RINGKASAN PULANG BELUM DIBUAT</strong>
                <br>
                <p class="mb-0" style="margin-top: 10px">
                    Harap mengisi ringkasan pulang terlebih dahulu sebelum melakukan KRS
                </p>
            </div>
        @endif
    </div>

    {{--
    @if(empty($kasus->resume))
    <div class="col-12">
        <div class="alert alert-danger">
            <h4>Harap Isi Resume!</h4>
            <p>Pasien tidak dapat di KRS karena belum ada resume untuk kasus ini.</p>
        </div>
    </div>
    @else
    @endif
    --}}
    <div class="block-content pb-10">
        <form class="js-validation-be-contact" id="confirmKRSForm" action="{{url('kasus')}}/{{ $nomor_kasus }}/pengaturan/data/krs" method="post">
          {{ csrf_field() }}

        <div class="row">
{{--
            <div class="col-12">
                <div class="form-group">
                    <label>Tanggal KRS</label>
                    <input type="text" name="krs_at" class="form-control js-datepicker" placeholder="Tanggal Pasien KRS" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy" required=""
                    @if(!empty($kasus->krs_at))
                    value="{{implode('-', array_reverse(explode('-', explode(' ',$kasus->krs_at)[0])))}}"
                    @endif>
                </div>
            </div>
--}}
            <div class="col-12">
                <div class="form-group">
                    @php
                        $disabled = '';
                        if(isset($rujuk))
                            $disabled = 'disabled';
                    @endphp
                    <label>Alasan Keluar RS</label>
                    <select name="alasan_krs" id="alasan_krs" class="form-control" required onchange="alasanKRS()" {{$disabled ?? null}}>
                        <option value="" disabled @if(empty($kasus->krs_alasan)) selected @endif hidden>Pilih Alasan Keluar RS</option>
                        @foreach($cara_pulang as $item)
                            <option value="{{$item->id}}" data-aps="{{($item->slug == 'aps') ? 1 : 0}}" data-rujuk="{{($item->slug == 'rujuk') ? 1 : 0}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                    @if ($disabled == 'disabled')
                        <input type="hidden" name="alasan_krs_selected">
                    @endif
                </div>
            </div>

            <div class="col-12" id="div_keterangan_aps" style="display:none;">
                <div class="form-group">
                    <label>Alasan APS</label>
                    <input type="text" class="form-control" name="krs_keterangan" value="{{$kasus->krs_keterangan ?? ''}}">
                </div>
            </div>

            <div class="col-12" id="div_keterangan_rujuk" style="display:none;">
                <div class="form-group">
                    <label> Rujuk ke </label>
                    <select class="form-control js-select2 asal-rujukan-select" name="krs_keterangan" style="width: 100%" {{ $disabled }}>
                        {{-- <option value="-" @if(empty($kasus->krs_keterangan)) selected @endif>-</option>
                        @foreach($rujuk_ke as $item)
                            <option value="{{$item->id}}" >{{$item->nama}}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>

            @if(!isset($rujuk) && $kasus->sep_id != 0)
                <div class="col-12" style="display: none;" id="rujukan_wrapper">
                    <div class="form-group">
                        <button type="button" class="btn btn-alt-primary" style="width:100%" onclick="bpjsRujuk()">
                            <i class="fa fa-plus"></i> Tambahkan Rujukan BPJS
                        </button>
                    </div>
                </div>
            @endif

            <div class="col-12">
                <div class="form-group">
                    <label>Status Keluar RS</label>
                    <select name="status_krs" id="status_krs" class="form-control" required>
                        <option value=""  disabled @if(empty($kasus->krs_status)) selected @endif hidden>Pilih Status Keluar RS</option>
                        @foreach($status_pulang as $item)
                            <option value="{{$item->id}}" data-meninggal="{{($item->slug == 'meninggal') ? 1 : 0}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12" id="div_waktu_kematian" style="display:none;">
                <div class="form-group row">
                    <div class="col-8">
                        <label>Tanggal Kematian</label>
                        <input type="text" name="death_date" id="death_date" class="form-control js-datepicker" placeholder="Tanggal Kematian" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy"
                               @if(!empty($kasus->pasien->death_at))
                               value="{{implode('-', array_reverse(explode('-', explode(' ', $kasus->pasien->death_at)[0])))}}"
                               @elseif(!empty($kasus->jenazah))
                               value="{{!empty($kasus->jenazah) ? explode(' ', $kasus->jenazah->waktu_meninggal)[0] : null}}"
                                @endif
                        >
                    </div>
                    <div class="col-4">
                        <label>Waktu Kematian</label>
                        <input type="text" class="form-control time" placeholder="hh:mm" name="death_time" id="death_time" autocomplete="off"
                               @if(!empty($kasus->pasien->death_at) || !empty($kasus->jenazah))
                               value="{{$waktu_kematian}}"
                                @endif
                        >
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label>Batalkan Permintaan : </label><br>
                    <input type="checkbox" name="gizi" value="1" checked> Gizi <br>
                    <input type="checkbox" name="labpk" value="1"> Lab PK <br>
                    <input type="checkbox" name="labpa" value="1"> Lab PA <br>
                    <input type="checkbox" name="radiologi" value="1"> Radiologi <br>
                    <input type="checkbox" name="rawatinap" value="1"> Rawat Inap <br>
                    <input type="checkbox" name="farmasi" value="1"> Farmasi <br>
                    <input type="checkbox" name="operasi" value="1"> Operasi <br>
                </div>
            </div>

            <div class="col-12">
                <!-- THIS BUTTON IS FOR VALIDATION PURPOSE ONLY -->
                <input type="submit" style="display:none" name="submitButton">

                <button type="button" onclick="confirmKRS()" id="confirmKRSButton" class="btn-alt btn-click-animate btn-hero btn-primary min-width-100 float-right">
                    <i class="fa fa-send mr-5"></i> Simpan Data KRS
                </button>

                @php
                    $disabled = '';
                    if(!isset($rujuk)) 
                        $disabled = 'disabled';
                @endphp
                <button type="button" id="button_rujuk_bpjs" class="btn-alt btn-hero btn-primary min-width-100 float-right" {{ $disabled }}>
                Lihat Rujukan BPJS
                </button>
            </div>

        </div>

        </form>
    </div>
</div>
<div class="block border" id="data-krs" @if(empty($kasus->krs_at)) style="display:none;" @endif>
    <div class="block-header">
        <h5 class="block-title">Pasien Keluar Rumah Sakit <small>(Pasien KRS)</small></h5>
        <div class="block-options">
            <!-- To toggle block's content, just add the following properties to your button: data-toggle="block-option" data-action="content_toggle" -->
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
        </div>
    </div>
    <div class="block-content pb-10">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Alasan Keluar RS</label>
                    <h5 class="font-w400">
                        {{$kasus->alasan_krs->nama ?? $kasus->krs_alasan}}
                        @if($kasus->alasan_krs && $kasus->alasan_krs->nama == 'Dirujuk')
                            - {{$kasus->krsKeterangan->nama ?? $kasus->krs_keterangan ?? 'Tidak Ada Keterangan'}}
                        @elseif(!empty($kasus->krs_keterangan))
                            - {{$kasus->krs_keterangan}}
                        @endif
                    </h5>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label>Status Keluar RS</label>
                    <h5 class="font-w400">{{$kasus->status_krs->nama ?? $kasus->krs_status}}</h5>
                </div>
            </div>

            @if(!empty($kasus->status_krs) && $kasus->status_krs->slug == 'meninggal')
                <div class="col-12">
                    <div class="form-group">
                        <label>Waktu Meninggal</label>
                        <h5 class="font-w400">{{date('d F Y, H:i', strtotime($kasus->pasien->death_at))}}</h5>
                    </div>
                </div>
            @endif

            <div class="col-12">
                <div class="form-group">
                    <label>Tanggal dan Waktu Keluar</label>
                    <h5 class="font-w400">{{date('d F Y, H:i', strtotime($kasus->krs_at))}}</h5>
                </div>
            </div>

            @if(!empty($kasus->krs_by))
                <div class="col-12">
                    <div class="form-group">
                        <label>KRS Oleh</label>
                        <h5 class="font-w400">{{$kasus->krs_by_user->name}}</h5>
                    </div>
                </div>
            @endif
        </div>

        <div class="">
        @if(!empty($kasus->rujuk_luar) && !empty($kasus->active_sep))
            <a class="btn btn-primary" href="{{url('bpjs')}}/rujukan-keluar/{{$kasus->rujuk_luar->no_rujukan}}" target="_blank" title="print">
                Lihat Rujukan BPJS
            </a>
        @endif
        <a class="btn btn-primary" href="JavaScript:Void(0)" title="edit" onclick="editKRS()">
            Ubah Data KRS
        </a>
            @if($kasus->my_invitation && $kasus->my_invitation->invitation == 1)
                @if(empty($kasus->end_at))
                    <a class="btn btn-warning" id="btn-batal-krs" href="{{url()->current()}}/batal-krs" title="batal-krs">
                        Batal KRS
                    </a>
                @endif
            @endif
        </div>
    </div>
</div>
<div class="block border"  @if(empty($kasus->krs_at)) style="display:none;" @endif>
    <div class="block-header">
        <h5 class="block-title">Tutup Kasus <small>(Pasien KRS)</small></h5>
        <div class="block-options">
            <!-- To toggle block's content, just add the following properties to your button: data-toggle="block-option" data-action="content_toggle" -->
            @if($kasus->my_invitation && $kasus->my_invitation->invitation == 1)
                @if(!empty($kasus->end_at))
                <a class="btn btn-warning" id="btn-batal-tutup-kasus" href="{{url()->current()}}/batal-tutup-kasus" title="batal-tutup-kasus">
                    Batal Tutup Kasus
                </a>
                @endif
            @endif
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
        </div>
    </div>
    <div class="block-content pb-10">
        @if(empty($kasus->end_at))
        <p>Perawatan terhadap pasien selesai. Dan pasien telah pulang. </p><p>Data kasus dapat tetap ditambahkan walaupun kasus telah di tutup. Kasus dapat anda cari melalui fitur arsip kasus yang tersedia pada dashboard anda.</p>
        <div class="pb-50">
            <button class="btn btn-primary btn-hero float-right" onclick="submitClose()">Tutup Kasus</button>
        </div>
        @else
        <p>Kasus telah ditutup </p>
        <h5 class="mb-10"><small>Kasus ditutup oleh :</small></h5>
        <span class="font-w600 h5 mb-5">{{$kasus->end_by_creator->name}}</span><br>
        <span>{{$kasus->end_at_tanggal}}</span><br>
        @endif
    </div>
</div>

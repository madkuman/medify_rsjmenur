@extends('kasus.layouts.main')

@section('title')
Buat Permintaan Baru  - Penunjang - Kasus
@endsection

@section('content')
<main id="main-container">
    @include('kasus.layouts.header')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-8">
                <a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/penunjang">Kembali ke Halaman Sebelumnya</a>
                <div class="block mt-5">
                    <form id="permintaanForm" method="POST" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/penunjang/baru">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-content">
                                <h4 class="mb-5">PERMINTAAN</h4>
                                <p>Buat permintaan baru</p>
                                <hr>
                            </div>
                            <div class="block-content row" style="padding: 5px;">
                                {{csrf_field()}}
                                <div class="col-12">
                                    <div class="form-group">
                                        {{ Form::label('nama', 'Nama Pasien')}}
                                        {{ Form::text('nama', $kasus->identitas->nama, array('class' => 'form-control','disabled' => 'disabled'))}}
                                    </div>
                                </div>
                                @if(!$is_dokter)
                                    <div class="col-12">
                                         <div class="form-group">
                                            <label>Dokter</label>
                                            <select class="js-select2 form-control requireForm" name="dokter" style="width: 100%;" required>
                                                <option value="">Pilih dokter</option>
                                                @foreach($dokter as $d)
                                                <option value="{{$d->id}}" @if($has_dpjp && $d->id == $kasus->dpjp->user_id) selected @endif>{{$d->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($tarif_urikkes))
                                    <input type="hidden" id="tarif_urikkes" value="{{$tarif_urikkes}}">
                                @endif
                                <input type="hidden" name="pasien" value="{{$kasus->pasien->id}}" id="pasien">
                                <input type="hidden" name="kasus_id" value="{{$kasus->id}}">
                                @if(!empty($kasus->sep_id))
                                <input type="hidden" name="sep_id" value="{{$kasus->sep_id}}">
                                <input type="hidden" name="sep_num" value="{{$kasus->nomor_sep}}">
                                @endif
                                <div class="col-12">
                                    <div class="form-group">
                                        {{ Form::label('tujuan_permintaan', 'Tujuan Permintaan')}}
                                        <br>
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input tujuan-permintaan" name="tujuan_permintaan" onchange="changeForm()" data-dept="radiologi" value="1">
                                            <span class="css-control-indicator"></span>Radiologi
                                        </label>
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input tujuan-permintaan" name="tujuan_permintaan" onchange="changeForm()" data-dept="lab-pa" value="2">
                                            <span class="css-control-indicator"></span>Lab PA
                                        </label>
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input tujuan-permintaan" name="tujuan_permintaan" onchange="changeForm()" data-dept="lab-pk" value="3">
                                            <span class="css-control-indicator"></span>Lab PK
                                        </label>

                                        <span class="text-danger hide">Anda harus mengisi input ini</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        {{ Form::label('tipe_layanan', 'Jenis Layanan')}}                                        
                                        <br>
                                        @foreach($tipe as $t)
                                            <label class="css-control css-control-primary css-radio">
                                                <input type="radio" class="css-control-input tipe-layanan" name="tipe_layanan" onchange="changeForm()" value="{{$t->id}}">
                                                <span class="css-control-indicator"></span>{{$t->nama}}
                                            </label>
                                        @endforeach
                                        <span class="text-danger hide">Anda harus mengisi input ini</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        {{ Form::label('tanggal_periksa', 'Jadwal Pemeriksaan')}}
                                        <br>
                                        <input type="text" class="js-datepicker form-control datepicker" name="tanggal_periksa" placeholder="Pilih Tanggal" id="tagihanTanggalTransaksi" data-week-start="1" data-autoclose="true" data-today-highlight="true"  data-date-format="dd-mm-yyyy" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-0">
                                        <label>Kirim Tagihan ke</label>                                     
                                        <br>
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input kirim_kasir" name="kirim_kasir" value="1" 
                                            >
                                            <span class="css-control-indicator"></span>Kasir (Langsung dibayarkan pada kasir)

                                            @if($kasus->pembayaran->perusahaan->tipe->slug == 'tunai' && 
                                            $kasus->lokasi->lokasi->departemen->slug != 'rawat-inap')
                                                <strong style="font-style: italic;"> (Recommended) </strong> 
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input kirim_kasir" name="kirim_kasir" value="0"
                                            >
                                            <span class="css-control-indicator"></span>Kasus (Tagihan akan dikirim ke ruangan / poli. Pembayaran dilakukan setelah KRS) 

                                            @if($kasus->pembayaran->perusahaan->tipe->id == 'tunai' || 
                                            $kasus->lokasi->lokasi->departemen->slug != 'rawat-inap') 
                                                <strong style="font-style: italic;"> (Recommended) </strong> 
                                            @endif

                                        </label>
                                    </div>
                                </div>
                                    <input type="hidden" name="kelas_pasien" value="{{$kasus->kelas_id}}" id="kelasInput">
                                <div class="col-12" style="display:none;">
                                    <div class="form-group" style="padding-bottom: 10px;">
                                        <label class="control-label">Ruang Asal</label>
                                        <input type="text" class="form-control" id="asal_ruang" value="{{$kasus->lokasi->lokasi->nama}}" readonly>
                                        <input type="hidden" class="form-control" id="lokasi_id"  name="asal_ruang" value="{{$kasus->lokasi->lokasi->id}}">
                                    </div>
                                </div>
                                <div class="col-5"></div>
                                <div class="col-2">
                                    <span class="fa fa-4x fa-cog fa-spin text-primary text-center loader" style="display: none;"></span>
                                </div>
                                <div class="col-5"></div>
                                @include('kasus.penunjang.content.permintaan.layanan-lab')
                                @include('kasus.penunjang.content.permintaan.create-form-spesimen-mikrobiologi')
                                <div class="col-12">
                                    <div class="form-group" style="padding-bottom: 10px;">
                                        <label class="control-label">Klinis</label>
                                        <textarea class="form-control" rows="4" name="keterangan" placeholder="Tulis Keterangan tambahan disini..."></textarea>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-12">
                                    <div class="form-group" style="padding-bottom: 10px;">
                                        <label class="control-label">Keterangan Permintaan</label>
                                        <textarea class="form-control" rows="4" name="keterangan_permintaan" placeholder="Tulis Keterangan tambahan disini..."></textarea>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-danger" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/penunjang">Batal</a>
                                <button type="button" class="btn btn-primary" id="submitBuatPermintaanBtn" 
                                onclick="validateForm()">
                                    <i class="fa fa-check"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('js')
@include('kasus.penunjang.content.permintaan.layanan-lab')
<script type="text/javascript">
    var layananUrl = "{{url('keuangan/tarif_master/get_lab')}}";
</script>
@include('kasus.penunjang.content.permintaan.js')
@endsection('js')
@extends('keuangan.layouts.main')

@section('title')
Uji Baru - Keuangan
@endsection

@section('content')
@include('keuangan.uji.components.header')

<!-- Page Content -->
<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Buat Uji Baru</h3>
    </div>
    <form method="POST" class="block-content">
        {{csrf_field()}}
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Nomor SPP</label>
                <select class="js-select2 form-control" id="idpjk" name="idpjk" data-placeholder="Masukkan Nomor SPP">
                    @if($single_utang == 1)
                    <option value="{{$utang->id}}" selected="true">{{$utang->no_spp}}</option>
                    @else
                    <option></option>
                    @foreach($utang as $item)
                    <option value="{{$item->id}}">{{$item->no_spp}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Tanggal Uji</label>
                <input type="text" class="js-datepicker form-control" id="tanggaltransaksi" name="tanggaltransaksi" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Auto" value="{{date('d-m-Y', time())}}">
            </div>
            <div class="col-4 div-no-se">
                <label for="example-datepicker1">Nomor SE</label>
                <input type="text" class="form-control" id="nose" name="nose" required>
            </div>
            {{--<!--
            <div class="col-4">
                <label for="example-datepicker1">Akun Pembayaran</label>
                <select class="js-select2 form-control" id="akun" name="akun" data-placeholder="Masukkan Akun Pembayaran">
                    <option></option>
                    @foreach($akun as $item)
                    <option value="{{$item->id}}">{{$item->nama}}</option>
                    @endforeach
                </select>
            </div>-->--}}
        </div>
        <hr>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Nomor PJK</label>
                <input type="text" class="form-control" id="nopjk" name="nopjk" placeholder="Auto" @if ($single_utang == 1) value="{{$utang->nomor_pjk}}" @endif disabled="true">
            </div>
            <div class="col-4" id="input-perusahaan-container">
                <label>Rekanan</label>
                <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Auto" disabled="true">
                    @if($single_utang == 1)
                    <option value="{{$utang->perusahaan_id}}" selected="true">{{$utang->perusahaan->nama}}</option>
                    @endif
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Mengenai</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Auto" @if ($single_utang == 1) value="{{$utang->judul}}" @endif disabled="true">
                <input type="hidden" id="judul-hidden" name="judul" @if ($single_utang == 1) value="{{$utang->judul}}" @endif>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Jumlah</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Auto" @if ($single_utang == 1) value="{{number_format($utang->total)}}" @endif disabled="true">
                    <input type="hidden" id="jumlah-hidden" name="jumlah" @if ($single_utang == 1) value="{{$utang->total}}" @else value="0" @endif>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Pengadaan Barang</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="number" class="form-control enter-new-field" id="pengadaanbarang" name="pengadaanbarang" placeholder="Masukkan Pengadaan Barang" value="0">
                </div>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Jasa</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="jasa" name="jasa" placeholder="Auto" disabled="true">
                    <input type="hidden" id="jasa-hidden" name="jasa">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Bebas PPN</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="number" class="form-control enter-new-field" id="bebasppn" name="bebasppn" placeholder="Masukkan Bebas PPN" value="0">
                </div>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Kena PPN</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="kenappn" name="kenappn" placeholder="Auto" disabled="true">
                    <input type="hidden" id="kenappn-hidden" name="kenappn">
                </div>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">PPH 23 Non PPN</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="number" class="form-control enter-new-field" id="pph23nonppn" name="pph23nonppn" placeholder="Masukkan Bebas PPN" value="0">
                </div>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-6">
                <h6 class="block-title mb-20">Pajak Pengadaan Barang</h6>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPN</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="ppn_barang" id="ppn-barang" value="10">
                            <label class="custom-control-label" for="ppn-barang">10%</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPH 21</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph21_barang" id="pph21-5-barang" value="5">
                            <label class="custom-control-label" for="pph21-5-barang">5%</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph21_barang" id="pph21-15-barang" value="15">
                            <label class="custom-control-label" for="pph21-15-barang">15%</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPH 22</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph22_barang" id="pph22-barang" value="1.5">
                            <label class="custom-control-label" for="pph22-barang">1.5%</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPH 23</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph23_barang" id="pph23-2-barang" value="2">
                            <label class="custom-control-label" for="pph23-2-barang">2%</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph23_barang" id="pph23-4-barang" value="4">
                            <label class="custom-control-label" for="pph23-4-barang">4%</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPH 23 Pengadaan Barang (AC)</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph23ac_barang" id="pph23-ac-barang" value="2">
                            <label class="custom-control-label" for="pph23-ac-barang">2%</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPH 23 Pengadaan Barang (Bahan Basah)</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph23bb_barang" id="pph23-bb-barang" value="2">
                            <label class="custom-control-label" for="pph23-bb-barang">2%</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPH 4</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph4_barang" id="pph4-2-barang" value="2">
                            <label class="custom-control-label" for="pph4-2-barang">2%</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph4_barang" id="pph4-3-barang" value="3">
                            <label class="custom-control-label" for="pph4-3-barang">3%</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph4_barang" id="pph4-4-barang" value="4">
                            <label class="custom-control-label" for="pph4-4-barang">4%</label>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-6">
                <h6 class="block-title mb-20">Pajak Jasa</h6>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPN</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="ppn_jasa" id="ppn-jasa" value="10">
                            <label class="custom-control-label" for="ppn-jasa">10%</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPH 21</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph21_jasa" id="pph21-5-jasa" value="5">
                            <label class="custom-control-label" for="pph21-5-jasa">5%</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph21_jasa" id="pph21-15-jasa" value="15">
                            <label class="custom-control-label" for="pph21-15-jasa">15%</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPH 22</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph22_jasa" id="pph22-jasa" value="1.5">
                            <label class="custom-control-label" for="pph22-jasa">1.5%</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPH 23</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph23_jasa" id="pph23-2-jasa" value="2">
                            <label class="custom-control-label" for="pph23-2-jasa">2%</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph23_jasa" id="pph23-4-jasa" value="4">
                            <label class="custom-control-label" for="pph23-4-jasa">4%</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPH 23 Pengadaan Barang (AC)</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph23ac_jasa" id="pph23-ac-jasa" value="2">
                            <label class="custom-control-label" for="pph23-ac-jasa">2%</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPH 23 Pengadaan Barang (Bahan Basah)</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph23bb_jasa" id="pph23-bb-jasa" value="2">
                            <label class="custom-control-label" for="pph23-bb-jasa">2%</label>
                        </div>
                    </div>
                </div>
                <br>
                <!-- <div class="row">
                    <div class="col-4">
                        <label for="example-datepicker1">PPH 4</label>
                    </div>
                    <div class="col-8">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph4_jasa" id="pph4-2-jasa" value="2">
                            <label class="custom-control-label" for="pph4-2-jasa">2%</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph4_jasa" id="pph4-3-jasa" value="3">
                            <label class="custom-control-label" for="pph4-3-jasa">3%</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="pph4_jasa" id="pph4-4-jasa" value="4">
                            <label class="custom-control-label" for="pph4-4-jasa">4%</label>
                        </div>
                    </div>
                </div>
                <br> -->
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2">
                <button type="submit" class="btn btn-success btn-hero btn-block" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                <button class="btn btn-alt-success btn-hero btn-block" style="display: none" id="buttonLoading" disabled="true">
                    <i class="fa fa-asterisk fa-spin"></i> Loading
                </button>
            </div>
        </div>
    </form>
</div>


<!-- END Page Content -->
@endsection

@section('js')
@include('keuangan.uji.components.create-js')
{{-- <script src="{{asset('js/keuangan/pengeluaran/uji/create.js')}}"></script> --}}
<script type="text/javascript">
    $('#pph21-5-barang').change(function(){
        if($('#pph21-15-barang').prop('checked') == true){
            $('#pph21-15-barang').prop('checked', false);
        }
    });
    $('#pph21-15-barang').change(function(){
        if($('#pph21-5-barang').prop('checked') == true){
            $('#pph21-5-barang').prop('checked', false);
        }
    });
    $('#pph23-2-barang').change(function(){
        if($('#pph23-4-barang').prop('checked') == true){
            $('#pph23-4-barang').prop('checked', false);
        }
    });
    $('#pph23-4-barang').change(function(){
        if($('#pph23-2-barang').prop('checked') == true){
            $('#pph23-2-barang').prop('checked', false);
        }
    });
    $('#pph4-2-barang').change(function(){
        if($('#pph4-3-barang').prop('checked') == true){
            $('#pph4-3-barang').prop('checked', false);
        }
        if($('#pph4-4-barang').prop('checked') == true){
            $('#pph4-4-barang').prop('checked', false);
        }
    });
    $('#pph4-3-barang').change(function(){
        if($('#pph4-2-barang').prop('checked') == true){
            $('#pph4-2-barang').prop('checked', false);
        }
        if($('#pph4-4-barang').prop('checked') == true){
            $('#pph4-4-barang').prop('checked', false);
        }
    });
    $('#pph4-4-barang').change(function(){
        if($('#pph4-2-barang').prop('checked') == true){
            $('#pph4-2-barang').prop('checked', false);
        }
        if($('#pph4-3-barang').prop('checked') == true){
            $('#pph4-3-barang').prop('checked', false);
        }
    });
    $('#pph21-5-jasa').change(function(){
        if($('#pph21-15-jasa').prop('checked') == true){
            $('#pph21-15-jasa').prop('checked', false);
        }
    });
    $('#pph21-15-jasa').change(function(){
        if($('#pph21-5-jasa').prop('checked') == true){
            $('#pph21-5-jasa').prop('checked', false);
        }
    });
    $('#pph23-2-jasa').change(function(){
        if($('#pph23-4-jasa').prop('checked') == true){
            $('#pph23-4-jasa').prop('checked', false);
        }
    });
    $('#pph23-4-jasa').change(function(){
        if($('#pph23-2-jasa').prop('checked') == true){
            $('#pph23-2-jasa').prop('checked', false);
        }
    });
    // $('#pph4-2-jasa').change(function(){
    //     if($('#pph4-3-jasa').prop('checked') == true){
    //         $('#pph4-3-jasa').prop('checked', false);
    //     }
    //     if($('#pph4-4-jasa').prop('checked') == true){
    //         $('#pph4-4-jasa').prop('checked', false);
    //     }
    // });
    // $('#pph4-3-jasa').change(function(){
    //     if($('#pph4-2-jasa').prop('checked') == true){
    //         $('#pph4-2-jasa').prop('checked', false);
    //     }
    //     if($('#pph4-4-jasa').prop('checked') == true){
    //         $('#pph4-4-jasa').prop('checked', false);
    //     }
    // });
    // $('#pph4-4-jasa').change(function(){
    //     if($('#pph4-2-jasa').prop('checked') == true){
    //         $('#pph4-2-jasa').prop('checked', false);
    //     }
    //     if($('#pph4-3-jasa').prop('checked') == true){
    //         $('#pph4-3-jasa').prop('checked', false);
    //     }
    // });
</script>
<script type="text/javascript">
/*--REALLY NOT RECOMMENDED DOING THIS, BUT, OH WELL, HERE GOES--*/
$(document).ready(function(){
    $(".enter-new-field").keypress(function(event) {
        if(event.keyCode == 13) { 
            textboxes = $("input.enter-new-field");
            debugger;
            currentBoxNumber = textboxes.index(this);
            if (textboxes[currentBoxNumber + 1] != null) {
                nextBox = textboxes[currentBoxNumber + 1]
                nextBox.focus();
                nextBox.select();
                event.preventDefault();
                return false 
            }
            else{
                event.preventDefault();
                return false 
            }
        }
    });
})
</script>
@endsection
@extends('rawatinap.layouts.main')
@section('css')

@endsection

@section('title')
Rawat Inap - Medify
@endsection


@section('subtitle')
Cari Pasien
@endsection

@section('content')

<main id="main-container">
    @include('rawatinap.layouts.navbar')
    <div class="container">
        <div class="block">
            <div class="block-content">
                <div class="row">
                    <div class="col-6 full-only"><h5>Daftar Pasien Rawat Inap</h5></div>
                    <div class="col-6 full-only text-right">
                        <a href="javascript:void(0)" class="btn btn-success download_data" style="margin-left: 10px;"><i class="fa fa-download"></i> Download Data</a>
                    </div>
                    <div class="col-12 mobile-block"><h4>Daftar Pasien Rawat Inap</h4></div>
                    <div class="col-12 mobile-block mb-20">
                        <a href="javascript:void(0)" class="btn btn-success download_data" style="width: 100%"><i class="fa fa-download"></i> Download Data</a>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-sm-12 col-xl-4">
                                <div class="form-group">
                                    <select class="js-select2 form-control" id="tipe_pembayaran" style="width: 100%;" data-placeholder="Semua Pembayaran" name="tipe_pembayaran[]" multiple="">
                                        <option value="all" @if($pembayaran_id == "all" || in_array("all", $pembayaran_id)) selected @endif>Semua Pembayaran</option>
                                        @foreach ($tipe_pembayaran as $item)
                                        <option value="{{ $item->id }}" @if(is_array($pembayaran_id) && in_array($item->id, $pembayaran_id)) selected @endif>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-2 pl-0">
                                <a href="javascript:void(0)" class="btn btn-secondary filter_data ml-0" style="margin-left: 10px;"><i class="fa fa-search"></i> Filter</a>
                            </div>

                            <div class="col-sm-12 col-xl-4" style="display: none">
                                <div class="form-group">
                                    <select class="js-select2 form-control" id="tni_keanggotaan" style="width: 100%;" data-placeholder="Semua TNI Keanggotaan">
                                        <option value="all" @if($keanggotaan_id == "all") selected @endif>Semua Keanggotaan</option>
                                        @foreach ($tni_keanggotaan as $item)
                                        <option value="{{ $item->id }}" @if($keanggotaan_id == $item->id) selected @endif>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-4" style="display: none">
                                <div class="form-group">
                                    <select class="js-select2 form-control" id="tni_kotama" style="width: 100%;" data-placeholder="Semua TNI Kotama">
                                        <option value="all" @if($kotama_id == "all") selected @endif>Semua Kotama</option>
                                        <option value="umum" @if($kotama_id == "umum") selected @endif>Umum</option>
                                        <option value="tni" @if($kotama_id == "tni") selected @endif>TNI (Semua Kotama)</option>
                                        @foreach ($tni_kotama as $item)
                                        <option value="{{ $item->id }}" @if($kotama_id == $item->id) selected @endif>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-4" id="tni_satker_div" style="display: none;">
                                <div class="form-group">
                                    <select class="js-select2 form-control" id="tni_satker" style="width: 100%;" data-placeholder="Pilih Satker">
                                        <option value="all" @if($satker_id == "all") selected @endif>Semua Satker</option>
                                        @if($satker_id != 0)
                                        @foreach ($tni_satker as $item)
                                        <option value="{{ $item->id }}" @if($satker_id == $item->id) selected @endif>{{ $item->nama }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-12" id="loading_animation" style="display: none;">
                                <div class="text-center" style="margin: 0 auto;">
                                    <i class="fa fa-4x fa-cog fa-spin text-primary"></i>
                                </div>    
                            </div>

                        </div>
                    </div>
                </div>
                <div class="table-full-width spinner-container" id="pasienResult"> 
                    <div class="spinner-back">
                        <table class="table table-striped table-hover table-pointer dataTable no-footer" id="tabelPasienResult"> 
                            <thead>
                                <tr class="header" ng-click="getCurrentPage()">
                                    <th style="width:3%">No</th>
                                    <th style="width:3%">RM</th>
                                    <th style="width:15%">Nama </th>
                                    <th>Alamat </th>
                                    <th style="width:8%">Jenis Pembayaran</th>
                                    <th style="width:5%; display: none">Kotama</th>
                                    <th style="width:6%; display: none">Satker</th>                                  
                                    <th style="width:12%">Ruangan</th>
                                    <th style="width:3%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $a =1;
                                @endphp
                                @foreach ($transaksi as $row)
                                <tr>
                                    <td class="py-10 px-10">{{$a}}</td>
                                    @php
                                    $a = $a+1;
                                    @endphp
                                    <td class="py-10 px-10">{{$row->pasien['no_rm']}}</td>
                                    <td class="py-10 px-10">{{$row->pasien['name']}}</td>
                                    <td class="py-10 px-10">
                                        {{$row->pasien['address']}}
                                        @if(!empty($row->pasien->alamat_kecamatan))
                                        {{$row->pasien->alamat_kelurahan->nama or '-'}}, {{$row->pasien->alamat_kecamatan->nama or '-'}}, {{$row->pasien->alamat_kota->nama or '-'}}, {{$row->pasien->alamat_kota->provinsi->nama or '-'}}
                                        @endif
                                    </td>
                                    <td class="py-10 px-10">{{$row->kasus->pembayaran->perusahaan['nama']}}</td>
                                    <td class="py-10 px-10 d-none">{{$row->pasien->tni_kotama->nama ?? ''}}</td>
                                    <td class="py-10 px-10 d-none">{{$row->pasien->tni_satker->nama ?? ''}}</td>
                                    <td class="py-10 px-10">{{$row->tempat_tidur->ruangan->bangsal['nama']}} - {{$row->tempat_tidur->ruangan['nama']}} - {{$row->tempat_tidur['nama']}}</td>
                                    <td>
                                        <div class="block-options">
                                            <a href="{{url('kasus')}}/{{$row->kasus['nomor_kasus']}}/datamedis" class="btn btn-sm btn-outline-info js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </div>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table> 
                    </div>
                    <div class="flex-center" style="">
                        <ul id="pagination" class="pagination"></ul>
                    </div>
                </div>

            </div>

        </div>
    </div>

</main>

<form type="GET" action="{{url('rawatinap/cari/download')}}" id="form_download" target="_blank">
    <input type="hidden" id="tipe_pembayaran_form" name="tipe_pembayaran">
    <input type="hidden" id="tni_satker_form" name="tni_satker">
    <input type="hidden" id="tni_kotama_form" name="tni_kotama">
    <input type="hidden" id="tni_keanggotaan_form" name="tni_keanggotaan">    
</form>

@endsection

@section('js')
<script type="text/javascript" src="{{asset('assets\js\jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\js\dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/pages/be_tables_datatables.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function(){
        var kotama_id = $('#tni_kotama').val();
        if (kotama_id != 'all' && kotama_id != 'umum' && kotama_id != 'tni') {
            $("#tni_satker_div").show();
        } else {
            toggleSatker();
        }
    });

    function openConfirmation(id, name) {
        $("#layanan_title").html(name);
        $(".modal-footer").html(`<form action="{{url('radiologi/pengaturan/layanan/delete')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" value="`+id+`" name="to_delete"/>
            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-alt-danger" >
            <i class="fa fa-trash"></i> Hapus
            </button>
            </form>`);
        $("#modalConfirmation").modal('show');
    }
    function toggleSatker() {
        var kotama_id = $('#tni_kotama').val();
        if (kotama_id != 'all' && kotama_id != 'umum' && kotama_id != 'tni') {
            $("#tni_satker").empty();
            $.ajax({
                type: "GET",
                url: API_URL + "/pasien/satker/get/" + kotama_id,
                dataType: "json",
                success: function (data) {
                    var option = [];
                    option.push({
                        id: '',
                        text: '',
                    });
                    option.push({
                        id: 'all',
                        text: 'Semua Satker',
                    });
                    for (i in data) {
                        option.push({
                            id: data[i].id,
                            text: data[i].nama,
                        });
                    }
                    $('#tni_satker').select2({
                        data: option
                    })
                }
            });
            $("#tni_satker_div").show(500);
        } else {
            $("#tni_satker_div").hide(500);
        }
    }

    var oTable = $("#tabelPasienResult").DataTable({
        scrollX: true,
    });

    $(document).on("click", ".edit-button", function(){
        var nama_pelanggan = $(this).data('name');
        var id = $(this).data('id');

        //console.log(id);
        //console.log(val(nama_barang));
        $("#idpelanggan").val(id);
        $("#namapelanggan").val(nama_pelanggan);

        $("#form-edit").attr('action','{{url('/rekammedis/tolak')}}');
    });

    $(document).on("click", ".submit-button", function(){
        var nama_pelanggan = $(this).data('name');
        var id = $(this).data('id');

        //console.log(id);
        //console.log(val(nama_barang));
        $("#idpasien").val(id);
        $("#namapasien").val(nama_pelanggan);

        $("#hakim").attr('href','{{url('/rekammedis/permintaan/')}}'  + '/' + id  +'/kirimpermintaan');
    });

    var pembayaran_id = $("#tipe_pembayaran").val();
    var keanggotaan_id = $("#tni_keanggotaan").val();
    var satker_id = $("#tni_satker").val();
    var kotama_id = $("#tni_kotama").val();
    
    $('.download_data').on('click', function()
    {   
        $('#tipe_pembayaran_form').val(pembayaran_id);
        $('#tni_satker_form').val(satker_id);
        $('#tni_kotama_form').val(kotama_id);
        $('#tni_keanggotaan_form').val(keanggotaan_id);
        $('#form_download').submit();
    });

    $(".filter_data").on('click', function(){
        var url =`{{url()->current()}}?tipe_pembayaran=${pembayaran_id}&tni_kotama=${kotama_id}&tni_satker=${satker_id}&tni_keanggotaan=${keanggotaan_id}`;
        window.location.href = url;        
    })

    $("#tipe_pembayaran").on('change', function(){
        // $('#loading_animation').show();
        pembayaran_id = $(this).val();
        keanggotaan_id = $('#tni_keanggotaan').val();
        satker_id = $('#tni_satker').val();
        kotama_id = $('#tni_kotama').val();
    });

    $("#tni_keanggotaan").on('change', function(){
        keanggotaan_id = $(this).val();
        // $('#loading_animation').show();
        $("#tni_satker_div").hide(500);
        kotama_id = $('#tni_kotama').val();
        pembayaran_id = $("#tipe_pembayaran").val();
        satker_id = 'all';
    });

    $("#tni_kotama").on('change', function(){
        kotama_id = $(this).val();
        keanggotaan_id = $('#tni_keanggotaan').val();
        if (kotama_id == 'all' || kotama_id == 'umum' || kotama_id == 'tni') {
            // $('#loading_animation').show();
            $("#tni_satker_div").hide(500);
            pembayaran_id = $("#tipe_pembayaran").val();
            satker_id = 'all';
        } else {
            toggleSatker();
        }
    });

    $("#tni_satker").on('change', function(){
        // $('#loading_animation').show();
        pembayaran_id = $("#tipe_pembayaran").val();
        keanggotaan_id = $('#tni_keanggotaan').val();
        satker_id = $(this).val();
        kotama_id = $('#tni_kotama').val();
    });

</script>
@endsection
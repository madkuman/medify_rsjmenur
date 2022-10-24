@extends('farmasi.layouts.main')

@section('title')
Farmasi Detail Transaksi Kemoterapi
@endsection

@section('css')
	<style type="text/css">
	    .bordered {
	        border-bottom: 1px solid #eaecee;
	    }
	    .modal-content {
	        border-radius: 0;
	    }
	    .modal-lg {
	        max-width: 80% !important;
	    }
	    .no-border {
	        border-top: 0 !important;
	        border-right: 0 !important;
	        border-left: 0 !important;
	        border-bottom: 0;
	        border-radius: 0 !important;
	    }
	    .editable-click {
	        border-bottom: dashed 1px #0088cc;
	    }    
	</style>
@endsection

@section('content')
<div class="block">
    <div class="block-content bordered">
        <div class="row">
            <h3 class="block-title col-lg-5 col-12">Transaksi #0000055836</h3>
            <div class="col-lg-7 col-12">
                <form method="POST" action="">
                    {{csrf_field()}}
                </form>

                {{-- @if(!empty($transaksi->kasus_detail))
                <div class="btn-group pull-right" role="group">
                    <button type="button" onclick="historiResep()" class="btn btn-warning btn-square mr-5 mb-5" ><i class="fa fa-loop"></i> Histori Resep</button>
                </div>
                @endif --}}
                <div class="btn-group pull-right" role="group">

                    <button type="button" class="btn btn-alt-primary btn-square dropdown-toggle mr-5 mb-5" id="page-header-options-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Menu
                    </button>

                    <div class="dropdown-menu" aria-labelledby="page-header-options-dropdown">
                        <a class="dropdown-item" href="">
                            <i class="fa fa-copy" aria-hidden="true"></i>&nbsp;&nbsp;Buat Copy Resep
                        </a>
                        <a class="dropdown-item alih-resep" style="cursor: pointer;">
                            <i class="fa fa-arrows" aria-hidden="true"></i>&nbsp;&nbsp;Alih Resep
                        </a>
                        <a class="dropdown-item confirm-del" style="cursor: pointer;">
                            <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                        </a>
                        <a class="dropdown-item" href="">
                            <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                        </a>
                        {{-- @if($transaksi->status)
                        <a class="dropdown-item" id="btn-resep" style="cursor: pointer;">
                            <i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Resep Original
                        </a>
                        <a class="dropdown-item" id="btn-retur" style="cursor: pointer;">
                            <i class="fa fa-sync" aria-hidden="true"></i>&nbsp;&nbsp;Retur
                        </a>
                        @endif --}}
                        {{-- @if(session('farmasi')->consis && $transaksi->status != 1)
                        <a class="dropdown-item" id="btn-consis" style="cursor: pointer;">
                            <i class="fa fa-sync" aria-hidden="true"></i>&nbsp;&nbsp;Ambil di Consis
                        </a>
                        @endif --}}
                    </div>
                </div>

                <div class="btn-group pull-right" role="group">
                    <button type="button" class="btn btn-alt-warning btn-square dropdown-toggle mr-5 mb-5" id="page-header-options-dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak
                    </button>

                    <div class="dropdown-menu" aria-labelledby="page-header-options-dropdown2">
                        {{-- @if($transaksi->status)
                        <a class="dropdown-item" id="btn-print-nota" style="cursor: pointer;">
                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Nota
                        </a>
                        @if($transaksi->status_retur)
                        <a class="dropdown-item" id="btn-print-nota-retur" style="cursor: pointer;">
                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Nota Retur
                        </a>
                        @endif
                        <a class="dropdown-item" id="btn-print-kwitansi" style="cursor: pointer;">
                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Kwitansi
                        </a>
                        @endif --}}
                        <a href="{{url('farmasi/'.session('farmasi')->slug.'/print-kemo')}}" class="dropdown-item" target="_blank">
                            <i class="fa fa-print mr-2" aria-hidden="true"></i> Cetak Label Obat
                        </a>
                        <a class="dropdown-item" href="{{url('farmasi/'.session('farmasi')->slug.'/print-label-kemo')}}" target="_blank">
                            <i class="fa fa-print mr-2" aria-hidden="true"></i> Cetak Resep
                        </a>
                        {{-- @if(!$transaksi->transaksi_asal_id)
                        <a class="dropdown-item" id="btn-print-resep" style="cursor: pointer;" target="_blank">
                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Resep
                        </a>
                        <a class="dropdown-item" id="btn-print-resep-format-dokter" style="cursor: pointer;" target="_blank">
                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Resep Format Dokter
                        </a>
                        @else
                        <a class="dropdown-item" href="" target="_blank">
                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak Copy Resep
                        </a>
                        @endif --}}
                    </div>
                </div>
                <div class="btn-group pull-right" role="group">
                    {{-- @if(empty($transaksi->dikerjakan_at)) --}}
                    <a href="" class="btn btn-secondary btn-square mr-5 mb-5"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;Dikerjakan</a>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>

    <div class="block-content">
        <div class="block block-transparent">
            <div class="row">
                <div class="col-md-5">
                    <div style="border: 1px solid #eaecee; width: 250px;  padding: 10px;">
                      <div class="font-size-lg text-black mb-5">
                        <strong>hari febrian</strong>
                    </div>
                    <address>
                        Laki-Laki , 5 Tahun <br>
                        Alamat : Surabaya <br>
                        Tgl Lahir : 1 January 2014 <br>
                        #628840 <br>
                    </address>
                </div>
            </div>
            <div class="col-md-3">
              <label>Metode Pembayaran</label>
              <h5>
                Tunai - Kelas 1
            </h5>
            <label>No Sep</label>
            <h5>-</h5>
        </div>
        <div class="col-md-3">
            <label>Asal Pelayanan</label>
            <h5>Poli Poli Akunpuntur</h5>
            <label>Penulis Resep</label>
            <h5>SuperAdmin</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <button type="button" class="btn btn-alt-warning btn-square" id="btn-penunjang">
                <i class="far fa-file mr-2" aria-hidden="true"></i> Daftar Penunjang
            </button>                        
        </div>
        <div class="col-md-3">
            <label>Keterangan</label>
            <h6>
                -
            </h6>
        </div>
        <div class="col-md-3">
            <label>Sisa Plafon</label>
            <h5>-</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label>Dokter</label>
            <h5>SuperAdmin</h5>
        </div>
    </div>

    {{-- <div class="row">
        @php $i=1 @endphp
        @foreach($transaksi->copy_resep as $copy)
        <div class="col">
            <a href="" class="btn  btn-square">
                <i class="fa fa-copy" aria-hidden="true"></i>&nbsp;&nbsp;Copy Resep 1
            </a>
        </div>
        @endforeach
    </div> --}}
</div>

<form method="POST" action="">
    {{csrf_field()}}
    <hr class="my-5">

    <div class="block-header bordered">
        <h3 class="block-title">Resep 1010201900001</h3>
    </div>

    <div class="autoscroll-x">
        <table class="table table-vcenter">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Obat</th>
                    <th>Dosis</th>
                    <th>Jml Amp/Vial</th>
                    <th>Nama & Vol. Infus</th>
                    <th>Harga Jual</th>
                    <th>Laba</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td>1</td>
                    <td>Mesna</td>
                    <td>400 mg</td>
                    <td>2</td>
                    <td>NaCl 500</td>
                    <td>Rp. 100.000</td>
                    <td>
                    	<input type="number" class="form-control input-diskon d-none" name="laba[]" value="" placeholder="Diskon">
                    	<a href="javascript:void(0)" class="no-border editable editable-click">10 %</a>
                    </td>
                    <td>Rp. 110.000</td>
                </tr>

                <tr>
                    <td colspan="7" class="text-right font-w600">SUBTOTAL :</td>
                    <td class="text-right" id="subtotal-harga">Rp. 100.000</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right font-w600">EMBALASE :</td>
                    <td class="text-right">
                        <input type="number" value="0" class="form-control input-embalase d-none" id="embalase" name="embalase" placeholder="Embalase">
                        <a href="javascript:void(0)" class="no-border editable editable-embalase-click">
                        	Rp 10.000
                        </a>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="7" class="text-right font-w600">TOTAL RETUR:</td>
                    <td class="text-right">Rp. 100.000</td>
                </tr>
                
                <tr>
                    <td colspan="7" class="text-right font-w600">TOTAL BIAYA :</td>
                    <td class="text-right" id="total-harga">Rp. 200.000</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right font-w600">TOTAL PEMBAYARAN PASIEN :</td>
                    <td class="text-right">Rp. 100.000</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right font-w600">KEMBALI :</td>
                    <td class="text-right">Rp. 100.000</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right font-w600">Total 7 HARI:</td>
                    <td class="text-right" id="subtotal-harga">Rp. 100.000</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-30 ">
        <div class="form-group row">
            <div class="col-12">
                <button type="button" class="btn btn-primary btn-square float-right" id="btnConfirm">
                    Konfirmasi Pesanan
                </button>
            </div>
        </div>
    </div>

    {{-- @if($transaksi->status == 1)
    <img src="{{asset('assets/img/paid_stamp.png')}}" width="170" style="position: relative; top: -170px; left: 20px;">
    @elseif($transaksi->status == 0)
    <div class="mt-30 ">
        <div class="form-group row">
            <div class="col-12">
                <button type="button" class="btn btn-primary btn-square float-right" id="btnConfirm">
                    Konfirmasi Pesanan
                </button>
            </div>
            @if($fyi) 
            <div class="col-12">
                <div class="bg-warning float-right">*Pasien ini telah melakukan transaksi hari ini</div>
            </div>
            @endif
        </div>
    </div>
    @endif
	
	@if($retur)
	<div class="block">
	    <div class="block-header bordered">
	        <h3 class="block-title">Retur</h3>
	    </div>
	    <div class="block-content">
	        <div class="block block-transparent">
	            <table class="table table-vcenter">
	                <thead>
	                    <tr>
	                        <th width="50px">No.</th>
	                        <th width="200px">Barang</th>
	                        <th width="80px">Jumlah</th>
	                        <th width="150px" class="text-right">Harga Jual</th>
	                        <th width="150px" class="text-right">Potongan</th>
	                        <th width="150px" class="text-right">Subtotal</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    @php $i=0 @endphp
	                    @foreach($transaksi->final_detail->resep_detail as $detail)
	                    @foreach($detail->log as $log)
	                    @if(!is_null($log->jumlah_retur))
	                    <tr>
	                        <td>{{++$i}}</td>
	                        <td>{{$detail->nama_obat}}</td>
	                        <td>{{$log->jumlah_retur}} {{$detail->satuan}}</td>
	                        <td class="text-right">Rp. {{number_format($detail->harga)}}</td>
	                        <td class="text-right">{{$log->potongan}}%</td>
	                        <td class="text-right">Rp. {{number_format($log->subtotal_retur)}}</td>
	                    </tr>
	                    @endif
	                    @endforeach
	                    @endforeach
	                    <tr>
	                        <td colspan="5" class="text-right font-w600">TOTAL RETUR :</td>
	                        <td class="text-right">Rp. {{number_format($transaksi->total_retur)}}</td>
	                    </tr>
	                    <tr>
	                        <td colspan="5" class="text-right font-w600">TOTAL BIAYA AKHIR:</td>
	                        <td class="text-right" id="total-harga">Rp. {{number_format($transaksi->total_biaya_obat)}}</td>
	                    </tr>
	                </tbody>
	            </table>    
	        </div>
	    </div>
	</div>
	@endif

	@include('farmasi.transaksi.modals.modal-normal') --}}
</form>

{{-- @include('farmasi.transaksi.modals.modal-alih')
@include('farmasi.transaksi.modals.modal-normal')
@include('farmasi.transaksi.modals.modal-penunjang')
@include('farmasi.transaksi.modals.modal-print-analisa-resep')
@include('farmasi.transaksi.modals.modal-print-kwitansi')
@include('farmasi.transaksi.modals.modal-print-nota')
@include('farmasi.transaksi.modals.modal-print-nota-retur')
@include('farmasi.transaksi.modals.modal-print-resep-dokter')
@include('farmasi.transaksi.modals.modal-print-resep')
@include('farmasi.transaksi.modals.modal-resep')
@include('farmasi.transaksi.modals.modal-consis') --}}

@endsection

@section('js')
	{{-- @include('farmasi.transaksi.modals.components.dokter-js')
	<script type="text/javascript">
	    $('#select-farmasi').select2();
	    $('.alih-resep').on('click', function(){
	        $('#modal-alih').modal('show');
	    });
	    var flag = "{{$flag}}";
	    var idx = "{{$i}}";
	    var status = "{{$transaksi->status}}";
	    var kasus = "{{is_null($transaksi->kasus_id)}}";
	    var bulat = "{{!is_null(session('farmasi')->pembulatan)}}";
	    var stok_kurang_confirm = "{{!is_null(session('farmasi')->stok_kurang_confirm)}}";
	    var cash = "{{is_null(session('farmasi')->cash)}}";
	    $(document).ready(function(){
	        if(status==0) changeTotal();
	        if(status==1) changeRetur();
	        if(kasus) $('#input-tagihan').hide();
	        if(cash && ! $('#status_pembayaran').is(":checked")) {
	            $('#input-bayar').show();
	            $('#btn-simpan').attr('disabled', true);
	        }else{
	            $('#input-bayar').hide();
	            $('#btn-simpan').attr('disabled', false);
	        }
	        if(!status)
	            changePembayaran();
	    });
	    if(flag > 0 && !stok_kurang_confirm) $('#btnConfirm').attr('disabled', true);
	    else $('#btnConfirm').attr('disabled', false);

	    $('#btnConfirm').on('click', function(){
	        $('#modal-normal').modal('show');
	    });

	    $('#dibayar').on('keyup', function(){
	        var dibayar = parseFloat($(this).val());
	        var total = parseFloat($('#total').val());
	        console.log(dibayar);
	        if (dibayar < total || isNaN(dibayar)) {
	            $('#btn-simpan').attr('disabled', true);
	        } else {
	            $('#btn-simpan').attr('disabled', false);
	        }
	    });

	    $('#btn-resep').on('click', function(){
	        $('#modal-resep').modal('show');
	    });

	    $('#btn-analisa-resep').on('click', function(){
	        $('#modal-analisa-resep').modal('show');
	    });

	    $('#btn-penunjang').on('click', function(){
	        $('#modal-penunjang').modal('show');
	    });

	    $('#btn-print-nota').on('click', function(){
	        $('#modal-print-nota').modal('show');
	    });

	    $('#btn-print-nota-retur').on('click', function(){
	        $('#modal-print-nota-retur').modal('show');
	    });

	    $('#btn-print-kwitansi').on('click', function(){
	        $('#modal-print-kwitansi').modal('show');
	    });

	    $('#btn-print-resep').on('click', function(){
	        $('#modal-print-resep-{{$transaksi->id}}').modal('show');
	    });

	    $('#btn-print-resep-format-dokter').on('click', function(){
	        $('#modal-print-resep-format-dokter').modal('show');
	    });

	    $('#btn-retur').on('click', function(){
	        $('#modal-retur').modal('show');
	    });

	    $('#btn-consis').on('click', function(){
	        $('#modal-consis').modal('show');
	    });

	    $('.confirm-del').on('click', function(){
	        var deleteSupp = $(this).parent().parent().parent().find('form');
	        console.log(deleteSupp);
	        swal({
	            title: 'Apa anda yakin?',
	            text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
	            type: 'warning',
	            showCancelButton: true,
	            confirmButtonColor: '#d26a5c',
	            confirmButtonText: 'Hapus',
	            html: false,
	            preConfirm: function() {
	                return new Promise(function (resolve) {
	                    setTimeout(function () {
	                        resolve();
	                    }, 50);
	                });
	            }
	        }).then(function(result){
	            if (result.value) {
	                deleteSupp.submit();
	                    //swal('Berhasil', 'Data berhasil dihapus.', 'success');
	                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
	                } else if (result.dismiss === 'cancel') {
	                    swal('Batal', 'Hapus data dibatalkan.', 'error');
	                }
	            });
	    });

	    $('.editable-click').on('click', function(e){
	        e.preventDefault();
	        var $this = $(this);
	        var inputDiskon = $this.parent('td').find('input.input-diskon');

	        setTimeout(function(){
	            inputDiskon.focus();
	        });

	        $this.addClass('d-none');
	        inputDiskon.removeClass('d-none');
	        _onChangeDisc(inputDiskon);
	    });
	    $('.editable-embalase-click').on('click', function(e){
	        e.preventDefault();
	        var $this = $(this);
	        var inputEmbalase = $this.parent('td').find('input.input-embalase');

	        setTimeout(function(){
	            inputEmbalase.focus();
	        });

	        $this.addClass('d-none');
	        inputEmbalase.removeClass('d-none');
	        _onChangeEmbalase(inputEmbalase);
	    });

        /*function changeSubtotal(index) {
            harga_beli = parseInt($('#harga-beli-'+index).text());
            jumlah = parseInt($('#jumlah-'+index).text());
            diskon = $('#diskon-'+index).val();
            harga_jual = harga_beli + (harga_beli * diskon / 100);
            $('#harga-'+index).text(harga_jual);
            subtotal = harga_jual * jumlah;
            $('#subtotal-'+index).text(subtotal);
            changeTotal();
        }*/

        function changePembayaran() {
            ran = $('#status_pembayaran').is(":checked");
            if(ran) {
                $('#input-bayar').addClass('d-none');
                $('#input-bayar').hide();
                $('#dibayar').val(0);
                $('#btn-simpan').attr('disabled', false);
            }
            else {
                $('#input-bayar').removeClass('d-none');
                $('#input-bayar').show();
                $('#dibayar').val(0);
                $('#btn-simpan').attr('disabled', true);
            }
            changeTotal();
        }

        function changeTotal() {
            total = 0;
            ran = $('#status_pembayaran').is(":checked");
            for(i=1; i<=idx; i++)
            {
                if($('#racik-'+i).length)
                {
                    subtotal = 0;
                    racik = parseInt($('#racik-'+i).text());
                    for(j=0; j<racik; j++)
                    {
                        harga_beli = parseInt($('#harga-beli-'+i+'-'+j).text());
                        jumlah = parseFloat($('#jumlah-'+i+'-'+j).text());
                        //console.log(harga_beli);
                        diskon = $('#diskon-'+i).val();
                        harga_racikan = harga_beli + (harga_beli * diskon / 100);
                        subtotal += harga_racikan * jumlah;              
                    }
                    harga_jual = subtotal/parseFloat($('#jumlah-'+i).text());
                }
                else
                {
                    harga_beli = parseInt($('#harga-beli-'+i).text());
                    jumlah = parseFloat($('#jumlah-'+i).text());
                    diskon = $('#diskon-'+i).val();
                    harga_jual = harga_beli + (harga_beli * diskon / 100);
                    $('#harga-'+i).text(formatMoney(harga_jual));
                    subtotal = harga_jual * jumlah;
                }
                subtotal = Math.ceil(subtotal)
                $('#harga-'+i).text(formatMoney(harga_jual));
                $('#subtotal-'+i).text(formatMoney(subtotal));
                total += subtotal;
            }
            $('#subtotal-harga').text(formatMoney(total));
            var final_subtotal = total;
            if(!ran && bulat) total = Math.ceil(total/1000)*1000;

            var embalase_before = parseInt($('#embalase').val());
            console.log(embalase_before)
            embalase_before = Math.ceil(embalase_before/1000)*1000;
            if(embalase_before > 1000) embalase_before = embalase_before - 1000;
            if(embalase_before < 1000) embalase_before = embalase_before;
            console.log(embalase_before)   

            total += embalase_before

            var embalase = total - final_subtotal;
            $('#embalase').val(embalase)
            $('.editable-embalase-click').text(formatMoney(embalase));
            $('#total-harga').text(formatMoney(total));
            $('#total-bayar').text(formatMoney(total));
            $('#total').val(total);
        }

        function changeRetur() {
            total = 0;
            index = "{{$j}}";
            for(i=1; i<=index; i++)
            {
                harga_jual = parseInt($('#harga-jual-'+i).text());
                jumlah = $('#jumlah-retur-'+i).val();
                diskon = $('#diskon-retur-'+i).val();
                subtotal = harga_jual * jumlah;
                subtotal -= subtotal * diskon / 100;
                console.log(harga_jual,jumlah,diskon,subtotal);
                $('#subtotal-retur-'+i).text(formatMoney(subtotal));
                total += subtotal;
            }
            if(bulat) total = Math.ceil(total/1000)*1000;
            $('#total-retur').text(formatMoney(total));
        }

        function _onChangeDisc(input) {
            input.on('change', function(){                
                var $this = $(this);
                var valDiskon = $this.val();
                var txtDiskon = $this.parent('td').find('.editable');
                var satuan = $this.parent('td').find('.satuan').val();
                if(satuan == undefined) satuan = '%';

                if ($.isNumeric(valDiskon)) {
                    valDiskon = $this.val();
                } else {
                    valDiskon = 0;
                    $this.val(valDiskon);
                }

                $this.addClass('d-none');
                txtDiskon.removeClass('d-none');
                txtDiskon.html(valDiskon+' '+satuan);
            });

            input.on('blur', function(){
                var $this = $(this);
                var txtDiskon = $this.parent('td').find('.editable');

                $this.addClass('d-none');
                txtDiskon.removeClass('d-none');
            });
        }

        function _onChangeEmbalase(input) {
            input.on('change', function(){                
                var $this = $(this);
                var valEmbalase = $this.val();
                var txtEmbalase = $this.parent('td').find('.editable');
                var satuan = $this.parent('td').find('.satuan').val();
                if(satuan == undefined) satuan = '';

                if ($.isNumeric(valEmbalase)) {
                    valEmbalase = $this.val();
                } else {
                    valEmbalase = 0;
                    $this.val(valEmbalase);
                }

                $this.addClass('d-none');
                txtEmbalase.removeClass('d-none');
                txtEmbalase.html('Rp '+valEmbalase+' '+satuan);
            });

            input.on('blur', function(){
                var $this = $(this);
                var txtEmbalase = $this.parent('td').find('.editable');

                $this.addClass('d-none');
                txtEmbalase.removeClass('d-none');
            });
        }
        @if(!empty($transaksi->kasus_detail))
        function historiResep()
        {
            window.open(
                "{{url('kasus')}}/{{$transaksi->kasus_detail->nomor_kasus}}/datamedis/resep/view-histori","popUpWindow",
                "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
        }
        @endif


        // $( "form" ).submit(function( event ) {
        //     setTimeout(
        //       function() 
        //       {
        //         location.reload();
        //     }, 1000);
        // });
        $('#btn-cetak-nota-2').on('click',function(){
           var $this = $(this).parents('form');
           $this.unbind('submit').submit();
       });
        $('#btn-cetak-nota-retur').on('click',function(){
           var $this = $(this).parents('form');
           $this.unbind('submit').submit();
       });
        $('#btn-cetak-kwitansi-2').on('click',function(){
           var $this = $(this).parents('form');
           $this.unbind('submit').submit();
       });
   	</script> --}}
@endsection
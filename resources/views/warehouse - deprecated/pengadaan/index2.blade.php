@extends('warehouse.layouts.main')

@section('title')
Gudang Penerimaan
@endsection

@section('css')
<style type="text/css">
    #modal-large {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }
    .modal-full {
        min-width: 100%;
        margin: 0 !important
    }
</style>
@endsection

@section('content')
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Penerimaan</h3>
            <div class="block-options">
                <button type="submit" class="btn btn-sm btn-primary btn-square" id="new">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Penerimaan Baru
                </button>
                {{-- <a href="{{url('gudang/transaksi/buat-racikan')}}" class="btn btn-sm btn-secondary btn-square">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Racikan
                </a> --}}
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                    <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
                </button>
                <div class="d-none" id="filter-data">
                    <form method="POST" action="{{url('gudang/pengadaan')}}" id="formFilter">
                        {!!csrf_field()!!}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">PENYEDIA </label>
                                    <select class="js-select2 form-control mt-2" id="cari-peyedia-select2" name="cari_penyedia" style="width: 100%;" data-placeholder="Cari Penyedia">
                                        <option></option>
                                        @foreach($supplier as $supp)
                                            <option value="{{$supp->id}}" {{($supp->id == $cari_penyedia) ? "selected" : ""}}>{{$supp->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">TANGGAL </label>
                                    <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" value="{{$tanggal_awal}}" autocomplete="off">
                                    <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" value="{{$tanggal_akhir}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">NILAI PENERIMAAN </label>
                                    <input type="number" class="form-control" name="harga_minimal" placeholder="Harga Minimal" id="harga_minimal" value="{{$harga_minimal}}">
                                    <input type="number" class="form-control mt-2" name="harga_maksimal" placeholder="Harga Maksimal" id="harga_maksimal" value="{{$harga_maksimal}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">NO. FAKTUR </label>
                                    <input type="text" class="form-control mt-2" name="no_faktur" placeholder="Nomor Faktur" id="no_faktur" value="{{$no_faktur}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">NO. SURAT JALAN</label>
                                    <input type="text" class="form-control mt-2" name="no_surat" placeholder="Nomor Surat Jalan" id="no_surat" value="{{$no_surat}}">
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Tutup</button>
                                <span>&nbsp;</span>
                                <button type="button" class="btn btn-warning btn-square" id="btnReset">Reset</button>
                                <span>&nbsp;</span>
                                <button type="submit" class="btn btn-primary btn-square">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <table class="table table-hover table-vcenter" id="pengadaan">
                <thead>
                    <tr>
                        <th width="30px">ID</th>
                        <th width="150px">Penyedia</th>
                        <th width="120px">Tanggal</th>
                        <th width="150px">Nilai Penerimaan</th>
                        <th width="150px">Nomor Faktur</th>
                        <th width="150px">Nomor Surat Jalan</th>
                        <th width="150px">Keterangan</th>
                        <th width="80px">Detail</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    
@endsection

@section('css')
    <style type="text/css">
    .modal-content {
        border-radius: 0;
    }
    /*.modal-lg {
        max-width: 80% !important;
    }*/
    .modal-full {
        min-width: 100%;
        margin: 0;
    }

    .modal-full .modal-content {
        min-height: 100vh;
    }
    .clickable-row {
        cursor: pointer;
    }
    div.dataTables_wrapper div.dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;
        margin-left: -100px;
        margin-top: -26px;
        text-align: center;
        padding: 1em 0;
    }
    .panel-default {
        border-color: #eaecee !important;
    }
    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    </style>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
    <script type="text/javascript">
        var max_jumlah = [];
        var validation = null;
        $(document).ready(function(){
            $('.money').mask('000.000.000.000.000', {reverse: true});
            checkValidDate();
            validation = validateForm();
            var penyedia = $('#cari-peyedia-select2').val();
            var tanggal_awal = $('#tanggal_awal').val();
            var tanggal_akhir = $('#tanggal_akhir').val();
            var harga_minimal = $('#harga_minimal').val();
            var harga_maksimal = $('#harga_maksimal').val();

            if (penyedia == "" && tanggal_awal == "" && tanggal_akhir == "" && harga_minimal == "" && harga_maksimal == "") {
                $('#filter-data').addClass('d-none');
                $('#btnFilter').removeClass('d-none');
            } else {
                $('#filter-data').removeClass('d-none');
                $('#btnFilter').addClass('d-none');
                $('#pengadaan_wrapper').addClass('mt-50');
            }
        });

        $('#new').on('click', function(){
            $('#modal-large').modal('show');
        });

        $('#close').on('click', function(){
            $('#modal-large').modal('hide');
        });

        $('#peyedia-select2').select2();
        $('#barang-select2-1').select2({
            ajax: {
                url: API_URL+"/gudang/item/get",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Barang",
            templateResult: formatBarang,
            templateSelection: formatBarangSelection
        });
        $('#cari-peyedia-select2').select2();
        $('#datepicker1').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy',
        }).datepicker('setDate', 'today');
        $('.tanggal-datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy',
        });

        var table = $('#pengadaan').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            ordering: false,
            autoWidth: false,
            // dom: 'tr<"bottom"ilp><"clear">',
            language: {
                processing: '<div class="panel panel-default"><i class="fa fa-4x fa-asterisk fa-spin text-info"></i></div>'
            },
            ajax: {
                url: "{{ url('/gudang/pengadaan/load-data') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {
                    penyedia : function() {
                        return $('#cari-peyedia-select2').val();
                    },
                    tanggal_awal : function() {
                        return $('#tanggal_awal').val();
                    },
                    tanggal_akhir : function() {
                        return $('#tanggal_akhir').val();
                    },
                    harga_minimal : function() {
                        return $('#harga_minimal').val();
                    },
                    harga_maksimal : function() {
                        return $('#harga_maksimal').val();
                    },
                    no_faktur : function() {
                        return $('#no_faktur').val();
                    },
                    no_surat : function() {
                        return $('#no_surat').val();
                    }
                }
            }
        });

        datepicker();

        function datepicker() {
            $('.datepicker').datepicker({
                // startDate: "today",
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
            });
        }
        
        counter = 1;
        $('#btnSimpan').on('click', function(e){
            console.log($('.item-row'));
            if($('.item-row').length == 0){
                e.preventDefault();
            }

        });

        $('#btnAddItems').on('click', function(){
            str = `<div class="row item-wrapper gutters-tiny item-row">
                <div class="col-md-2">
                    <div class="form-group">
                        ${counter == 1 ? '<label>Barang</label>' : ''}
                        <h1 id="harga-hid-`+counter+`" hidden></h1>
                        <div>
                            <select class="js-select2 form-control" id="barang-select2-`+counter+`" name="barang[]"  style="width: 100%;">
                                <option value="">Cari Barang</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        ${counter == 1 ? '<label>Jumlah</label>' : ''}
                        <div>
                            <input type="text" class="form-control" id="jumlah-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="jumlah[]" placeholder="Jumlah" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        ${counter == 1 ? '<label>Diskon</label>' : ''}
                        <div>
                            <input type="number" class="form-control" id="diskon-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="diskon[]" placeholder="Diskon" value="0" step=".001">
                        </div>
                    </div>
                </div>
{{--
                <div class="col-md-1">
                    <div class="form-group">
                        ${counter == 1 ? '<label>PPN</label>' : ''}
                        <div>
                            <input type="number" class="form-control" id="ppn-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="ppn[]" placeholder="PPN" value="10">
                        </div>
                    </div>
                </div>
--}}                
                <div class="col-md-2">
                    <div class="form-group">
                        ${counter == 1 ? '<label>Subtotal</label>' : ''}
                        <input type="text" class="form-control money" id="subtotal-`+counter+`" name="subtotal[]" placeholder="Subtotal" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        ${counter == 1 ? '<label>Harga Satuan</label>' : ''}
                        <input type="text" class="form-control" name="harga_satuan[]" id="harga-`+counter+`" onchange="changeSubtotal(`+counter+`)" placeholder="Harga Satuan">
                        <p id="harga-lama-`+counter+`"></p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        ${counter == 1 ? '<label>Kadaluarsa</label>' : ''}
                        <div>
                            <input type="text" class="js-datepicker form-control datepicker" name="expired[]" placeholder="Tanggal Expired" autocomplete="off">
                            <p class="text-warning txt-date"></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        ${counter == 1 ? '<label>Batch</label>' : ''}
                        <div>
                            <input type="text" class="form-control" name="batch[]" placeholder="Batch" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        ${counter == 1 ? '<label>&nbsp;</label>' : ''}
                        <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>`;
            $('#newItem').append(str);
            $('#barang-select2-'+counter).select2({
                ajax: {
                    url: API_URL+"/gudang/item/get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) 
                    {
                        return {
                            keyword: params.term,
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) { return markup; },
                minimumInputLength: 3,
                placeholder: "Cari Barang",
                templateResult: formatBarang,
                templateSelection: formatBarangSelection
            });
            datepicker();
            removeItem();
            checkValidDate();
            // $('.money').mask('000.000.000.000.000', {reverse: true});
            // changeSubtotal(counter);
            $('.money').mask('000.000.000.000.000', {reverse: true});
            datepicker();
            checkValidDate();
            $('#peyedia-select2').val(po.perusahaan_id).trigger('change');
            counter++;
        });
        
        function formatBarang (item) {
            if (item.loading) {
                return item.text;
            }
            var stok = 0;
            if(item.stok)
                stok = item.stok.aggregate;
            var markup = item.nama + " ("+item.satuan+") || Stok = " + stok;

            return markup;
        }

        function formatBarangSelection (item) {
            var stok;
            if(item.nama){
                if(item.stok)
                    stok = item.stok.aggregate;
                else
                    stok = item.stok;
                return item.nama + " ("+item.satuan+") || Stok = " + stok;
            }
            else return item.text;
        }

        function removeItem() {
            $('.btnRemove').on('click', function(){
                var wrapper = $(this).parents('.item-wrapper');
                wrapper.remove();
            });
        }

        $('#newItem').on('select2:select', function (e) {
            var data = e.params.data;
            ide = $(e.target).attr('id');
            ideas = ide.split('-')[2];
            // $('#harga-'+ideas[2]).text(data.harga);
            changeHarga(ideas, data.harga);
        });

        function changeHarga(index, harga) {
            console.log(harga);
            //harga = $('#barang-select2-'+index).find(":selected").data('harga');
            $('#harga-'+index).val(harga);
            $('#harga-lama-'+index).html('Harga Lama : '.harga);
            changeSubtotal(index);
        }

        function changeSubtotal(index) {
            jumlah = $('#jumlah-'+index).val();
            diskon = $('#diskon-'+index).val();
            harga =  $('#harga-'+index).val();
            console.log(index, jumlah, diskon, harga);
            // ppn = $('#ppn-'+index).val();
            subtotal = harga*jumlah;
            harga_diskon = subtotal*(100-diskon)/100;
            // harga_ppn = harga_diskon + harga_diskon*ppn/100;
            // $('#subtotal-'+index).val(harga_ppn);
            $('#subtotal-'+index).val(harga_diskon);
            $('#subtotal-'+index).cleanVal();
            //$('#harga-lama-'+index).html('Harga Lama : 5000');
        }

        $('#btnFilter').on('click', function(){
            $(this).addClass('d-none');
            $(this).parents('.block-content').find('#pengadaan_wrapper').addClass('mt-50');
            $('#filter-data').removeClass('d-none');
        });

        $('#btnCancel').on('click', function(){
            $(this).parents('#filter-data').addClass('d-none');
            $(this).parents('.block-content').find('#pengadaan_wrapper').removeClass('mt-50');
            $('#btnFilter').removeClass('d-none'); 
        });

        $('#btnReset').on('click', function(e) {
            $('#cari-peyedia-select2').val(null).trigger('change');
            $('#tanggal_awal').val(null).trigger('change');
            $('#tanggal_akhir').val(null).trigger('change');
            $('#harga_minimal').val(null).trigger('change');
            $('#harga_maksimal').val(null).trigger('change');
            $('#no_faktur').val(null).trigger('change');
            $('#no_surat').val(null).trigger('change');
            document.getElementById("formFilter").submit();
        });

        function readImage(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var preview = 
                        '<center><img width="150" src="' + e.target.result + '" />'+
                        '<p>' + input.files[0].name + '</p></center>';
                    var previewZone = $(input).parent().parent().find('.preview-zone');
                    var boxZone = $(input).parent().find('.preview-zone').find('.box').find('.box-body').find('.preview-img');
                    previewZone.removeClass('d-none');
                    boxZone.empty();
                    boxZone.append(preview);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function resetImg(e) {
            e.wrap('<form>').closest('form').get(0).reset();
            e.unwrap();
        }

        $('.remove-preview').on('click', function() {
            // var boxZone = $(this).parents('.preview-zone').find('.box-body');
            var previewZone = $(this).parents('.preview-zone');
            var changeImg = $(this).parents('.form-group').find('.change-img');
            // boxZone.empty();
            previewZone.addClass('d-none');
            resetImg(changeImg);
        });

        $('.change-img').change(function() {
            readImage(this);
        });

        function checkValidDate() {
            $('.item-wrapper').on('change', '.datepicker', function(){
                var today = new Date();

                var str = $(this).val();
                var res = str.split('/');
                var expired = res[1]+'/'+res[0]+'/'+res[2];
                var expiredDate = new Date(expired);
                console.log(expiredDate, today);
                if (today > expiredDate) {
                    $(this).parent('div').find('.txt-date').html('Tanggal kurang dari hari ini !');
                } else {
                    $(this).parent('div').find('.txt-date').html('');
                }
            });
        }
    </script>

    <script type="text/javascript">
        function validateForm() {
            if($('#po').val() != "0"){
                jQuery('#keterangan_penerimaan').closest('.form-group').removeClass('is-invalid');
                // jQuery('#keterangan_penerimaan').remove();
            }
            return jQuery('#form-pengadaan').validate({
                ignore: [],
                errorClass: 'invalid-feedback animated fadeInDown',
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    jQuery(e).parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
                },
                success: function(e) {
                    jQuery(e).closest('.form-group').removeClass('is-invalid');
                    jQuery(e).remove();
                },
                rules: {
                    'peyedia': {
                        required: true,
                    },
                    'po': {
                        required: true,  
                    },
                    'barang[]': {
                        required: true,
                    },
                    'jumlah[]': {
                        required: true,
                        max: function(e){
                            max = jQuery(e).data('max');
                            return max;
                        }
                    },
                    'expired[]': {
                        required: true,  
                    },
                    'keterangan':{
                        required: $('#po').val() == "0",
                    }
                },
                messages: {
                    'peyedia': 'Kolom ini wajib diisi',
                    'po': 'Kolom ini wajib diisi',
                    'barang[]': 'Kolom ini wajib diisi',
                    'jumlah[]': 'Kolom ini wajib diisi dan harus < maximal',
                    'expired[]': 'Kolom ini wajib diisi',
                    'keterangan': 'Kolom ini wajib diisi',
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }

        $('#po').on('select2:select', function(e){
            validation.destroy();
            validation = validateForm();
            counter =0;
            if($(this).val() == 0 ){
                $('#loader').show();
                $('#newItem').empty();
                $('#opsional').hide();
                $('#keterangan_po').show();
                return;
            }
            $('#keterangan_po').hide();
            $('#opsional').show();
            $('#loader').hide();
            var id_po = $(this).val();
            $.ajax({
                type: "GET",
                url: API_URL + "/keuangan/po/"+id_po,
                success: function (response) {
                    $('#newItem').empty();
                    counter = 1;
                    var po = JSON.parse(response);
                    max_jumlah=[]
                    for (var i = 0; i < po.detail.length; i++) {
                        var detail = po.detail[i];
                        var processed = (detail.jumlah_processed == null) ? 0 : detail.jumlah_processed;
                        
                        max_jumlah.push(detail.jumlah - processed);
                        var str_po = `<div class="row item-wrapper gutters-tiny item-row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    ${counter == 1 ? '<label>Barang</label>' : ''}
                                    <h1 id="harga-hid-`+counter+`" hidden class="counter">${counter}</h1>
                                    <div>
                                        <select class="form-control" id="barang-select2-`+counter+`" name="barang[]"  style="width: 100%;" readonly="">
                                            <option value="${detail.item_gudang_id}" selected>${detail.deskripsi}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    ${counter == 1 ? '<label>Jumlah</label>' : ''}
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="jumlah-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="jumlah[]" placeholder="Jumlah" value="${detail.jumlah-processed}" data-max="${detail.jumlah-processed}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Max: ${detail.jumlah-processed}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    ${counter == 1 ? '<label>Diskon(%) </label>' : ''}
                                    <div>
                                        <input type="number" class="form-control" id="diskon-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="diskon[]" placeholder="Diskon" value="${detail.diskon}" step=".001" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 d-none">
                                <div class="form-group">
                                    ${counter == 1 ? '<label>PPN(%) </label>' : ''}
                                    <div>
                                        <input type="number" class="form-control" id="ppn-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="ppn[]" placeholder="PPN" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    ${counter == 1 ? '<label>Subtotal</label>' : ''}
                                    <input type="text" class="form-control money" id="subtotal-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="subtotal[]" placeholder="Subtotal" value="${detail.subtotal}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    ${counter == 1 ? '<label>Harga Satuan</label>' : ''}
                                    <input type="text" class="form-control" name="harga_satuan[]" id="harga-`+counter+`" onchange="changeSubtotal(`+counter+`)" placeholder="Harga Satuan" readonly value="${detail.harga}">
                                    <p id="harga-lama-`+counter+`"></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    ${counter == 1 ? '<label>Kadaluarsa</label>' : ''}
                                    <div>
                                        <input type="text" class="js-datepicker form-control datepicker" name="expired[]" placeholder="Tanggal Expired" autocomplete="off">
                                        <p class="text-warning txt-date"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    ${counter == 1 ? '<label>Batch</label>' : ''}
                                    <div>
                                        <input type="text" class="form-control" name="batch[]" placeholder="Batch" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        $('#newItem').append(str_po);
                        $('.money').mask('000.000.000.000.000', {reverse: true});
                        changeSubtotal(counter);
                        $('.money').mask('000.000.000.000.000', {reverse: true});
                        datepicker();
                        checkValidDate();
                        $('#peyedia-select2').val(po.perusahaan_id).trigger('change');
                        counter++;
                    }
                    
                },
                error: function (error) {
                    console.log(error);
                    return;
                }
            });
        });
    </script>
@endsection
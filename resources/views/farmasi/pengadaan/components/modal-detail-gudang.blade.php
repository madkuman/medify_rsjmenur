<div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/pengadaan')}}/edit" id="form-pengadaan">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$pengadaan->id}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Ubah Penerimaan</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Penyedia</label>
                                    <div>
                                        <select class="js-select2 form-control" id="peyedia-select2" name="peyedia" style="width: 100%;" data-placeholder="Pilih Penyedia">
                                            <option></option>
                                            @foreach($supplier as $supp)
                                                <option value="{{$supp->id}}" @if($supp->id == $pengadaan->supplier_id) selected @endif>{{$supp->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Faktur<small> (Opsional)</small></label>
                                    <input type="text" class="form-control" id="penyedia" name="nomor_referensi" value="{{$pengadaan->nomor_referensi}}" placeholder="Isi Nomor Faktur">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Surat Jalan</label>
                                    <input type="text" class="form-control" id="penyedia" name="nomor_surat" value="{{$pengadaan->nomor_surat_jalan}}" placeholder="Isi Nomor Surat Jalan" >
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Sumber Dana</label>
                                    <div>
                                        <select class="js-select2 form-control" id="sumber-dana-select2" name="sumber_dana_id" style="width: 100%;" data-placeholder="Pilih Sumber Dana">
                                            <option></option>
                                            @foreach($sumber_dana as $supp)
                                                <option value="{{$supp->id}}" @if($supp->id == $pengadaan->sumber_dana_id) selected @endif>{{$supp->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Penerimaan</label>
                                    <div>
                                        <input type="text" class="js-datepicker form-control tanggal-datepicker" name="tanggal_transaksi" placeholder="Masukkan Tanggal Penerimaan" value="{{$pengadaan->tanggal ? date('d/m/Y', strtotime($pengadaan->tanggal)) : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Faktur</label>
                                    <div>
                                        <input type="text" class="js-datepicker form-control tanggal-datepicker" name="tanggal_faktur" placeholder="Masukkan Tanggal Faktur" value="{{ $pengadaan->tanggal_faktur ? date('d/m/Y', strtotime($pengadaan->tanggal_faktur)) : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Surat Jalan</label>
                                    <div>
                                        <input type="text" class="js-datepicker form-control tanggal-datepicker" name="tanggal_surat_jalan" placeholder="Masukkan Tanggal Surat Jalan" value="{{ $pengadaan->tanggal_surat_jalan ?  date('d/m/Y', strtotime($pengadaan->tanggal_surat_jalan)) : '' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Katalog</label>
                                    <div>
                                        <select class="js-select2 form-control" id="katalog-select2" name="katalog_id" style="width: 100%;" data-placeholder="Pilih Katalog">
                                            <option></option>
                                            @foreach($katalog as $supp)
                                                <option value="{{$supp->id}}" @if($supp->id == $pengadaan->katalog_id) selected @endif>{{$supp->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                {{-- <div class="form-group d-none">
                                    <label class="col-12" for="example-file-input">Bukti Faktur</label>
                                    <div class="col-12">
                                        <input type="file" id="example-file-input" name="image">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Bukti Faktur</label>
                                    <input type="file" id="inputImg" name="image" class="form-control change-img">
                                    <div class="preview-zone" style="text-align: center;">
                                        <div class="box box-solid">
                                            <div class="box-header with-border" style="border-bottom: 1px solid #dde2ec;">
                                                <div>Preview</div>
                                            </div>
                                            <div class="box-body" style="padding: 20px;">
                                                <div class="pull-right">
                                                    <button type="button" class="btn btn-sm btn-danger remove-preview" title="Tekan untuk menghapus gambar ini"><i class="fa fa-times"></i></button>
                                                </div>
                                                <div class="preview-img"><img width="180" src="{{asset($pengadaan->bukti_nota)}}" /></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Keterangan </label>
                                    <input type="text" class="form-control" name="keterangan" value="{{$pengadaan->keterangan}}" placeholder="Berikan Informasi Lebih">
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">
                        <div class="table-responsive">
                            <table class="table my-0 pengadaan-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="min-width: 210px; position:sticky; left:0px;">Barang</th>
                                        <th class="text-center" style="min-width: 150px">Harga Beli Sebelumnya</th>
                                        <th class="text-center" style="min-width: 100px">Jumlah Besar</th>
                                        <th class="text-center racikan" style="min-width: 100px">Jumlah Kecil</th>
                                        <th class="text-center" style="min-width: 110px">Diskon (%)</th>
                                        <th class="text-center" style="min-width: 140px">PPN (10%)</th>
                                        <th class="text-center" style="min-width: 150px">Harga Per Box</th>
                                        <th class="text-center" style="min-width: 150px">Harga Satuan</th>
                                        <th class="text-center" style="min-width: 150px">Subtotal</th>
                                        <th class="text-center" style="min-width: 150px">Kadaluarsa</th>
                                        <th class="text-center" style="min-width: 150px">Produsen</th>
                                        <th class="text-center" style="min-width: 100px">Batch</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="newItem">
                                    @php
                                        $total_diskon = 0;
                                        $total_belum_ppn = 0;
                                        $total_ppn = 0;
                                        $total = 0;
                                        $row_count = 0;
                                    @endphp

                                    @foreach($pengadaan->log as $key => $row)
@php
$total_diskon += $row->harga_box * $row->jumlah_besar * $row->diskon / 100.0;
$total_belum_ppn += $row->harga_box * $row->jumlah_besar;
$total_ppn += $row->harga_box * $row->jumlah_besar * ($row->ppn) * (100-$row->diskon) /10000.0;
$total += $row->harga_box * $row->jumlah_besar * (100+$row->ppn) * (100-$row->diskon) /10000.0;
@endphp
                                    <tr class="item-row item-wrapper">
                                        @include('farmasi.pengadaan.components.form-add-pengadaan', ['index' => ++$key, 'checked_ppn' => isset($row->ppn) ? 'checked' : '', 'data' => $row])
                                    </tr>
                                    @php($row_count++)
                                    @endforeach
                                </tbody>
                            </table>             
                        </div>
                        <div class="mt-3 mb-3 pb-2" id="loader">
                            <center>
                                <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddItems">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
                            </center>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-auto text-right"><h5 class="mb-5">Total Sebelum PPN</h5></div>
                            <div class="col-md-1 text-right"><h5 class="mb-5">Rp</h5></div>
                            <div class="col-md-2 text-right"><h5 class="mb-5" id="total-belum-ppn">{{formatCurrency($total_belum_ppn, false)}}</h5></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-auto text-right"><h5 class="mb-5">Total Diskon</h5></div>
                            <div class="col-md-1 text-right"><h5 class="mb-5">Rp</h5></div>
                            <div class="col-md-2 text-right"><h5 class="mb-5" id="total-diskon">{{formatCurrency($total_diskon, false)}}</h5></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-auto text-right"><h5 class="mb-5">Total PPN</h5></div>
                            <div class="col-md-1 text-right"><h5 class="mb-5">Rp</h5></div>
                            <div class="col-md-2 text-right"><h5 class="mb-5" id="total-ppn">{{formatCurrency($total_ppn, false)}}</h5></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-auto text-right"><h5 class="mb-5">Total Akhir</h5></div>
                            <div class="col-md-1 text-right"><h5 class="mb-5">Rp</h5></div>
                            <div class="col-md-2 text-right"><h5 class="mb-5" id="total">{{formatCurrency($total, false)}}</h5></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" id="close">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square">
                         <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@section('js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
    counter = '{{$row_count}}' + 1;
    var mapped_detail = JSON.parse('{!! str_replace( "'", "", json_encode($mapped_detail))!!}');
    var validation = null;
    var selected_po = '{!!str_replace( "'", "", json_encode($po_selected)) ?? 'null'!!}';
    var laba_farmasi = {!!session('farmasi')->aturan_harga!!};
    $(document).on('keydown', '#form-pengadaan input', function(e){
        if (e.keyCode == 13) {
            e.preventDefault();
            $('#btnAddItems').trigger('click');
            return false;
        }
    });
    $(document).ready(function(){
        $('#form-pengadaan').on('submit', function(){
            $('.money').unmask();
            return false;
        })
        $('#ppn-all').on('change', function() {
            $('.ppn').each(function(){
                $(this).prop('checked', $('#ppn-all').is(':checked')).trigger('change');
            });
        });
        validation = validateForm();
        $('.money').mask('000.000.000.000.000', {reverse: true});
        $('#peyedia-select2').select2();
        removeItem();
        checkValidDate();
        for(x=1; x<=counter; x++)
        {
            $('#barang-select2-'+x).select2({
                ajax: {
                    url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
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
        }
    });
    
    $('#newItem').on('select2:select', '.barang-select', function (e) {
        var data = e.params.data;
        ide = $(e.target).attr('id');
        ideas = ide.split('-')[2];
        changeHarga(ideas, data.harga);
    });

    function changeHarga(index, harga) {
        console.log(harga);
        // $('#harga-'+index).val(harga);
        // $('#harga-lama-'+index).html('Harga Lama : '.harga);
        // changeSubtotal(index);
        
        //1 bpjs, 2 umum, 0 lainnya
        laba = [];
        numeral.locale('id');
        for (var i = 0; i < laba_farmasi.length; i++) {
            if(laba_farmasi[i].harga_min < harga && laba_farmasi[i].harga_max > harga)
                laba[laba_farmasi[i].perusahaan_tipe_id] = numeral(
                    harga*(100 + laba_farmasi[i].laba) /100).format('0,0');;
        }
        $('#harga-beli-sebelum-'+index).val(harga);
    }

    function formatBarang (item) {
        if (item.loading) {
            return item.text;
        }
        var stok = 0;
        if(item.stok)
            stok = item.stok.aggregate;
        var markup = item.item_detail.nama + " ("+item.item_detail.satuan+") || Stok = " + stok;

        return markup;
    }

    function formatBarangSelection (item) {
        var stok;
        if(item.item_detail){
            if(item.stok)
                stok = item.stok.aggregate;
            else
                stok = item.stok;
            return item.item_detail.nama + " ("+item.item_detail.satuan+") || Stok = " + stok;
        }

        else return item.text;
    }

    $('#btnEdit').on('click', function(){
        $('#modal-large').modal('show');
    });

    $('#close').on('click', function(){
        $('#modal-large').modal('hide');
    });

    $('.tanggal-datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy',   
    });

    // $('.datepicker').datepicker({
    //     autoclose: true,
    //     todayHighlight: true,
    //     format: 'dd/mm/yyyy',
    // })

    datepicker();

    function datepicker() {
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy', 
        });
    }


    $('#btnAddItems').on('click', function(){
        checked_ppn = $('#ppn-all').prop('checked') ? 'checked' : '';
        console.log(checked_ppn);
        str = `@include('farmasi.pengadaan.components.form-add-pengadaan', ['index' => "\${counter}", 'checked_ppn' => "\${checked_ppn}", 'row' => null] )`;
        $('#newItem').append(str);
        $('#barang-select2-'+counter).select2({
            ajax: {
            url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
                // url: API_URL+"/farmasi/item/get",
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
        $('.money').mask('000.000.000.000.000', {reverse: true});
        datepicker();
        checkValidDate();
        counter++;
    });

    function removeItem() {
        $('.btnRemove').on('click', function(){
            var wrapper = $(this).parents('.item-wrapper');
            wrapper.remove();
            updateTotal();
        });
    }

    $('.confirm-del').on('click', function(){
        var deleteSupp = $(this).parent().find('form');
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

    $('#newItem').on('select2:select', function (e) {
        var data = e.params.data;
        ide = $(e.target).attr('id');
        ideas = ide.slice(-1);
        
        $('#harga-lama-'+ideas).text('Harga Lama : '+data.harga);
        //changeHarga(ideas);
    });

 
    function changeHarga(index, harga) {
        console.log(harga);
        // $('#harga-'+index).val(harga);
        // $('#harga-lama-'+index).html('Harga Lama : '.harga);
        // changeSubtotal(index);
        
        //1 bpjs, 2 umum, 0 lainnya
        laba = [];
        numeral.locale('id');
        for (var i = 0; i < laba_farmasi.length; i++) {
            if(laba_farmasi[i].harga_min < harga && laba_farmasi[i].harga_max > harga)
                laba[laba_farmasi[i].perusahaan_tipe_id] = numeral(
                    harga*(100 + laba_farmasi[i].laba) /100).format('0,0');;
        }
        $('#harga-jual-'+index).html(
            "BPJS: Rp "+laba[1]+
            "<br>Umum: Rp "+laba[2]+
            "<br>Lainnya: Rp "+laba[0]
        );
        $('#harga-beli-sebelum-'+index).val(harga);
    }

    function changeSubtotal(index, tipe = null) {
        kecil = $('#jumlah-kecil-'+index).val();
        besar = $('#jumlah-besar-'+index).val();
        diskon = $('#diskon-'+index).val();
        harga_box =  $('#harga-box-'+index).val();
        
        if (tipe == "jumlah") {
            if (besar == "") $('#jumlah-besar-'+index).val(1);
            if (kecil == "") $('#jumlah-kecil-'+index).val(1);
            kecil = $('#jumlah-kecil-'+index).val();
            besar = $('#jumlah-besar-'+index).val();
            hasil = kecil * besar;
            $('#jumlah-'+index).val(hasil);
        }
        jumlah = $('#jumlah-'+index).val();
        ppn = parseFloat($('#ppn-'+index).val());

        subtotal_diskon = harga_box * besar * diskon / 100.0;
        subtotal_belum_ppn = harga_box * besar;
        subtotal_ppn = harga_box * besar * (ppn) * (100-diskon) /10000.0;
        subtotal = harga_box * besar * (100+ppn) * (100-diskon) /10000.0;

        $('#subtotal-diskon-'+index).val(subtotal_diskon);
        $('#subtotal-belum-ppn-'+index).val(subtotal_belum_ppn);
        $('#subtotal-ppn-'+index).val(subtotal_ppn);
        $('#subtotal-'+index).val(subtotal);

        jumlah = besar * kecil;
        harga = subtotal / jumlah;
        $('#harga-'+index).val(isNaN(harga) ? 0 : harga);
        $('#subtotal-'+index).val(subtotal);
        $('.money').mask('000.000.000.000.000', {reverse: true});

        updateTotal();
    }
    function updateTotal(){

        $('#total-ppn').text(0);
        $('#total-diskon').text(0);
        $('#total-belum-ppn').text(0);
        $('#total').text(0);

        subtotals = $('.subtotal-group');

        total_ppn =0;
        total_diskon =0;
        total_belum_ppn =0;
        total =0;
        console.log(subtotals);
        for (var i = 0; i < subtotals.length; i++) {
            total_ppn += parseFloat($(subtotals[i]).children('.subtotal-ppn').val());
            total_diskon += parseFloat($(subtotals[i]).children('.subtotal-diskon').val());
            total_belum_ppn += parseFloat($(subtotals[i]).children('.subtotal-belum-ppn').val());
            total += parseFloat($(subtotals[i]).children('.subtotal').val());
        }  
        numeral.locale('id');
        total_ppn = numeral(total_ppn).format('0,0');
        total_diskon = numeral(total_diskon).format('0,0');
        total_belum_ppn = numeral(total_belum_ppn).format('0,0');
        total = numeral(total).format('0,0');
        
        $('#total-ppn').text(total_ppn);
        $('#total-diskon').text(total_diskon);
        $('#total-belum-ppn').text(total_belum_ppn);
        $('#total').text(total);
    }

    function readImage(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var preview = 
                    '<center><img width="180" src="' + e.target.result + '" />'+
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
                'katalog_id': {
                    required: true,
                },
                'sumber_dana_id': {
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
                'katalog_id': 'Kolom ini wajib diisi',
                'sumber_dana_id': 'Kolom ini wajib diisi',
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
    };

    $('#po').on('select2:select', function(e){
        validation.destroy();
        validation = validateForm();
        if($(this).val() == 0 ){
            $('#loader').show();
            $('#newItem').empty();
            $('#headerItem').empty();
            return;
        }
        $('#loader').hide();
        var id_po = $(this).val();
        $.ajax({
            type: "GET",
            url: API_URL + "/keuangan/po/"+id_po,
            success: function (response) {
                $('#headerItem').empty();
                $('#newItem').empty();
                counter = 1;
                var po = JSON.parse(response);
                max_jumlah=[]
                for (var i = 0; i < po.detail.length; i++) {
                    var detail = po.detail[i];
                    var processed = (detail.jumlah_processed == null) ? 0 : detail.jumlah_processed;
                    if(detail.jumlah - processed == 0)  continue;

                    var jumlah = detail.jumlah-processed
                    var po = JSON.parse(selected_po);
                    if(po==null){
                        if(detail.item_gudang_id in mapped_detail)
                            jumlah = mapped_detail.jumlah;
                        else
                            jumlah = 0;
                    }
                        console.log(mapped_detail, po, jumlah);

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
                                    <input type="text" class="form-control" id="jumlah-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="jumlah[]" placeholder="Jumlah" value="${jumlah}" data-max="${detail.jumlah-processed}">
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

    initProdusenSelect2('.produsen-select2');
    function initProdusenSelect2(element_name)
    {
        $(element_name).select2({
            ajax: {
                url: API_URL+"/keuangan/perusahaan/search-select2",
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
            placeholder: "Cari Produsen",
            templateResult: formatProdusen,
            templateSelection: formatProdusenSelection
        });
    }

    

    function formatProdusen (item) {
        if (item.loading) {
            return item.text;
        }
        var markup = item.nama;

        return markup;
    }

    function formatProdusenSelection (item) {
        if(item.nama) return item.nama;
        else return item.text;
    }
</script>
@endsection
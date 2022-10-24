<div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/pengadaan')}}/edit" id="form-pengadaan">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$pengadaan->id}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Ubah Pembelian</h3>
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
                                    <label for="penyedia">Nomor Faktur<small> (Opsional)</small></label>
                                    <input type="text" class="form-control" id="penyedia" name="nomor_referensi" value="{{$pengadaan->nomor_referensi}}" placeholder="Isi Nomor Faktur">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="penyedia">Nomor Surat Jalan</label>
                                    <input type="text" class="form-control" id="penyedia" name="nomor_surat" value="{{$pengadaan->nomor_surat_jalan}}" placeholder="Isi Nomor Surat Jalan" required>
                                </div> --}}
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penyedia">Tanggal Pembelian</label>
                                    <div>
                                        <input type="text" class="js-datepicker form-control tanggal-datepicker" name="tanggal_transaksi" placeholder="Masukkan Tanggal Pembelian" value="{{ date('d/m/Y', strtotime($pengadaan->tanggal)) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Tanggal Faktur</label>
                                    <div>
                                        <input type="text" class="js-datepicker form-control tanggal-datepicker" name="tanggal_faktur" placeholder="Masukkan Tanggal Faktur" value="{{$pengadaan->tanggal_faktur ? date('d/m/Y', strtotime($pengadaan->tanggal_faktur)) : '' }}">
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="penyedia">Tanggal Surat Jalan</label>
                                    <div>
                                        <input type="text" class="js-datepicker form-control tanggal-datepicker" name="tanggal_surat_jalan" placeholder="Masukkan Tanggal Surat Jalan" value="{{ date('d/m/Y', strtotime($pengadaan->tanggal_surat_jalan)) }}">
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
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="keterangan" value="{{$pengadaan->keterangan}}" placeholder="Berikan Informasi Lebih">
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">
                        <div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="penyedia">Barang </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="penyedia">Jumlah </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="penyedia">Diskon </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="penyedia">PPN </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="penyedia">Subtotal </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="penyedia">Harga Satuan </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="penyedia">Expired </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="penyedia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="newItem">
                            @php $j=0 @endphp
                            @foreach($pengadaan->log as $row)
                            @php $j++ @endphp
                            <div class="row item-wrapper">
                                <input type="hidden" name="refer[]" value="{{$row->id}}">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <h1 id="harga-hid-{{$j}}" hidden>{{$row->detail_item->detail_item->item_detail->harga}}</h1>
                                        <div>
                                            <select class="js-select2 form-control barang" id="barang-select2-{{$j}}" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
                                                <option></option>
                                                <option value="{{$row->detail_item->item_farmasi_id}}" data-harga="{{$row->detail_item->detail_item->item_detail->harga}}" selected>{{$row->detail_item->detail_item->item_detail->nama}} ({{$row->detail_item->detail_item->item_detail->satuan}})</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <div>
                                            <input type="number" class="form-control" id="jumlah-{{$j}}" onchange="changeSubtotal({{$j}})" name="jumlah[]" placeholder="Jumlah" value="{{$row->jumlah}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <div>
                                            <input type="number" class="form-control" id="diskon-{{$j}}" onchange="changeSubtotal({{$j}})" name="diskon[]" placeholder="Diskon" value="{{$row->diskon}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <div>
                                            <input type="number" class="form-control" id="ppn-{{$j}}" onchange="changeSubtotal({{$j}})" name="ppn[]" placeholder="PPN" value="{{$row->ppn}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="subtotal-{{$j}}" name="subtotal[]" placeholder="Subtotal" value="{{$row->subtotal}}" onchange="changeSubtotal({{$j}})">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="harga_satuan[]" id="harga-{{$j}}" placeholder="Harga Satuan" value="{{$row->harga_saat_itu}}" readonly>
                                        <p id="harga-lama-{{$j}}"></p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div>
                                            <input type="text" class="js-datepicker form-control datepicker" name="expired[]" placeholder="Tanggal Expired" value="{{ !is_null($row->detail_item->kadaluarsa) ? date('d/m/Y', strtotime($row->detail_item->kadaluarsa)) : '' }}" autocomplete="off">
                                            <p class="text-warning txt-date"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-3 mb-3 pb-2" id="loader">
                            <center>
                                <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddItems">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" id="close" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square">
                         <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@section('js')
<script type="text/javascript">
    counter = "{{$j}}";
    $(document).ready(function(){
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

    function formatBarang (item) {
        if (item.loading) {
            return item.text;
        }

        var stok = 0;
        if(item.stok)
            stok = item.stok.aggregate;
        var markup = item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.item_detail.harga;

        return markup;
    }

    function formatBarangSelection (item) {
       if(item.item_detail){
            tipeObatDb = item.item_detail.satuan;

            var stok = 0;
            if(item.stok)
                stok = item.stok.aggregate;
            return item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.harga;  
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
        counter++;
        str = `<div class="row item-wrapper">
            <div class="col-md-2">
                <div class="form-group">
                    <h1 id="harga-hid-`+counter+`" hidden></h1>
                    <div>
                        <select class="js-select2 form-control" id="barang-select2-`+counter+`" name="barang[]"  style="width: 100%;" data-placeholder="Pilih Barang">
                            <option></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <div>
                        <input type="number" class="form-control" id="jumlah-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="jumlah[]" placeholder="Jumlah">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <div>
                        <input type="number" class="form-control" id="diskon-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="diskon[]" placeholder="Diskon" value="0">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <div>
                        <input type="number" class="form-control" id="ppn-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="ppn[]" placeholder="PPN" value="10">
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="subtotal-`+counter+`" name="subtotal[]" onchange="changeSubtotal(`+counter+`)" placeholder="Subtotal">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" name="harga_satuan[]" id="harga-`+counter+`" placeholder="Harga Satuan" readonly>
                    <p id="harga-lama-`+counter+`"></p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <div>
                        <input type="text" class="js-datepicker form-control datepicker" name="expired[]" placeholder="Tanggal Expired" autocomplete="off">
                        <p class="text-warning txt-date"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>`;
        $('#newItem').append(str);
        $('#barang-select2-'+counter).select2({
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
        datepicker();
        removeItem();
        checkValidDate();
    });

    function removeItem() {
        $('.btnRemove').on('click', function(){
            var wrapper = $(this).parents('.item-wrapper');
            wrapper.remove();
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
        
        $('#harga-lama-'+ideas).text('Harga Lama : '+data.item_detail.harga);
        //changeHarga(ideas);
    });

    function changeHarga(index) {
        harga = $('#harga-hid-'+index).text();
        console.log(harga);
        //harga = $('#barang-select2-'+index).find(":selected").data('harga');
        $('#harga-'+index).val(harga);
        changeSubtotal(index);
    }

    function changeSubtotal(index) {
        jumlah = $('#jumlah-'+index).val();
        diskon = $('#diskon-'+index).val();
        ppn = $('#ppn-'+index).val();
        subtotal = $('#subtotal-'+index).val();
        harga_diskon = subtotal*(100-diskon)/100;
        harga_ppn = harga_diskon + harga_diskon*ppn/100;
        harga = harga_ppn/jumlah;

        $('#harga-'+index).val(harga);
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
        var boxZone = $(this).parents('.preview-zone').find('.box-body');
        var previewZone = $(this).parents('.preview-zone');
        var changeImg = $(this).parents('.form-group').find('.change-img');
        boxZone.empty();
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
    var BeFormValidation = function() {
        var initValidationBootstrap = function(){
            jQuery('#form-pengadaan').validate({
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
                    'tanggal_transaksi': {
                        required: true,
                    },
                    'peyedia': {
                        required: true,
                    },
                    'barang[]': {
                        required: true,
                    },
                    'jumlah[]': {
                        required: true,
                    },
                    'expired[]': {
                        required: true,  
                    }
                },
                messages: {
                    'tanggal_transaksi': 'Kolom ini wajib diisi',
                    'peyedia': 'Kolom ini wajib diisi',
                    'barang[]': 'Kolom ini wajib diisi',
                    'jumlah[]': 'Kolom ini wajib diisi',
                    'expired[]': 'Kolom ini wajib diisi',
                }
            });
        };

        return {
            init: function () {
                initValidationBootstrap();
                jQuery('.js-select2').on('change', function(){
                    jQuery(this).valid();
                });
            }
        };
    }();

    jQuery(function(){ BeFormValidation.init(); });
</script>
@endsection 
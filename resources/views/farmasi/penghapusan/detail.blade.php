@extends('farmasi.layouts.main')

@section('title')
Farmasi Detail Penghapusan
@endsection

@section('content')
    <div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">Penghapusan #{{$penghapusan->slug}}</h3>
            <div class="block-options">
                <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/penghapusan/delete')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$penghapusan->id}}">
                </form>
                 <a href="{{url('farmasi/'.session('farmasi')->slug.'/penghapusan/'.$penghapusan->slug.'/print')}}" class="btn btn-alt-warning btn-square">
                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Print
                </a>
                @if(session('farmasi')->group->my_role->admin ?? 0 == 1)
                <button type="submit" class="btn btn-alt-danger btn-square confirm-del">
                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                </button>
                <button type="submit" class="btn btn-alt-primary btn-square" id="btnEdit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                </button>
                @endif
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <div class="row">
                    <div class="col">
                        <label>TANGGAL TRANSAKSI</label>
                        <h5>{{ date('d F Y', strtotime($penghapusan->created_at)) }}</h5>
                    </div>
                    <div class="col">
                        <label>KETERANGAN</label>
                        <p>{{$penghapusan->keterangan}}</p>
                    </div>
                </div>
            </div>
            
            <table class="table table-vcenter">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Kadaluarsa</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @foreach($penghapusan->log as $row)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
                        <td>{{$row->jumlah}} {{$row->detail_item->detail_item->satuan}}</td>
                        <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-50">
                <label>DI BUAT OLEH</label>
                <h5 class="text-primary">{{$penghapusan->created_by_detail->name}}</h5>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/penghapusan')}}/edit" id="form-penghapusan">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$penghapusan->id}}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Ubah Penghapusan</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                                        <input type="text" class="form-control" name="keterangan" placeholder="Berikan Informasi Lebih" value="{{$penghapusan->keterangan}}">
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-5">
                            <div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="penyedia">Nama Barang </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penyedia">Kadaluarsa </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="penyedia">Jumlah </label>
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
                                @foreach($penghapusan->log as $row)
                                @php $j++ @endphp
                                <div class="row item-wrapper">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div>
                                                <select class="js-select2 form-control barang" id="template-select2-{{$j}}" name="template[]" style="width: 100%;" data-placeholder="Pilih Barang">
                                                    <option></option>
                                                    <option value="{{$row->detail_item->item_farmasi_id}}" selected>{{$row->detail_item->detail_item->item_detail->nama}} ({{$row->detail_item->detail_item->item_detail->satuan}})</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div>
                                                <select class="js-select2 form-control" id="barang-select2-{{$j}}" name="barang[]" onchange="changeJumlah({{$j}})" style="width: 100%;">
                                                    <option value="{{$row->item_id}}" selected>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div>
                                                <input type="number" class="form-control" id="jumlah-{{$j}}" name="jumlah[]" placeholder="Jumlah" value="{{$row->jumlah}}" max="{{$row->jumlah + $row->detail_item->jumlah}}">
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
@endsection

@section('css')
    <style type="text/css">
        .bordered {
            border-bottom: 1px solid #eaecee;
        }
        .modal-content {
            border-radius: 0;
        }
        .modal-full {
            min-width: 100%;
            margin: 0;
        }

        .modal-full .modal-content {
            min-height: 100vh;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        counter = "{{$j}}";
        $(document).ready(function(){
            removeItem();
            for(x=1; x<=counter; x++)
            {
                changeItems(x,0);
                $('#template-select2-'+x).select2({
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
                $('#barang-select2-'+x).select2();
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
                return item.item_detail.nama + " ("+item.item_detail.satuan+") - Stok : " + stok + " - Harga : "+item.item_detail.harga;
            } 
            else return item.text;
        }

        $('#btnEdit').on('click', function(){
            $('#modal-large').modal('show');
        });

        $('#close').on('click', function(){
            $('#modal-large').modal('hide');
        });

        $('#btnAddItems').on('click', function(){
            counter++;
            str = `<div class="row item-wrapper">
                        <div class="col-md-5">
                            <div class="form-group">
                                <div>
                                    <select class="js-select2 form-control" id="template-select2-`+counter+`" name="template[]" style="width: 100%;">
                                        <option value="">Cari Barang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div>
                                    <select class="js-select2 form-control" id="barang-select2-`+counter+`" name="barang[]" onchange="changeJumlah(`+counter+`)" style="width: 100%;">
                                        <option value="">Pilih Barang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div>
                                    <input type="number" class="form-control" id="jumlah-`+counter+`" name="jumlah[]" placeholder="Jumlah">
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
            $('#barang-select2-'+counter).select2();
            $('#template-select2-'+counter).select2({
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

        /*$('#newItem').on('select2:select', function (e) {
            var data = e.params.data;
            ide = $(e.target).attr('id');
            ideas = ide.slice(-1);
            
            $('#harga-hid-'+ideas).text(data.harga);
            changeHarga(ideas);
        });

        function changeHarga(index) {
            harga = $('#harga-hid-'+index).text();
            console.log(harga);
            //harga = $('#barang-select2-'+index).find(":selected").data('harga');
            $('#harga-'+index).val(harga);
            changeSubtotal(index);
        }*/
        $('#newItem').on('select2:select', function (e) {
            var data = e.params.data;
            ide = $(e.target).attr('id');
            ideas = ide.split('-');
            ideas = ideas[ideas.length - 1];
            
            if(!data.element) changeItems(ideas, 1);
        });

        function changeItems(index, remove) {
            if(remove == 1) $("#barang-select2-"+index).children('option').remove();
            temp = $('#template-select2-'+index).val();
            var url = "{{ url('/api/farmasi/'.session('farmasi')->slug.'/item/active') }}/"+temp;            
            
            $.get( url , function( data ) {
                if(data.length == 0 && remove == 1) {
                    $("#barang-select2-"+index).append('<option>Belum ada barang</option>');
                    $("#jumlah-"+index).val('');
                    $("#jumlah-"+index).prop('max',0);
                }
                for(var key in data)
                {
                    row = data[key];
                    if(row.id != $("#barang-select2-"+index).val() || remove == 1) {
                        $("#barang-select2-"+index).append('<option value="'+row.id+'" data-max="'+row.jumlah+'">'+formatDate(row.kadaluarsa)+'</option>');
                    }
                    if(key==0 && remove == 1) {
                        $("#jumlah-"+index).val(row.jumlah);
                        $("#jumlah-"+index).prop('max',row.jumlah);
                    }
                }
            });
            
            //$('#harga-'+index).val(harga);
        }

        function changeJumlah(index) {
            max = $("#barang-select2-"+index).find(':selected').data('max');
            $("#jumlah-"+index).val(max);
            $("#jumlah-"+index).prop('max', max);

        }

    </script>

    <script type="text/javascript">
        var BeFormValidation = function() {
            var initValidationBootstrap = function(){
                jQuery('#form-penghapusan').validate({
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
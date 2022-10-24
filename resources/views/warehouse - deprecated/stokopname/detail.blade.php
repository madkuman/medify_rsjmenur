@extends('warehouse.layouts.main')

@section('title')
Gudang Detail Stok Opname
@endsection

@section('content')
<div class="block">
    <div class="block-header bordered">
        <h3 class="block-title">Stok Opname #{{$stokopname->slug}}</h3>
        <div class="block-options">
            <form method="POST" action="{{url('gudang/stokopname/confirm')}}" id="form-confirm">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$stokopname->id}}">
            </form>
            <form method="POST" action="{{url('gudang/stokopname/delete')}}" id="form-delete">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$stokopname->id}}">
            </form>
            <a type="btn" class="btn btn-alt-success btn-square" href="{{url('/gudang/stokopname/download/'.$stokopname->slug)}}/">
                    <i class="fa fa-file-excel" aria-hidden="true"></i>&nbsp;&nbsp;Download
                </a>
            <button class="btn btn-alt-primary btn-square " onclick="printStokOpname('{{$stokopname->slug}}')">
                <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Print
            </button>
            <button type="submit" class="btn btn-alt-danger btn-square confirm-del ">
                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
            </button>
            @if(!$stokopname->status)
            <button type="button" class="btn btn-alt-info btn-square confirm ">
                <i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Konfirmasi
            </button>
            <button class="btn btn-alt-success btn-square " onclick="reviewStokOpname('{{$stokopname->slug}}')">
                <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;Review
            </button>
            <button class="btn btn-alt-primary btn-square " id="new">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Tambah Detail
            </button>
            @endif
                <!-- <button type="submit" class="btn btn-alt-danger btn-square confirm-del">
                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                </button>
                <button type="submit" class="btn btn-alt-primary btn-square" id="btnEdit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                </button> -->
            </div>
        </div>
        <div class="block-content">
            @if(!$stokopname->status)
            <h5 class="p-10 bg-primary-lighter text-primary-dark">Detail Stok Opname </h5>
                {{csrf_field()}}
                <input type="hidden" name="flag" value="{{$flag}}">
                <input type="hidden" name="id" value="{{$stokopname->id}}">
                <div class="col-12 ajax-container" style="padding-top: 10px;" id="itemsContainer">
                    <input class="form-control" placeholder="Cari disini..." type="text" id="searchField" onkeyup="filterBarang(this)">
                    <div class="form-items block-content" id="itemsDiv" data-toggle="slimscroll" data-always-visible="true" data-size="8px" data-height="250px">
                        <table class="js-table-sections table table-hover">
                            <thead>
                                <tr>
                                    <th width="6%"></th>
                                    <th width="30%">Nama Barang</th>
                                    <th width="15%">Kadaluarsa</th>
                                    <th class="d-none d-sm-table-cell" width="15%">Jumlah</th>
                                    <th class="d-none d-sm-table-cell" width="15%">Harga</th>
                                    <th width="9%"></th>
                                </tr>
                            </thead>
                            @php $idx=0 @endphp
                            @forelse($stokopname->detail as $row)
                            @php $idx++ @endphp
                            <tbody class="js-table-sections-header opname-wrapper">
                                <tr>
                                    <td class="text-center">
                                        <i class="fa fa-angle-right"></i>
                                    </td>
                                    <td class="font-w600 nama-item">{{$row->nama}}</td>
                                    <td>
                                        {{date('d F Y', strtotime($row->kadaluarsa))}}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <em class="text-muted">{{$row->jumlah}}</em>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <em class="text-muted">{{$row->harga}}</em>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($row->sub as $sub)
                                <tr class="opname-detail-wrapper">
                                    <input type="hidden" name="detail_refer[]" value="{{$sub->id}}" id="sub-id-{{$sub->id}}">
                                    <td class="text-center">{{$i++}}</td>
                                    <td class="font-w600">{{$sub->created_by_detail->name}}</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control change-detail" name="keterangan[]" value="{{$sub->keterangan}}" placeholder='Keterangan Lokasi Obat' id="sub-ket-{{$sub->id}}" data-id="{{$sub->id}}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" class="form-control change-detail" name="jumlah[]" value="{{$sub->jumlah}}" id="sub-jumlah-{{$sub->id}}" data-id="{{$sub->id}}">
                                        </div>
                                    </td>     
                                    <td>
                                        <div class="form-group">
                                            <input type="number" class="form-control change-detail" name="harga[]" value="{{$sub->harga}}" id="sub-harga-{{$sub->id}}" data-id="{{$sub->id}}">
                                        </div>
                                    </td>                            
                                    <td>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemoveDetail" data-id="{{$sub->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @empty
                            Belum ada barang
                            @endforelse
                        </table>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <div class="float-right">
                            <button type="button" class="btn btn-primary btn-square"  id="saveEdit">
                               <i class="fa fa-save"></i> Simpan
                           </button>
                       </div>
                   </div>
               </div>
           @else
           <div class="block block-transparent">
            <div class="row">
                <div class="col">
                    <label>TANGGAL TRANSAKSI</label>
                    <h5>{{ date('d F Y', strtotime($stokopname->created_at)) }}</h5>
                </div>
                <div class="col">
                    <label>KETERANGAN</label>
                    <p>{{$stokopname->keterangan ? $stokopname->keterangan : "-"}}</p>
                </div>
            </div>
            <div class="row">
                @if($stokopname->penghapusan)
                <div class="col">
                    <label>Detail Penghapusan</label>
                    <a href="{{url('gudang/penghapusan/'.$stokopname->penghapusan->slug)}}">
                        <h5>#{{$stokopname->penghapusan->slug}}</h5>
                    </a>
                </div>
                @endif
                @if($stokopname->distribusi)
                <div class="col">
                    <label>Detail distribusi</label>
                    <a href="{{url('gudang/distribusi/'.$stokopname->distribusi->slug)}}">
                        <h5>#{{$stokopname->distribusi->slug}}</h5>
                    </a>
                </div>
                @endif
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
                @if($stokopname->detail)
                @foreach($stokopname->detail as $row)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$row->nama}}</td>
                    <td>{{$row->jumlah}}</td>
                    <td>{{ date('d F Y', strtotime($row->kadaluarsa)) }}</td>
                </tr>
                @endforeach
                @endif
        </tbody>
    </table>
    @endif

    <div class="mt-50">
        <label>DI BUAT OLEH</label>
        <h5 class="text-primary">{{$stokopname->created_by_detail->name}}</h5>
    </div>
</div>
</div>

<div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('gudang/stokopname')}}/add" id="form-stokopname">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$stokopname->id}}">
            <input type="hidden" name="flag" value="{{$flag}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Tambah Detail Stok Opname</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="deskripsi" placeholder="Berikan Informasi Lebih" value="{{$stokopname->keterangan}}">
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">
                        <div id="newItem">
                            <div class="row mt-3 item-wrapper gutters-tiny">
                                <div class="col-3">
                                    <label for="penyedia">Barang </label>
                                </div>
                                <div class="col-2">
                                    <label for="penyedia">Kadaluarsa </label>
                                </div>
                                <div class="col-2">
                                    <label for="penyedia">Jumlah </label>
                                </div>
                                <div class="col-2">
                                    <label for="penyedia">Harga </label>
                                </div>
                                <div class="col-2">
                                    <label for="penyedia">Keterangan </label>
                                </div>
                                <div class="col-1">
                                    <label for="penyedia">
                                        &nbsp;
                                    </label>
                                </div>
                            </div>
                            <div class="row justify-content-center pt-15 item-baru gutters-tiny">
                                <div class="col-3">
                                    <div class="form-group">
                                        <div>
                                            <select class="js-select2 barang-select2  form-control" id="barang-select2-1" name="barang[]" style="width: 100%;" data-counter="1" data-placeholder="Pilih Barang" required>
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <div>
                                            <input type="text" class="js-datepicker form-control" id="tanggal-datepicker-1" name="kadaluarsa[]" placeholder="Masukkan Tanggal Kadaluarsa" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <div>
                                            <input type="number" class="form-control" id="jumlah-1" name="jumlah[]" placeholder="Jumlah">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <div>
                                            <input type="text" class="form-control" id="harga-1" name="harga[]" placeholder="Harga">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <div>
                                            <input type="text" class="form-control" id="ket-1" name="keterangan[]" placeholder="Keterangan">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($flag == 0)
                        <div class="mt-3 mb-3 pb-2" id="loader">
                            <center>
                                <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddItems">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
                            </center>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
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
</style>
@endsection

@section('js')
<script type="text/javascript">
    var detail_changes = [];
    var harga_arr = {};
    $('#new').on('click', function(){
        $('#modal-large').modal('show');
    });

    $('#close').on('click', function(){
        $('#modal-large').modal('hide');
    });

    var counter = 1;
    $('#btnAddItems').on('click', function(){
        counter++;
        str = 
        `<div class="row justify-content-center item-baru gutters-tiny">
        <div class="col-3">
        <div class="form-group">
        <div>
        <select class="js-select2 barang-select2 form-control" id="barang-select2-`+counter+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang" data-counter="`+counter+`">
        <option></option>
        </select>
        </div>
        </div>
        </div>
        <div class="col-2">
        <div class="form-group">
        <div>
        <input type="text" class="js-datepicker form-control" id="tanggal-datepicker-`+counter+`" name="kadaluarsa[]" placeholder="Masukkan Tanggal Kadaluarsa" autocomplete="off" required>
        </div>
        </div>
        </div>
        <div class="col-2">
        <div class="form-group">
        <div>
        <input type="number" class="form-control" id="jumlah-`+counter+`" name="jumlah[]" placeholder="Jumlah">
        </div>
        </div>
        </div>
        <div class="col-2">
        <div class="form-group">
        <div>
        <input type="text" class="form-control" id="harga-`+counter+`" name="harga[]" placeholder="Harga">
        </div>
        </div>
        </div>
        <div class="col-2">
        <div class="form-group">
        <div>
        <input type="text" class="form-control" id="ket-`+counter+`" name="keterangan[]" placeholder="Keterangan">
        </div>
        </div>
        </div>
        <div class="col-1">
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
        removeItem();
        $('#tanggal-datepicker-'+counter).datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy', 
        });

        $('.barang-select2').on('select2:select', function(){
            var count = $(this).data('counter');
            var harga = harga_arr[$(this).val()];
            $('#harga-'+count).val(harga);
        });
    });
    

    $('.barang-select2').on('select2:select', function(){
        var count = $(this).data('counter');
        var harga = harga_arr[$(this).val()];
        $('#harga-'+count).val(harga);
    });

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
    removeItem();
    $('#tanggal-datepicker-1').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy', 
    });

    function formatBarang (item) {
        if (item.loading) {
            return item.text;
        }
        harga_arr[item.id] = item.harga;
        var markup = item.nama + " ("+item.satuan+")";

        return markup;
    }

    function formatBarangSelection (item) {
        if(item.id != "") return item.nama + " ("+item.satuan+")";
        else return item.text;
    }

    function removeItem() {
        $('.btnRemove').on('click', function(){
            var wrapper = $(this).parents('.item-baru');
            wrapper.remove();
        });
    }

    function filterBarang(e)
    {
        if(e.value.length < 2) {
            $('.opname-wrapper').css('display', '');
            return;
        }

        let filter, container, rows, i, textValue;
        filter = e.value.toLowerCase();

        container = document.getElementById('itemsDiv');
        rows = container.getElementsByClassName('opname-wrapper');

        for(i = 0; i < rows.length; i++)
        {
            textValue = rows[i].getElementsByClassName('nama-item')[0].innerText.toLowerCase();
            if(textValue.indexOf(filter) > -1 ) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    $('.btnRemoveDetail').on('click', function(){
        var current_id = $(this).data('id');
        detail_changes = detail_changes.filter(function(element) {
            return element.id != current_id;
        });
        var obj = {"id": current_id, "type": -1};
        detail_changes.push(obj);

        var wrapper = $(this).parents('.opname-detail-wrapper');
        wrapper.remove();
    });

    $(".change-detail").on('change', function(){
        var current_id = $(this).data('id');
        detail_changes = detail_changes.filter(function(element) {
            return element.id != current_id;
        });

        var jumlah = $('#sub-jumlah-'+current_id).val();
        var ket = $('#sub-ket-'+current_id).val();
        var harga = $('#sub-harga-'+current_id).val();
        var obj = {"id": current_id, "type": 1, "keterangan":ket, "jumlah":jumlah, "harga":harga};
        detail_changes.push(obj);
    });
    function reviewStokOpname(slug) {
        console.log(slug);
        var url = "{{ url('/gudang/stokopname/review') }}/"+slug;
        popupwindow(url,'Review Stok Opname',620,1000);
    }

    function printStokOpname(slug) {
        console.log(slug);
        var url = "{{ url('/gudang/stokopname/print') }}/"+slug;
        popupwindow(url,'Print Stok Opname',620,1000);
    }
    $('.confirm').on('click', function(){
        var confirmSupp = $(this).parent().find('#form-confirm');
        swal({
            title: 'Apa anda yakin?',
            text: 'Mohon dicek kembali data yang ada, bila sudah dikonfirmasi penghapusan dan distribusi barang akan dilakukan dan tidak bisa dikembalikan lagi',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d26a5c',
            confirmButtonText: 'Konfirmasi',
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
                confirmSupp.submit();
            //swal('Berhasil', 'Data berhasil dihapus.', 'success');
            // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
        } else if (result.dismiss === 'cancel') {
            swal('Batal', 'Konfirmasi dibatalkan.', 'error');
        }
    });
    });

    $('.confirm-del').on('click', function(){
        var deleteSupp = $(this).parent().find('#form-delete');
        swal({
            title: 'Apa anda yakin?',
            text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d26a5c',
            confirmButtonText: 'Konfirmasi',
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
            swal('Batal', 'Hapus dibatalkan.', 'error');
        }
    });
    });

    $('#saveEdit').on('click', function(){
        if($(this).attr('disable'))
            return;
        $('#saveEdit').attr('disable', true);
        $('#saveEdit').find('i').remove();
        $('#saveEdit').prepend('<i class="fa fa-spin fa-spinner"></i>');
        var formdata =  new FormData();
        formdata.append('changes', JSON.stringify(detail_changes));
        formdata.append('id', {{$stokopname->id}});
        swal({
            title: 'Simpan perubahan?',
            text: 'Anda yakin ingin menyimpan perbahan ini?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'simpan',
            html: false,
        }).then(function(result){
            if (result.value) {
                $.ajax({
                    type: "POST",
                    data: formdata,
                    url: API_URL + "/gudang/stokopname/save-changes",
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        callSwal('success', 'Berhasil!', 'perubahan berhasil disimpan.', '/gudang/stokopname/{{$stokopname->slug}}/{{$flag}}');
                    },
                    error: function (error) {
                        console.log(error);
                        swal('Gagal', 'perubahan gagal disimpan.', 'error');

                        $('#saveEdit').attr('disable', false);
                        $('#saveEdit').find('i').remove();
                        $('#saveEdit').prepend('<i class="fa fa-save"></i>');
                        return;
                    }
                });
            } else if (result.dismiss === 'cancel') {
                $('#saveEdit').attr('disable', false);
                swal('Batal', 'simpan dibatalkan.', 'error');
            }
        });
    });

</script>
@endsection
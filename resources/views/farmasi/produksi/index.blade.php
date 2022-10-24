@extends('farmasi.layouts.main')

@section('title')
Farmasi Produksi
@endsection

@section('content')
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Produksi</h3>
        <div class="block-options">
            <button type="button" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-tambah">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Komposisi Produksi Baru
            </button>
        </div>
    </div>
    <div class="block-content">
        <div class="block block-transparent">
            <button type="submit" class="btn btn-secondary btn-square d-none" id="btnFilter">
                <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
            </button>
            <div class="d-none" id="filter-data">
                <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/produksi')}}" id="formFilter">
                    {!!csrf_field()!!}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="penyedia">NAMA BARANG </label>
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="{{$nama_barang}}">
                            </div>
                            <div class="form-group">
                                <label for="penyedia">KATEGORI </label>
                                <select class="js-example-basic-multiple form-control" id="kategori-select2" name="kategori[]" multiple="multiple" style="width: 100%;">

                                    @foreach($kategori_all as $gori)
                                    <option value="{{$gori->id}}"
                                        @if($kategori)
                                        @foreach($kategori as $tego) 
                                        @if($gori->id == $tego) selected @endif
                                        @endforeach
                                        @endif>{{$gori->nama}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right mt-15">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Batalkan</button>
                            <button type="button" class="btn btn-warning btn-square" id="btnReset">Reset</button>
                            <button type="submit" class="btn btn-primary btn-square">
                                <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-hover table-vcenter" id="items">
            <thead>
                <tr>
                    <th>No</th>
                    <th class="d-none d-sm-table-cell">Terakhir Produksi</th>
                    <th class="d-none d-sm-table-cell">Nama Produksi</th>
                    <th class="d-none d-sm-table-cell">Expired</th>
                    <th class="d-none d-sm-table-cell">Bahan Produksi</th>
                    <th class="d-none d-sm-table-cell">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produksi as $prod)
                <tr>
                    <td style="vertical-align: top;">{{$loop->iteration}}</td>
                    <td style="vertical-align: top;">{{indonesian_date($prod->last_transaksi->created_at) ?? '-'}}</td>
                    <td style="vertical-align: top;">{{$prod->nama}} ({{$prod->tipe}})</td>
                    <td style="vertical-align: top;">{{indonesian_date($prod->last_transaksi->kadaluarsa) ?? '-'}}</td>
                    <td >
                        @foreach($prod->detail as $detail)
                        @if($loop->iteration == 4)
                        ...
                        @break
                        @endif
                        {{$detail->item_farmasi->item_detail->nama}} - {{$detail->jumlah}} {{$detail->item_farmasi->item_detail->satuan ?? '-'}}
                        @if(!$loop->last)
                        <br>
                        @endif
                        @endforeach
                    </td>
                    <td style="vertical-align: top;" class="text-center">
                        <a class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5" href="{{url('farmasi/'.session('farmasi')->slug.'/produksi/'.$prod->id)}}">
                           <i class="fa fa-search-plus"></i> 
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('farmasi.produksi.modals.modal-tambah')
</div>
@endsection

@section('css')
<style type="text/css">
.inline {
    display: inline;
}
.modal-content {
    border-radius: 0;
}
.clickable-row {
    cursor: pointer;
}
.mt-70 {
    margin-top: 70px !important;
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
<script type="text/javascript">

    $(document).ready(function() {
        select2Barang(1);
    });
    $('#kategori-select2').select2();

    // var table = $('#items').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     searching: false,
    //     lengthChange: false,
    //     ordering: false,
    //     autoWidth: false,
    //     language: {
    //         processing: '<div class="panel panel-default"><i class="fa fa-4x fa-asterisk fa-spin text-info"></i></div>'
    //     },
    //     ajax: {
    //         url: "{{ url('/farmasi/'.session('farmasi')->slug.'/produksi/get') }}",
    //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //         type: "POST",
    //         data: {
    //             farmasi : function() {
    //                 return "{{session('farmasi')->slug}}";
    //             },
    //             nama_barang : function() {
    //                 return $('#nama_barang').val();
    //             },
    //             stok_minimal : function() {
    //                 return $('#stok_minimal').val();
    //             },
    //             stok_maksimal : function() {
    //                 return $('#stok_maksimal').val();
    //             },
    //             harga_barang_minimal : function() {
    //                 return $('#harga_barang_minimal').val();
    //             },
    //             harga_barang_maksimal : function() {
    //                 return $('#harga_barang_maksimal').val();
    //             },
    //             kategori : function() {
    //                 return $('#kategori-select2').val();
    //             }
    //                 /*warning_stok : function() {
    //                     return $('#warning_stok').is(":checked");
    //                 },
    //                 warning_kadaluarsa : function() {
    //                     return $('#warning_kadaluarsa').is(":checked");
    //                 }*/
    //             }
    //         }
    //     });
    $('#btnFilter').on('click', function(){
        $(this).addClass('d-none');
        $(this).parents('.block-content').find('#items_wrapper').addClass('mt-70');
        $('#filter-data').removeClass('d-none');
    });

    $('#btnCancel').on('click', function(){
        $(this).parents('#filter-data').addClass('d-none');
        $(this).parents('.block-content').find('#items_wrapper').removeClass('mt-70');
        $('#btnFilter').removeClass('d-none'); 
    });

    $('#btnReset').on('click', function(e) {
        $('#nama_barang').val(null).trigger('change');
        $('#stok_maksimal').val(null).trigger('change');
        $('#stok_minimal').val(null).trigger('change');
        $('#harga_barang_maksimal').val(null).trigger('change');
        $('#harga_barang_minimal').val(null).trigger('change');
        $('#kategori-select2').val(null).trigger('change');
        document.getElementById("formFilter").submit();
    });

    cik = 1;
    $('#btnAddRacikan').on('click', function() {
        cik++;
        var formRacikan = 
        `<div class="obat-wrapper row">
            <div class="col-md-5">
                <div class="form-group">
                    <select class="form-control js-select2" style="width: 100%" data-placeholder="Pilih Barang" id="barang-produksi-${cik}" name="barang_produksi[]">
                        <option></option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="js-datepicker form-control" autocomplete="off" disabled id="edbarang-${cik}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="barang_jumlah[]" class="form-control">
                </div>
            </div>
            <div class="col-md-1">
                <button type="button" class="button-control btn btn-sm btn-danger btn-square btnRemoveRacikan">
                <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </div>
        </div>`
        $('#racikan-row').append(formRacikan);
        removeRacikan();
        select2Barang(cik);
    });

    function removeRacikan() {
        $('.btnRemoveRacikan').on('click', function() {
            var remove_racikan = $(this).parents('.obat-wrapper');
            remove_racikan.remove();
        })
    }
    function select2Barang(counter) {
        $('#barang-produksi-'+counter).select2({
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
                        results: $.map(data.data, function(obj) {
                            var stok = 0;
                            if(obj.stok)
                                stok = obj.stok.aggregate;

                            var text_option = obj.item_detail.nama + " ("+obj.item_detail.satuan+") - Stok : " + stok + " - Harga : "+obj.item_detail.harga;


                            if (obj.loading || obj.text) {
                                text_option = obj.text;
                                id_option = 0;
                            }
                            return { id: JSON.stringify((obj)), text:  text_option };
                        })
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Barang",
            // templateResult: formatBarang,
            // templateSelection: formatBarangSelection
        });
        $('#barang-produksi-'+counter).on('select2:select', function(){
            var val = JSON.parse($(this).val());
            var tanggal = val.kadal.kadal;
            if(val.kadal){
                tanggal = tanggal.split('-').reverse().join('/');
                $('#edbarang-'+counter).val(tanggal);
            }
            else
                $('#edbarang-'+counter).val('-');
        });
    }

    // $('#nama-produksi').select2({
    //     ajax: {
    //         url: API_URL+"/farmasi/{{session('farmasi')->slug}}/produksi/get",
    //         dataType: 'json',
    //         delay: 250,
    //         data: function (params) 
    //         {
    //             return {
    //                 keyword: params.term,
    //                 page: params.page
    //             };
    //         },
    //         processResults: function (data, params) {
    //             params.page = params.page || 1;
    //             data.unshift({'id': 0, 'text':params.term})
    //             return {
    //                 results: $.map(data, function(obj) {
    //                     var text_option = obj.nama;
    //                     var id_option = JSON.stringify(obj);
    //                     if (obj.loading || obj.text) {
    //                         text_option = obj.text;
    //                         id_option = 0;
    //                     }
    //                     return { id: JSON.stringify((obj)), text:  text_option };
    //                 })
    //             };
    //         },
    //         cache: true
    //     },
    //     escapeMarkup: function (markup) { return markup; },
    //     minimumInputLength: 3,
    // });
</script>
@endsection
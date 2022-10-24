@extends('farmasi.layouts.main')

@section('title')
Farmasi Detail Pembelian
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
        #modal-large {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }
        .modal-full .modal-content {
            min-height: 100vh;
        }
    </style>
@endsection

@section('content')
        {{-- @include('farmasi.pengadaan.layouts.detail-gudang') --}}
        <div class="block">
            <div class="block-header bordered">
                <h3 class="block-title">Penerimaan #{{$pengadaan->slug}}</h3>
                <div class="block-options">
                    <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/gudang/pengadaan/delete')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$pengadaan->id}}">
                    </form>
                    <a href="{{url('farmasi/'.session('farmasi')->slug.'/gudang/pengadaan/'.$pengadaan->slug.'/print')}}" class="btn btn-alt-warning btn-square" target="_blank">
                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Print
                    </a>
                    <button type="submit" class="btn btn-alt-danger btn-square confirm-del">
                        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                    </button>
                    <button type="submit" class="btn btn-alt-primary btn-square" id="btnEdit">
                        <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                    </button>
                </div>
            </div>
            <div class="block-content">
                <div class="block block-transparent">
                    <div class="row">
                        <div class="col">
                            <label>PENYEDIA</label>
                            <a href="{{--url('gudang/supplier/'.$pengadaan->supplier_detail->slug)--}}"><h4 class="text-primary">{{$pengadaan->supplier_detail->nama}}</h4></a>
                            <label>NO FAKTUR</label>
                            <h4>{{$pengadaan->nomor_referensi ? $pengadaan->nomor_referensi : "-"}}</h4>
                            <label>NO SURAT JALAN</label>
                            <h4>{{$pengadaan->nomor_surat_jalan ? $pengadaan->nomor_surat_jalan : "-"}}</h4>
                        </div>
                        <div class="col">
                            <label>TANGGAL PENERIMAAN</label>
                            <h5>{{ date('d F Y', strtotime($pengadaan->tanggal)) }}</h5>
                            <label>TANGGAL FAKTUR</label>
                            <h5>{{ $pengadaan->tanggal_faktur ? date('d F Y', strtotime($pengadaan->tanggal_faktur)) : "-" }}</h5>
                            <label>TANGGAL SURAT JALAN</label>
                            <h5>{{ $pengadaan->tanggal_surat_jalan ? date('d F Y', strtotime($pengadaan->tanggal_surat_jalan)) : "-" }}</h5>
                            @if($pengadaan->bukti_nota)
                                <label>BUKTI NOTA</label>
                                <h5>
                                    <a href="{{asset($pengadaan->bukti_nota)}}" class="link-effect" target="_blank">Lihat Bukti Nota</a>
                                </h5>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>KETERANGAN</label>
                            <p>{{$pengadaan->keterangan ? $pengadaan->keterangan : "-"}}</p>
                        </div>
                        <div class="col">
                            <label>NILAI PENERIMAAN</label>
                            <h5>Rp. {{$pengadaan->total_harga ? number_format($pengadaan->total_harga) : "-"}}</h5>
                        </div>
                    </div>
                </div>
                
                <table class="table table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Diskon</th>
                            <th>PPN</th>
                            <th>Harga Satuan</th>
                            <th>Batch</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($pengadaan->log as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->detail_item->detail_item->nama}}</td>
                            <td>{{$row->jumlah}} {{$row->detail_item->detail_item->satuan}}</td>
                            <td>Rp. {{number_format($row->subtotal)}}</td>
                            <td>{{$row->diskon}} %</td>
                            <td>{{$row->ppn}} %</td>
                            <td>Rp. {{number_format($row->harga_saat_itu)}}</td>
                            <td>{{$row->batch ?? '-'}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        
                <div class="mt-50">
                    <label>DI BUAT OLEH</label>
                    <h5 class="text-primary">{{$pengadaan->created_by_detail->name}} - {{ date('d F Y, H:i', strtotime($pengadaan->created_at)) }}</h5>
                </div>
            </div>
        </div>
        
        <div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
            <div class="modal-dialog modal-full" role="document">
                <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/gudang/pengadaan')}}/edit" id="form-pengadaan">
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
                                            <label for="penyedia">Nomor Faktur<small> (Opsional)</small></label>
                                            <input type="text" class="form-control" id="penyedia" name="nomor_referensi" value="{{$pengadaan->nomor_referensi}}" placeholder="Isi Nomor Faktur">
                                        </div>
                                        <div class="form-group">
                                            <label for="penyedia">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" id="penyedia" name="nomor_surat" value="{{$pengadaan->nomor_surat_jalan}}" placeholder="Isi Nomor Surat Jalan" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="penyedia">Tanggal Penerimaan</label>
                                            <div>
                                                <input type="text" class="js-datepicker form-control tanggal-datepicker" name="tanggal_transaksi" placeholder="Masukkan Tanggal Penerimaan" value="{{$pengadaan->tanggal ? date('d/m/Y', strtotime($pengadaan->tanggal)) : ''}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="penyedia">Tanggal Faktur</label>
                                            <div>
                                                <input type="text" class="js-datepicker form-control tanggal-datepicker" name="tanggal_faktur" placeholder="Masukkan Tanggal Faktur" value="{{ $pengadaan->tanggal_faktur ? date('d/m/Y', strtotime($pengadaan->tanggal_faktur)) : ''}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="penyedia">Tanggal Surat Jalan</label>
                                            <div>
                                                <input type="text" class="js-datepicker form-control tanggal-datepicker" name="tanggal_surat_jalan" placeholder="Masukkan Tanggal Surat Jalan" value="{{ $pengadaan->tanggal_surat_jalan ?  date('d/m/Y', strtotime($pengadaan->tanggal_surat_jalan)) : '' }}">
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
                                            <label for="penyedia">Keterangan </label>
                                            <input type="text" class="form-control" name="keterangan" value="{{$pengadaan->keterangan}}" placeholder="Berikan Informasi Lebih">
                                        </div>
                                    </div>
                                </div>
        
                                <hr class="my-5">
                                <div id="headerItem">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="penyedia">Barang </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="penyedia">Jumlah </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="penyedia">Diskon </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1 d-none">
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
                                                <label for="penyedia">Batch </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1 d-none">
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
                                    <div class="row item-wrapper gutters-tiny">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <h1 id="harga-hid-{{$j}}" hidden class="counter">{{$j}}</h1>
                                                <div>
                                                    <select class="form-control" id="-barang-select2-{{$j}}" name="barang[]"  style="width: 100%;" readonly="">
                                                        <option value="{{$row->detail_item->item_template_id}}" selected>{{$row->detail_item->detail_item->nama}} ({{$row->detail_item->detail_item->satuan}})</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="jumlah-{{$j}}" onchange="changeSubtotal({{$j}})" name="jumlah[]" placeholder="Jumlah" value="{{$row->jumlah}}" 
                                                    @if(isset($po_selected)) 
                                                    data-max="{{$po_selected->detail[$j-1]->jumlah - $po_selected->detail[$j-1]->jumlah_processed + $row->jumlah}}" 
                                                    @endif>
                                                    @if(isset($po_selected))
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            Max: {{$po_selected->detail[$j-1]->jumlah - $po_selected->detail[$j-1]->jumlah_processed + $row->jumlah}}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <div>
                                                    <input type="number" class="form-control" id="diskon-{{$j}}" onchange="changeSubtotal({{$j}})" name="diskon[]" placeholder="Diskon" value="{{$row->diskon}}" step=".001" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 d-none">
                                            <div class="form-group">
                                                <div>
                                                    <input type="number" class="form-control" id="ppn-{{$j}}" onchange="changeSubtotal({{$j}})" name="ppn[]" placeholder="PPN" value="{{$row->ppn}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control money" id="subtotal-{{$j}}" onchange="changeSubtotal({{$j}})" name="subtotal[]" placeholder="Subtotal" value="{{$row->subtotal}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="harga_satuan[]" id="harga-{{$j}}" onchange="changeSubtotal({{$j}})" placeholder="Harga Satuan" readonly value="{{$row->harga_saat_itu}}">
                                                <p id="harga-lama-{{$j}}"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div>
                                                    <input type="text" class="js-datepicker form-control datepicker" name="expired[]" placeholder="Tanggal Expired" autocomplete="off" value="{{ !is_null($row->detail_item->kadaluarsa) ? date('d/m/Y', strtotime($row->detail_item->kadaluarsa)) : '' }}">
                                                    <p class="text-warning txt-date"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <div>
                                                    <input type="text" class="form-control" name="batch[]" placeholder="Batch" value="{{$row->batch}}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
        
                                <div class="mt-3 mb-3 pb-2" id="loader" style="display: none;">
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
                            <button type="button" class="btn btn-secondary btn-square" id="close">Batalkan</button>
                            <button type="submit" class="btn btn-primary btn-square">
                                 <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection

@section('js')
    <script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
    <script type="text/javascript">
        counter = '{{$j}}';
        var mapped_detail = JSON.parse('{!! str_replace( "'", "", json_encode($mapped_detail))!!}');
        var validation = null;
        var selected_po = '{!!str_replace( "'", "", json_encode($po_selected)) ?? 'null'!!}';
        $(document).ready(function(){
            validation = validateForm();
            $('.money').mask('000.000.000.000.000', {reverse: true});
            $('#peyedia-select2').select2();
            removeItem();
            checkValidDate();
            for(x=1; x<=counter; x++)
            {
                $('#barang-select2-'+x).select2({
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
            }
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
            str = `<div class="row item-wrapper item-row gutters-tiny">
                <div class="col-md-2">
                    <div class="form-group">
                        <h1 id="harga-hid-${counter}" hidden></h1>
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
                            <input type="number" class="form-control" id="diskon-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="diskon[]" placeholder="Diskon" value="0" step=".001" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 d-none">
                    <div class="form-group">
                        <div>
                            <input type="number" class="form-control" id="ppn-`+counter+`" onchange="changeSubtotal(`+counter+`)" name="ppn[]" placeholder="PPN" value="10">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control money" id="subtotal-`+counter+`" name="subtotal[]" onchange="changeSubtotal(`+counter+`)" placeholder="Subtotal" readonly>
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
                        <div>
                            <input type="text" class="form-control" name="batch[]" placeholder="Batch" autocomplete="off">
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
            $('.money').mask('000.000.000.000.000', {reverse: true});
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
            
            $('#harga-lama-'+ideas).text('Harga Lama : '+data.harga);
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
            harga =  $('#harga-'+index).val();
            ppn = $('#ppn-'+index).val();
            subtotal = harga*jumlah;
            harga_diskon = subtotal*(100-diskon)/100;
            harga_ppn = harga_diskon + harga_diskon*ppn/100;
            $('#subtotal-'+index).val(harga_ppn);
            $('#subtotal-'+index).cleanVal();
            //$('#harga-lama-'+index).html('Harga Lama : 5000');
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
    </script>
@endsection
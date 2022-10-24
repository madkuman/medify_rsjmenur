@extends('farmasi.layouts.main')

@section('title')
Farmasi Stok Opname Baru
@endsection

@section('content')
	<div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">Buat Stok Opname</h3>
        </div>
        <div class="block-content">
            <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/stokopname')}}/new" id=form-stokopname>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                            <input type="text" class="form-control" name="keterangan" placeholder="Berikan Informasi Lebih">
                        </div>
                    </div>
                </div>

                <hr class="my-5">
                <div id="newItem">
                    <div class="col-12 ajax-container" style="padding-top: 10px;" id="itemsContainer">
                        <h5 style="margin-bottom: 15px;" id="judulBarang">NAMA BARANG</h5>
                        <!-- class="search" automagically makes an input a search field. -->
                        <input class="form-control" placeholder="Cari disini..." type="text" id="searchField" onkeyup="filterBarang(this)">
                        <!-- class="sort" automagically makes an element a sort buttons. The date-sort value decides what to sort by. -->
                        <div class="row mt-3 item-wrapper">
                            <div class="col-md-4">
                                <label for="penyedia">Barang </label>
                            </div>
                            <div class="col-md-2">
                                <label for="penyedia">Kadaluarsa </label>
                            </div>
                            <div class="col-md-2">
                                <label for="penyedia">Stok Tercatat </label>
                            </div>
                            <div class="col-md-2">
                                <label for="penyedia">Jumlah Sebenarnya </label>
                            </div>
                            <div class="col-md-2">
                                <label for="penyedia">Perbedaan </label>
                            </div>
                        </div>
                        <div class="form-items block-content" id="itemsDiv" data-toggle="slimscroll" data-always-visible="true" data-size="8px" data-height="250px">
                            @php $i=0 @endphp
                            @forelse($items as $item)
                            <div class="row item-wrapper">
                                <h6 class="nama-item d-none">{{$item->detail_item->item_detail->nama}}</h6>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <input type="hidden" name="template[]" value="{{$item->detail_item->id}}">
                                            <h6 >{{$item->detail_item->item_detail->nama}} ({{$item->detail_item->item_detail->satuan}})</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div>
                                            <input type="hidden" name="barang[]" value="{{$item->id}}">
                                            <h6>{{date('d F Y', strtotime($item->kadaluarsa))}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div>
                                            <h6 id="stok-{{++$i}}">{{$item->jumlah_sedia}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div>
                                            <input type="number" class="form-control" id="jumlah-{{$i}}" name="jumlah[]" placeholder="Jumlah" value="{{$item->jumlah_sedia}}" onchange="changePerbedaan({{$i}})">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div>
                                            <input type="hidden" name="perbedaan[]" value="0">
                                            <h6 id="perbedaan-{{$i}}">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                Belum ada barang
                            @endforelse
                        </div>
                    </div>
                    <hr class="my-5">
                </div>

                <div class="mt-3 mb-3 pb-2" id="loader">
                    <center>
                        <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddItems">
                            <i class="fa fa-plus"></i>
                        </button>
                        <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
                    </center>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-square" id="close">Batalkan</button>
                            <button type="submit" class="btn btn-primary btn-square">
                                 <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
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
        .modal-lg {
            max-width: 80% !important;
        }
        .select2-result-repository__title {
            color: black;
            font-weight: 700;
            word-wrap: break-word;
            line-height: 1.1;
            margin-bottom: 4px;
        }
        .select2-result-repository__description {
            font-size: 13px;
            color: #777;
            margin-top: 4px;
        }
        /*.no-border {
            border-top: 0 !important;
            border-right: 0 !important;
            border-left: 0 !important;
            border-bottom: 0;
            border-radius: 0 !important;
        }
        .editable-click {
            border-bottom: dashed 1px #0088cc;
        }*/
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            
        });

        var counter = 1;
        $('#btnAddItems').on('click', function(){
            counter++;
            str = 
            `<div class="row justify-content-center pt-15 item-baru">
                <div class="col-md-5">
                    <div class="form-group">
                        <div>
                            <select class="js-select2 barang-select2 form-control" id="barang-select2-`+counter+`" name="barang-baru[]" style="width: 100%;" data-placeholder="Pilih Barang">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div>
                            <input type="text" class="js-datepicker form-control" id="tanggal-datepicker-`+counter+`" name="kadaluarsa[]" placeholder="Masukkan Tanggal Kadaluarsa">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div>
                            <input type="number" class="form-control" id="jumlah-`+counter+`" name="jumlah-baru[]" placeholder="Jumlah">
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
            removeItem();
            $('#tanggal-datepicker-'+counter).datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy', 
            });
        });

        function formatBarang (item) {
            if (item.loading) {
                return item.text;
            }

            var markup = item.item_detail.nama + " ("+item.item_detail.satuan+")";

            return markup;
        }

        function formatBarangSelection (item) {
            if(item.item_detail) return item.item_detail.nama + " ("+item.item_detail.satuan+")";
            else return item.text;
        }

        function removeItem() {
            $('.btnRemove').on('click', function(){
                var wrapper = $(this).parents('.item-baru');
                wrapper.remove();
            });
        }

        function changePerbedaan(index) {
            var jumlah = $('#jumlah-'+index).val();
            var stok = $('#stok-'+index).text();
            $('#perbedaan-'+index).text(jumlah-stok);
        }

        function filterBarang(e)
        {
            if(e.value.length < 2) {
                $('.item-wrapper').css('display', '');
                return;
            }

            let filter, container, rows, i, textValue;
            filter = e.value.toLowerCase();

            container = document.getElementById('itemsDiv');
            rows = container.getElementsByClassName('item-wrapper');

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
    </script>
@endsection
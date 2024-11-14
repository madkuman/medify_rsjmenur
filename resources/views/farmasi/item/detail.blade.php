@extends('farmasi.layouts.main')

@section('title')
    Farmasi Detail Barang
@endsection


@section('css')
    <style>
        .dataTables_processing {
            background-color: white;
        }
    </style>
@endsection

@section('content')
    @if (Auth::user()->admin == 1)
        ID Item Template : {{ $item->item_detail->id }}
    @endif
    <div class="row row-deck">
        <div class="col-6">
            <div class="block">
                <div class="block-header bordered">
                    <h3 class="block-title">
                        <small>NAMA BARANG</small> <br>
                        {{ $item->item_detail->nama }} <br>

                        @forelse($item->item_detail->kategori_item as $gori)
                            <span class="badge badge-primary">{{ $gori->detail_kategori->nama }}</span>
                        @empty -
                        @endforelse
                    </h3>
                    <div class="block-options">
                        <form method="POST" action="{{ url('farmasi/' . session('farmasi')->slug . '/item/delete') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="item_id" value="{{ $item->item_template_id }}">
                        </form>
                        @if (Auth::user()->id == 188 || Auth::user()->admin == 1)
                            <button class="btn btn-alt-danger btn-square confirm-del">
                                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                            </button>
                        @endif

                        @if (isset($item->item_detail->produksi) && $item->item_detail->produksi->farmasi_id == session('farmasi')->id)
                            <button class="btn btn-alt-primary btn-square" id="produksi">
                                <i class="fa fa-gears" aria-hidden="true"></i>&nbsp;&nbsp;Lakukan Produksi
                            </button>
                        @endif
                        @if (Auth::user()->id == 188 || Auth::user()->admin == 1)
                            <button class="btn btn-alt-primary btn-square" id="edit-item">
                                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                            </button>
                        @endif
                        <button type="button" class="btn btn-alt-warning btn-square dropdown-toggle"
                            id="page-header-options-dropdown2" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Cetak
                        </button>
                        <div class="dropdown-menu" aria-labelledby="page-header-options-dropdown2">
                            <button type="button" class="dropdown-item" id="kartu-stok" style="cursor: pointer;">
                                <i class="fa fa-clipboard mr-2" aria-hidden="true"></i>Kartu Stok
                            </button>
                            <button type="button" class="dropdown-item" style="cursor: pointer;" data-toggle="modal"
                                data-target="#modal-kartu-barang">
                                <i class="fa fa-clipboard mr-2" aria-hidden="true"></i>Kartu Barang
                            </button>
                        </div>
                    </div>
                    <hr class="my-5">
                </div>
                <div class="block-content">
                    <div class="block block-transparent">
                        <div class="row">
                            <div class="col">
                                <label>HARGA SAAT INI</label>
                                <h5>Rp. {{ number_format($item->item_detail->harga) }}</h5>
                                <label>STOCK</label>
                                <h5>{{ round($item->stok, 1) }}</h5>
                                <label>SATUAN STOCK</label>
                                <h5>{{ $item->item_detail->satuan }}</h5>
                                <label>KODE KFA</label>
                                <h5>{{ $item->item_detail->kode_kfa }}</h5>
                            </div>
                            <div class="col">
                                <label>BATASAN STOCK</label>
                                <P>{{ $item->min_stok }}</P>
                                <label>BATASAN EXPIRED SOON</label>
                                @if ($item->min_kadaluarsa % 30 == 0)
                                    <p>{{ $item->min_kadaluarsa / 30 }} Bulan</p> @php $waktu = 30 @endphp
                                @elseif($item->min_kadaluarsa % 365 == 0)
                                    <p>{{ $item->min_kadaluarsa / 365 }} Tahun</p> @php $waktu = 365 @endphp
                                @else
                                    <p>{{ $item->min_kadaluarsa }} Hari</p> @php $waktu = 1 @endphp
                                @endif
                                <label>BATASAN DISTRIBUSI</label>
                                <P>{{ $item->max_distribusi ?? '-' }}</P>
                                <label>KETERANGAN</label>
                                @if ($item->consis)
                                    <p>Tersedia di CONSIS</p>
                                @endif
                                <p>{{ $item->item_detail->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Daftar Stok Barang <small>({{ $total_active }} Stok)</small></h3>
                    <div class="block-options">
                        <form method="POST"
                            action="{{ url('farmasi/' . session('farmasi')->slug . '/item/recalculate') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="item_farmasi_id" value="{{ $item->id }}">
                        </form>
                        @if ((Auth::user()->id == 3 || Auth::user()->id == 188) && session('farmasi')->slug == 'instalasi-farmasi')
                            <button type="button" class="btn btn-alt-warning btn-square" id="recalculate-stok">
                                <i class="fa fa-recycle" aria-hidden="true"></i>&nbsp;&nbsp;Recalculate
                            </button>
                        @endif
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal Kadaluarsa</th>
                                <th>Jumlah Stok</th>
                                <!-- <th>Ref. Transaksi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 @endphp
                            @foreach ($active as $act)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ date('d F Y', strtotime($act->kadaluarsa)) }}</td>
                                    <td>{{ $act->jumlah }}</td>
                                    {{-- <td class="text-info">
                            @if ($act->distribusi_id)
                            <a href="{{url('farmasi/'.session('farmasi')->slug.'/distribusi/'.$act->detail_distribusi->slug)}}">#{{$act->detail_distribusi->slug}}</a>
                            @else
                            <a href="{{url('farmasi/'.session('farmasi')->slug.'/pengadaan/'.$act->detail_pengadaan->slug)}}">#{{$act->detail_pengadaan->slug}}</a>
                            @endif
                        </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if (isset($item->item_detail->produksi))
        <div class="row row-deck">
            <div class="col-12">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Produksi</h3>
                    </div>
                    <div class="block-content">
                        <big>Komposisi Produksi</big>
                        @foreach ($item->item_detail->produksi->detail as $detail)
                            <div class="row">
                                <div class="col-4">
                                    {{ $detail->itemFarmasi->item_detail->nama }}
                                </div>
                                <div class="col-3">
                                    {{ $detail->jumlah }} {{ $detail->itemFarmasi->item_detail->satuan }}
                                </div>
                            </div>
                        @endforeach

                        <br><br><big>Riwayat Produksi</big>
                        <table class="table table-hover table-vcenter">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Produksi</th>
                                    <th>Tanggal Kadaluarsa</th>
                                    <th>Jumlah Produksi</th>
                                    <th>Detail Produksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->item_detail->produksi->transaksi as $trans)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d F Y', strtotime($trans->created_at)) }}</td>
                                        <td>{{ date('d F Y', strtotime($trans->kadaluarsa)) }}</td>
                                        <td>{{ $trans->jumlah }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row row-deck">
        <div class="col-12">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Mapping KFA</h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col">
                            {{-- <form method="POST" action="">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <input type="text" class="form-control" id="search-obat" placeholder="Cari obat...">
                                </div> --}}
                            <div class="form-group">
                                <select class="js-select2 form-control" id="obat-dropdown" name="kode_kfa">
                                    <option value="">-- Pilih Obat --</option>
                                </select>
                                <button id="simpan-kode-kfa" class="btn btn-primary mt-3">Simpan</button>
                            </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- <div class="row row-deck">
        <div class="col-12">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Mapping KFA</h3>
                </div>
                <div class="block-content">
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <input type="text" id="search-keyword" class="form-control"
                                placeholder="Masukkan nama obat">
                        </div>
                        <div class="col-lg-4">
                            <button class="btn btn-primary" id="search-button">
                                Cari</button>
                        </div>
                    </div>
                    <table class="table table-hover table-vcenter " id="search-results">
                        <thead>
                            <tr>
                                <th>Kode KFA</th>
                                <th>Nama Obat</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal Detail Obat -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama:</strong> <span id="detail-nama"></span></p>
                    <p><strong>Kode KFA:</strong> <span id="detail-kode"></span></p>
                    <p><strong>NIE:</strong> <span id="detail-nie"></span></p>
                    <p><strong>Nama Dagang:</strong> <span id="detail-nama-dagang"></span></p>
                    <p><strong>Manufacturer:</strong> <span id="detail-manufacturer"></span></p>
                    <p><strong>Registrar:</strong> <span id="detail-registrar"></span></p>
                    <!-- Tambahkan detail lain sesuai kebutuhan -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-deck">
        <div class="col-12">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Mutasi Barang</h3>
                </div>
                <div class="block-content">

                    <div class="form-group row">
                        <div class="col-lg-4">
                            <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true" data-end-date="+0d">
                                <input type="text" class="form-control mutasi-filter-date-start"
                                    autocomplete="off"name="daterange1" placeholder="From" data-week-start="1"
                                    data-autoclose="true" data-today-highlight="true"
                                    value="{{ $date_range_start_month_default->format('d-m-Y') }}" required="">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text font-w600">to</span>
                                </div>
                                <input type="text" class="form-control mutasi-filter-date-end" autocomplete="off"
                                    name="daterange2" placeholder="To" data-week-start="1" data-autoclose="true"
                                    data-today-highlight="true"
                                    value="{{ $date_range_end_month_default->format('d-m-Y') }}" required="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <button class="btn btn-primary" id="filter-mutasi"><i class="fa fa-spinner fa-spin"></i>
                                Filter</button>
                        </div>
                    </div>
                    <table class="table table-hover table-vcenter " id="mutasi-barang">
                        <thead>
                            <tr>
                                <th>Tanggal Transaksi</th>
                                <th>Jenis Transaksi</th>
                                <th>Pihak Kedua</th>
                                <th>Stok</th>
                                <th>Ref. Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('farmasi.item.modals.modal-edit')
    @include('farmasi.item.modals.modal-kartu-stok')
    @include('farmasi.item.modals.modal-kartu-barang')

    @if (isset($item->item_detail->produksi) && $item->item_detail->produksi->farmasi_id == session('farmasi')->id)
        @include('farmasi.produksi.modals.modal-produksi', ['produksi' => $item->item_detail->produksi])
    @endif
@endsection

@section('css')
    <style type="text/css">
        .bordered {
            border-bottom: 1px solid #eaecee;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        var page = 1;
        var ctr = 11;
        var cik = 1;
        var total = "{{ $total_items }}";

        $(document).ready(function() {
            getDataMutasi();

            $('.js-example-basic-multiple').select2({
                tags: true
            });

            $('.nama-interaksi-kelas-terapi').select2({
                tags: true
            });
            $('.jenis-interaksi-kelas-terapi').select2({
                tags: true
            });

            if ({!! json_encode($retriksi_bpjs_data_lab_ids) !!}) {
                $('#select-retriksi-bpjs-data-lab').val({!! json_encode($retriksi_bpjs_data_lab_ids) !!}).change();
            }
        });

        $(".nama-interaksi-kelas-terapi").select2({});
        $(".jenis-interaksi-kelas-terapi").select2({});
        $(document).on("click", "#btn-tambah-interaksi-kelas-terapi", function() {
            $(".main-div-interaksi-kelas-terapi:first").clone().appendTo("#row-interaksi-kelas-terapi");

            $(".nama-interaksi-kelas-terapi").select2({});
            $(".nama-interaksi-kelas-terapi").last().next().next().remove();
            $(".jenis-interaksi-kelas-terapi").select2({});
            $(".jenis-interaksi-kelas-terapi").last().next().next().remove();
        });

        $(".nama-interaksi-obat").select2({});
        $(".jenis-interaksi-obat").select2({});
        $(document).on("click", "#btn-tambah-interaksi-obat", function() {
            $(".main-div-interaksi-obat:first").clone().appendTo("#row-interaksi-obat");

            $(".nama-interaksi-obat").select2({});
            $(".nama-interaksi-obat").last().next().next().remove();
            $(".jenis-interaksi-obat").select2({});
            $(".jenis-interaksi-obat").last().next().next().remove();
        });

        @if (isset($item->item_detail->produksi) && $item->item_detail->produksi->farmasi_id == session('farmasi')->id)
            var produksi_detail = '{!! isset($item->item_detail->produksi->detail) ? json_encode($item->item_detail->produksi->detail) : [] !!}';
        @endif

        $('#edit-item').on('click', function() {
            $('#modal-large').modal('show');
        })
        $('#produksi').on('click', function() {
            var detail = JSON.parse(produksi_detail);
            for (var i = 0; i < detail.length; i++) {
                var formRacikan =
                    `<div class="obat-wrapper row"  data-counter="${cik}">
            <div class="col-md-5">
            <div class="form-group">
            <input type="hidden" name="detail_produksi_id[]" value="${detail[i].id}"  id="detail_produksi_id-${cik}">
            <input type="hidden" name="is_deleted[]" value="0"  id="is_deleted-${cik}">
            <select class="form-control js-select2" style="width: 100%" data-placeholder="Pilih Barang" id="barang-produksi-${i}" name="barang_produksi[]">
                <option></option>
                <option selected value='${JSON.stringify(detail[i].item_farmasi)}'>${detail[i].item_farmasi.item_detail.nama}</option>
            </select>
            </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="js-datepicker form-control" autocomplete="off" disabled id="edbarang-${i}">
                </div>
            </div>
            <div class="col-md-3">
            <div class="form-group">
            <input type="text" name="barang_jumlah[]" class="form-control" value="${detail[i].jumlah}">
            </div>
            </div>
            <div class="col-md-1">
            <button type="button" class="button-control btn btn-sm btn-danger btn-square btnRemoveRacikan">
            <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
            </div>
            </div>
            </div>`
                $('#racikan-row').append(formRacikan);
                select2Barang(i);
                removeBarang();
                $('#barang-produksi-' + i).trigger("change");
                $('#barang-produksi-' + i).trigger({
                    type: 'select2:select',
                    params: {
                        data: []
                    }
                });
                cik = i;
            }
            $('#modal-tambah').modal('show');
        });

        $('#btnAddRacikan').on('click', function() {
            cik++;
            var formRacikan =
                `<div class="obat-wrapper row" data-counter="${cik}">
        <div class="col-md-5">
        <input type="hidden" name="detail_produksi_id[]" value="0" id="detail_produksi_id-${cik}">
        <input type="hidden" name="is_deleted[]" value="0"  id="is_deleted-${cik}">
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
        </div>
        </div>`
            $('#racikan-row').append(formRacikan);
            removeBarang();
            select2Barang(cik);
        });

        $('#kartu-stok').on('click', function() {
            $('#modal-kartu-stok').modal('show');
        })

        datepicker();

        function datepicker() {
            $('.datepicker').datepicker({
                // startDate: "today",
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
            });
        }

        function removeBarang() {
            $('.btnRemoveRacikan').on('click', function() {
                var remove_racikan = $(this).parents('.obat-wrapper');
                var counter = remove_racikan.data('counter');
                if ($('#detail_produksi_id-' + counter).val() != 0) {
                    remove_racikan.hide();
                    $('#is_deleted-' + counter).val(1)
                } else {
                    remove_racikan.remove();
                }
            })
        }

        function select2Barang(counter) {
            $('#barang-produksi-' + counter).select2({
                ajax: {
                    url: API_URL + "/farmasi/{{ session('farmasi')->slug }}/item/get",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            keyword: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: $.map(data.data, function(obj) {
                                var stok = 0;
                                if (obj.stok)
                                    stok = obj.stok.aggregate;

                                var text_option = obj.item_detail.nama + " (" + obj.item_detail.satuan +
                                    ") - Stok : " + stok + " - Harga : " + obj.item_detail.harga;


                                if (obj.loading || obj.text) {
                                    text_option = obj.text;
                                    id_option = 0;
                                }
                                return {
                                    id: JSON.stringify((obj)),
                                    text: text_option
                                };
                            })
                        };
                    },
                    cache: true
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                minimumInputLength: 3,
                placeholder: "Cari Barang",
                // templateResult: formatBarang,
                // templateSelection: formatBarangSelection
            });
            $('#barang-produksi-' + counter).on('select2:select', function() {
                var val = JSON.parse($(this).val());
                var tanggal = val.kadal.kadal;
                if (val.kadal) {
                    tanggal = tanggal.split('-').reverse().join('/');
                    $('#edbarang-' + counter).val(tanggal);
                } else
                    $('#edbarang-' + counter).val('-');
            });
        }



        $('.confirm-del').on('click', function() {
            var deleteSupp = $(this).parent().find('form');
            swal({
                title: 'Apa anda yakin?',
                text: 'Data yang telah terhapus tidak dapat dikembalikan lagi, dan akan menghapus semua stok yan ada di farmasi lain',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Hapus',
                html: false,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        setTimeout(function() {
                            resolve();
                        }, 50);
                    });
                }
            }).then(function(result) {
                if (result.value) {
                    deleteSupp.submit();
                    //swal('Berhasil', 'Data berhasil dihapus.', 'success');
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Hapus data dibatalkan.', 'error');
                }
            });
        });


        $('#filter-mutasi').on('click', function() {
            getDataMutasi()
        });


        var datatable_mutasi;
        var init_data_mutasi = 1;


        function getDataMutasi() {
            var date_start = $('.mutasi-filter-date-start').val();
            var date_end = $('.mutasi-filter-date-end').val();

            var url = "{{ url('/api/farmasi/' . session('farmasi')->slug . '/item/' . $item->slug . '/mutasi') }}/" +
                date_start +
                "/" + date_end;
            $('#filter-mutasi i').show();
            $.ajax({
                type: "GET",
                url: url,
                cache: false,
                dataType: 'json',
                success: function(response) {
                    var data = [];
                    $.each(response, function(index, item) {
                        temp_array = [];
                        temp_array.push(item.tanggal);
                        temp_array.push(item.jenis_transaksi);
                        temp_array.push(item.pihak_kedua);
                        var stok = number_format_formatter.format(item.stok);
                        temp_array.push(stok);
                        var link = '';
                        console.log(item.jenis_transaksi)

                        if (item.jenis_transaksi == 'Transaksi' || item.jenis_transaksi ==
                            'Transaksi Retur')
                            link =
                            `<a href="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi') }}/` +
                            item.slug + `">#` + item.slug + `</a>`;
                        else if (item.jenis_transaksi == 'Penghapusan')
                            link =
                            `<a href="{{ url('farmasi/' . session('farmasi')->slug . '/penghapusan') }}/` +
                            item.slug + `">#` + item.slug + `</a>`;
                        else if (item.jenis_transaksi == 'Distribusi Masuk' || item.jenis_transaksi ==
                            'Distribusi Keluar')
                            link =
                            `<a href="{{ url('farmasi/' . session('farmasi')->slug . '/distribusi') }}/` +
                            item.slug + `">#` + item.slug + `</a>`;
                        else if (item.jenis_transaksi == 'Pengadaan')
                            link =
                            `<a href="{{ url('farmasi/' . session('farmasi')->slug . '/pengadaan') }}/` +
                            item.slug + `">#` + item.slug + `</a>`;

                        temp_array.push(link);


                        data.push(temp_array);
                    });


                    if (init_data_mutasi == 1) {
                        loadDataTableMutasi(data)
                        init_data_mutasi = 0;
                    } else updateDataTableMutasi(data)
                    $('#filter-mutasi i').hide();
                }
            });
        }

        function loadDataTableMutasi(dataSet) {
            datatable_mutasi = $('#mutasi-barang').DataTable({
                "data": dataSet,
                "processing": true,
                "ordering": false,
                'language': {
                    'loadingRecords': '&nbsp;',
                    'processing': '<i class="fa fa-spinner fa-spin fa-4x"></i>'
                },
                "columns": [{
                        title: "Tanggal"
                    },
                    {
                        title: "Jenis Transaksi"
                    },
                    {
                        title: "Pihak Kedua"
                    },
                    {
                        title: "Stok",
                        className: "text-right"
                    },
                    {
                        title: "Ref",
                        className: "text-right"
                    }
                ]

            });
        }



        function updateDataTableMutasi(dataSet) {
            datatable_mutasi.clear().draw();
            datatable_mutasi.rows.add(dataSet);
            datatable_mutasi.columns.adjust().draw();
        }

        $('.btn-pdf').on('click', function(e) {
            e.preventDefault();
            var pdf = '<input type="hidden" name="export_as" value="pdf">';
            var $this = $(this).parents('form');
            $this.find('.export-as').html(pdf);
            $this.unbind('submit').submit();
            $this.find('.text-warning').addClass('d-none');
        });

        $('.btn-excel').on('click', function(e) {
            e.preventDefault();
            var xls = '<input type="hidden" name="export_as" value="xls">';
            var $this = $(this).parents('form');
            $this.find('.export-as').html(xls);
            $this.unbind('submit').submit();
        });

        $('#recalculate-stok').on('click', function() {
            var deleteSupp = $(this).parent().find('form');
            swal({
                title: 'Apa anda yakin?',
                text: 'Data stok barang ini akan dihitung ulang kembali',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Recalculate',
                html: false,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        setTimeout(function() {
                            resolve();
                        }, 50);
                    });
                }
            }).then(function(result) {
                if (result.value) {
                    deleteSupp.submit();
                    //swal('Berhasil', 'Data berhasil dihapus.', 'success');
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Recalculate data dibatalkan.', 'error');
                }
            });
        });

        $(document).on("click", "#btn-tambah-indikasi", function() {
            $(".div-item-indikasi:first").clone().appendTo("#div-main-indikasi");
        });
    </script>



    {{-- <script>
        $(document).ready(function() {
            // Event ketika tombol "Cari" diklik
            $('#search-button').on('click', function(e) {
                e.preventDefault();
                let keyword = $('#search-keyword').val();

                // AJAX request untuk pencarian
                $.ajax({
                    url: "{{ route('kfa.search') }}", // Pastikan route ini menuju ke controller pencarian
                    type: "GET",
                    data: {
                        q: keyword
                    },
                    success: function(data) {
                        $('#search-results').show(); // Tampilkan tabel hasil pencarian
                        $('#search-results tbody')
                            .empty(); // Kosongkan tabel sebelum menambahkan data baru

                        // Loop hasil pencarian dan tambahkan ke tabel
                        $.each(data.items.data, function(index, item) {
                            let row = `
                            <tr>
                                <td>${item.kfa_code}</td>
                                <td>${item.name}</td>
                                <td><button class="btn btn-info btn-sm detail-button" data-kode="${item.kfa_code}">Detail</button></td>
                            </tr>`;
                            $('#search-results tbody').append(row);
                        });
                    },
                    error: function() {
                        alert("Gagal mengambil data. Silakan coba lagi.");
                    }
                });
            });

            // Event ketika tombol "Detail" diklik
            $(document).on('click', '.detail-button', function() {
                let kodeObat = $(this).data('kfa_code');

                // AJAX request untuk mengambil detail obat
                $.ajax({
                    url: "/satusehat/kfa/search/detail/{kodeObat}",
                    type: "GET",
                    success: function(data) {
                        // Isi data detail obat di modal
                        $('#detail-nama').text(data.result.name);
                        $('#detail-kode').text(data.result.kode_kfa);
                        $('#detail-nie').text(data.result.nie);
                        $('#detail-nama-dagang').text(data.result.nama_dagang);
                        $('#detail-manufacturer').text(data.result.manufacturer);
                        $('#detail-registrar').text(data.result.registrar);
                        // Tambahkan field lain jika diperlukan

                        // Tampilkan modal
                        $('#detailModal').modal('show');
                    },
                    error: function() {
                        alert("Gagal mengambil detail produk. Silakan coba lagi.");
                    }
                });
            });
        });
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            $('#obat-dropdown').on('keyup', function() {
                let keyword = $(this).val();

                if (keyword.length >= 3) { // Trigger saat ada minimal 3 karakter
                    $.ajax({
                        url: "{{ route('kfa.search') }}",
                        type: "GET",
                        data: {
                            q: keyword
                        },
                        success: function(data) {
                            $('#obat-dropdown').empty(); // Kosongkan opsi sebelumnya
                            $('#obat-dropdown').append(
                                '<option value="">-- Pilih Obat --</option>');

                            // Menambahkan opsi hasil pencarian ke dropdown
                            $.each(data['items']['data'], function(index, item) {
                                $('#obat-dropdown').append(
                                    `<option value="${item.kfa_code}"> ${item.kfa_code} | ${item.name}</option>`
                                );
                            });
                        },
                        error: function() {
                            alert("Gagal mengambil data. Silakan coba lagi.");
                        }
                    });
                }
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('#obat-dropdown').select2({
                placeholder: "-- Pilih Obat --",
                allowClear: true,
                minimumInputLength: 3, // Mulai pencarian saat minimal 3 karakter
                ajax: {
                    url: "{{ route('kfa.search') }}",
                    dataType: 'json',
                    delay: 250, // Penundaan 250ms untuk mengurangi request saat mengetik
                    data: function(params) {
                        return {
                            q: params.term // Mengirimkan input pencarian
                        };
                    },
                    processResults: function(data) {
                        // Map data hasil dari API ke format Select2
                        return {
                            results: $.map(data['items']['data'], function(item) {
                                return {
                                    id: item.kfa_code,
                                    text: item.kfa_code + " | " + item.name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            // Event listener untuk tombol "Simpan"
            $('#simpan-kode-kfa').on('click', function() {
                // Ambil nilai kfa_code yang dipilih dari Select2
                let selectedKfaCode = $('#obat-dropdown').val();

                if (selectedKfaCode) {
                    $.ajax({
                        url: "{{ route('kfa.update') }}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            kfa_code: selectedKfaCode,
                            item_template_id: '{{ $item->item_detail->id }}'
                        },
                        success: function(response) {
                            alert(response.message); // Menampilkan pesan sukses
                        },
                        error: function() {
                            alert("Gagal menyimpan kode KFA. Silakan coba lagi.");
                        }
                    });
                } else {
                    alert("Pilih kode KFA terlebih dahulu.");
                }
            });
        });
    </script>
@endsection

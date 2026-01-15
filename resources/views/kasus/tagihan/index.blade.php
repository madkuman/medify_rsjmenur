@extends('kasus.layouts.main')

@section('title')
    {{ $kasus->judul_kasus }} - Penunjang - Kasus
@endsection

@section('css')
    <style type="text/css">
        .is-invalid .select2-selection {
            border-color: rgb(185, 74, 72) !important;
        }
    </style>
@endsection

@section('content')

    <!-- Main Container -->
    <main id="main-container">
        @include('kasus.layouts.header')

        <div class="content">
            <div class="row">
                @include('kasus.layouts.sidebar')


                <!-- Updates -->
                <div class="col-lg-9 col-xl-9">
                    <div class="row">
                        <div class="col-lg-12">
                            @include('kasus.tagihan.navbar')

                            @if (!empty(session('my_role_' . $kasus->nomor_kasus)))
                                @php $my_role = 1 @endphp
                            @else
                                @php
                                    $my_role = 0;
                                @endphp
                            @endif
                            @if ($my_role == 1)
                                @if (session('my_role_' . $kasus->nomor_kasus)->admin == 1)
                                    @php $my_role_admin = 1 @endphp
                                @else
                                    @php $my_role_admin = 0 @endphp
                                @endif
                            @endif


                            @foreach ($tagihans as $tagihan)
                                <div class="block rounded @if (!$loop->first) block-mode-hidden @endif">

                                    <div class="block-header">
                                        <h3 class="block-title">Tagihan #{{ $tagihan->id }} - (Rp
                                            {{ number_format($tagihan->total_sum, 0) }})</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                                data-action="content_toggle"></button>
                                        </div>
                                    </div>
                                    <div class="block-content">
                                        @if ($my_role && empty($tagihan->checkout_at))
                                            <button type="button"
                                                class="btn-alt btn-rounded btn-primary min-width-125 float-right"
                                                data-toggle="modal" onclick="showModalCreate({{ $tagihan->id }})"
                                                data-target="#tambahTagihan"><i class="fa fa-plus"></i> Tambah
                                                Tagihan</button>
                                        @endif
                                        <a href="javascript:void(0)"
                                            onclick="printTagihan('{{ url()->current() }}/print/{{ $tagihan->id }}')"
                                            class="btn-alt btn-grass float-right">Print</a>
                                        <a href="javascript:void(0)"
                                            onclick="printTagihan('{{ url()->current() }}/print/{{ $tagihan->id }}?ipwl=1')"
                                            class="btn-alt btn-info float-right">Print IPWL</a>
                                        @if (
                                            (\Illuminate\Support\Facades\Auth::user()->profesi == 20 || \Illuminate\Support\Facades\Auth::user()->id == 3) &&
                                                $tagihan->is_paid == 0)
                                            <button class="btn-alt btn-rounded btn-warning float-right"
                                                onclick="showModalSplit({{ $tagihan->id }})"> Split</button>
                                            @if (!$tagihan->checkout)
                                                <button class="btn-alt btn-rounded btn-warning min-width-125 float-right"
                                                    onclick="showModalPindahTagihan({{ $tagihan->id }})"><i
                                                        class="fa fa-random"></i> Pindahkan Tagihan</button>
                                            @endif
                                        @endif
                                        @if ($tagihan->show_sync)
                                            <button class="btn-alt btn-rounded btn-primary min-width-125"
                                                onclick="showModalSyncTagihan({{ $tagihan->id }})"><i
                                                    class="fa fa-sync"></i> Sinkronisasi Tagihan</button>
                                        @endif

                                    </div>
                                    <div class="block-content">
                                        @php $i = 0 @endphp
                                        @php
                                            $count = 0;
                                            $curr_date = '00/00/0000';
                                        @endphp
                                        @foreach ($tagihan->detail as $detail)
                                            @php $i = 1 @endphp
                                        @endforeach

                                        @if ($i)
                                            <div class="table-responsive detail-tagihan-{{ $tagihan->id }}">
                                                <table class="table table-striped table-vcenter">
                                                    <thead>
                                                        <tr>
                                                            <th>Uraian</th>
                                                            <th class="text-center" style="width: 20%;">Harga Satuan</th>
                                                            <th class="text-center" style="width: 10%;">Jumlah</th>
                                                            <th class="text-center" style="width: 20%;">Subtotal</th>
                                                            <th class="text-center" style="width:150px">Opsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($tagihan->detail_descending as $detail)
                                                            @if (date('d F Y', strtotime($curr_date)) != date('d F Y', strtotime($detail->created_at)))
                                                                <tr class="table-warning">
                                                                    <td colspan="5" class="text-center">
                                                                        {{ date('d F Y', strtotime($detail->created_at)) }}
                                                                    </td>
                                                                </tr>
                                                                @php $curr_date = $detail->created_at; @endphp
                                                            @endif
                                                            <tr data-detail-id="{{ $detail->id }}">
                                                                <td class="font-w400">
                                                                    {{ $detail->lokasi->nama or '-' }} -
                                                                    {{ $detail->creator->name or '-' }}
                                                                    <h5 class="mb-1 mt-1">{{ $detail->desc or '-' }}</h5>
                                                                    <span class="badge badge-primary mt-5">
                                                                        {{ date('d F y, H:i', strtotime($detail->created_at)) }}
                                                                    </span>
                                                                    @if (!empty($detail->sep_id))
                                                                        <p>SEP : {{ $detail->sep->no_sep or '-' }}</p>
                                                                    @endif
                                                                </td>
                                                                <td class="h5 font-w400">Rp <span
                                                                        style="float:right">{{ number_format($detail->unit_price, 0) }}</span>
                                                                </td>
                                                                <td class="h5 font-w400 text-center">
                                                                    {{ $detail->qty or '-' }}</td>
                                                                <td class="h5 font-w400">Rp <span
                                                                        style="float:right">{{ number_format($detail->subtotal, 0) }}</span>
                                                                </td>
                                                                <td class="text-center opsi-element">

                                                                    @if ($my_role)
                                                                        @if (empty($detail->flag_ipwl_at))
                                                                            <button type="button"
                                                                                class="btn btn-circle btn-alt-secondary mr-5 mb-5"
                                                                                onclick="flagIpwl({{ $detail->id }})"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                data-original-title="Tandai Klaim IPWL">
                                                                                <i class="fa fa-flag"></i>
                                                                            </button>
                                                                        @else
                                                                            <button type="button"
                                                                                class="btn btn-circle btn-alt-danger mr-5 mb-5"
                                                                                onclick="flagIpwl({{ $detail->id }})"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                data-original-title="Hilangkan Tanda Klaim IPWL">
                                                                                <i class="fa fa-flag"></i>
                                                                            </button>
                                                                        @endif
                                                                        @if (!$tagihan->checkout)
                                                                            @if (
                                                                                $my_role_admin == 1 ||
                                                                                    $detail->created_by == Auth::user()->id ||
                                                                                    $detail->created_by == 1 ||
                                                                                    Auth::user()->admin == 1 ||
                                                                                    Auth::user()->id == 86 ||
                                                                                    Auth::user()->id == 168 ||
                                                                                    Auth::user()->profesi == 15)
                                                                                <button type="button"
                                                                                    class="btn btn-circle btn-alt-info mr-5 mb-5"
                                                                                    onclick="showModalEdit({{ $detail->id }})">
                                                                                    <i class="fa fa-pencil"></i>
                                                                                </button>
                                                                                <button type="button"
                                                                                    class="btn btn-circle btn-alt-danger mr-5 mb-5"
                                                                                    onclick="showModalDelete({{ $detail->id }})">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </button>
                                                                            @endif
                                                                        @endif
                                                                    @endif


                                                                    @if (!empty($detail->flag_ipwl_at))
                                                                        <span class="badge badge-info">Klaim IPWL</span>
                                                                    @endif

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr class="hide-element">
                                                            <td colspan="3">
                                                                <h4 class="mb-5 mt-5 pull-right">Total</h4>
                                                            </td>
                                                            <td colspan="2">
                                                                <h4 class="mb-5 mt-5">Rp
                                                                    <span>{{ number_format($tagihan->total_sum, 0) }}</span>
                                                                </h4>
                                                            </td>
                                                        </tr>
                                                        @if ($tagihan->total_paid > 0)
                                                            <tr class="hide-element">
                                                                <td colspan="3">
                                                                    <h4 class="mb-0 pull-right">Pembayaran</h4>
                                                                </td>
                                                                <td>
                                                                    <h4 class="mb-0">Rp <span
                                                                            style="float:right">{{ number_format($tagihan->total_paid, 0) }}</span>
                                                                    </h4>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                                @if (!$tagihan->checkout)
                                                    @if ($my_role)
                                                        <button
                                                            class="btn-alt btn-grass text-uppercase mb-10 mb-20 hide-element pull-right"
                                                            type="button"
                                                            onclick="showModalCheckout({{ $tagihan->id }})">Checkout</button>
                                                    @endif
                                                @else
                                                    @if ($my_role && $tagihan->is_paid == 0)
                                                        <button
                                                            class="btn-alt btn-danger text-uppercase mb-10 mb-20 pull-right hide-element"
                                                            type="button"
                                                            onclick="tolakTransaksi({{ $tagihan->id }})">Batalkan
                                                            Checkout</button>
                                                    @elseif($tagihan->is_paid == 1)
                                                        <span class="badge badge-success hide-element"> <i
                                                                class="fa fa-check mr-5"></i> Tagihan Telah Dibayar
                                                        </span><br>
                                                    @endif
                                                    Di checkout ke {{ $tagihan->piutang->kasir->nama ?? '-' }} pada : <br>
                                                    {{ $tagihan->checkout_at_formatted }}
                                                @endif
                                            </div>
                                        @else
                                            <div class="text-center py-50">
                                                <h4 class="font-w400 mb-5">Belum ada tagihan tersedia</h4>
                                                <p>Klik tombol <b>Tambah Tagihan</b> untuk menambahkan tagihan baru</p>
                                            </div>
                                        @endif
                                        @php
                                            $arr_warning = [];
                                            if (
                                                $kasus->penunjangRadiologi
                                                    ->where('result_created_at', null)
                                                    ->where('kirim_kasir', 0)
                                                    ->count() > 0
                                            ) {
                                                $arr_warning[] = 'Penunjang Radiologi Belum Terkonfirmasi';
                                            }
                                            if (
                                                $kasus->penunjang_labpk
                                                    ->where('result_created_at', null)
                                                    ->where('kirim_kasir', 0)
                                                    ->count() > 0
                                            ) {
                                                $arr_warning[] = 'Penunjang LAB PK Belum Terkonfirmasi';
                                            }
                                            $kasus_transaksi_belum_konfirm = $kasus->transaksiObat
                                                ->where('status_kasir', 0)
                                                ->where('dikerjakan_at', null);
                                            if ($kasus_transaksi_belum_konfirm->count() > 0) {
                                                foreach ($kasus_transaksi_belum_konfirm as $item_transaksi) {
                                                    $arr_warning[] =
                                                        'Resep Obat dari farmasi <b>' .
                                                        ($item_transaksi->owner_detail->nama ??
                                                            'tidak ditemukan mohon melakukan alih resep terlebih dahulu melalui tautan tersebut') .
                                                        '</b> dengan nomor resep <a href="javascript:void(0)">' .
                                                        ($item_transaksi->no_resep ?? 'Tidak ditemukan') .
                                                        '</a> Belum Terkonfirmasi';
                                                }
                                            }
                                        @endphp
                                        @if (count($arr_warning) != 0)
                                            <div class="alert alert-warning mb-0" role="alert">
                                                Transaksi berikut masih belum selesai :
                                                <ul class="mt-2">
                                                    @foreach ($arr_warning as $warning_message)
                                                        <li>{!! $warning_message !!}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- END Updates -->
                <form method="POST" action="{{ url()->current() }}/tolak" id="formTolak">
                    {{ csrf_field() }}
                    <input type="hidden" id="tolakId" name="id">
                    <input type="hidden" name="nomor_kasus" value="{{ $kasus->nomor_kasus }}">
                </form>
            </div>
        </div>
    </main>
    <!-- END Main Container -->

    @include('kasus.tagihan.create')
    @include('kasus.tagihan.edit')
    @include('kasus.tagihan.delete')
    @include('kasus.tagihan.checkout')
    @include('kasus.tagihan.sync-tagihan')
    @include('kasus.tagihan.split')
@endsection

@section('js')
    <script type="text/javascript">
        function showModal() {
            $('#modal').modal('show');
        }
    </script>

    <script type="text/javascript">
        tagihan_collection = @json($tagihans->where('checkout', '!=', 1)->keyBy('id')->toArray(), JSON_PRETTY_PRINT);

        function tolakTransaksi(id) {
            swal({
                title: 'Apa anda yakin membatalkan permintaan checkout?',
                type: 'warning',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-outline-danger',
                showCancelButton: true,
                confirmButtonText: 'Ya, Batalkan Permintaan',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $('#tolakId').val(id)
                    $('#formTolak').submit()
                }
            })
        }

        $('#tarifLoading').hide();

        function updateCreateSubTotal() {
            var unit_price = $('#tagihanCreateUnitPrice').val();
            var qty = $('#tagihanCreateQty').val();
            var subtotal = unit_price * qty;
            subtotal = numberWithCommas(subtotal);
            $('#tagihanCreateSubTotalMask').val(subtotal);
        }

        const numberWithCommas = (x) => {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function showModalCreate(id) {
            var input = $('#tagihanCreateTagihanID').val(id);
        }

        function confirmCheckout() {
            swal({
                title: 'Apakah anda yakin untuk checkout?',
                text: "Anda tidak dapat lagi untuk menambahkan tagihan",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Checkout Pasien!',
                confirmButtonClass: 'btn btn-primary ml-10',
                cancelButtonClass: 'btn btn-outline-danger ',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('#tagihanCheckout').submit();
                }
            })
        }

        var currentPercent = 100;
        var createTagihanLastDesc = '';

        var AutoCompleteCreateTagihan = function() {

            var ListLayanan = {};

            var initAutoCompleteIndex = function() {
                // Init autocomplete functionality
                jQuery('.tagihan-autocomplete').autoComplete({
                    minChars: 3,
                    delay: 200,
                    source: function(term, suggest) {
                        term = term.toLowerCase();
                        kelas_id = $('#tagihanCreateTarifKelasID').val();
                        tipe_id = $('#tagihanCreateTarifTipeID').val();

                        $.ajax({
                            url: API_URL + "/keuangan/tarif/search?keyword=" + term +
                                "&kelas=" + kelas_id + "&tipe=" + tipe_id,
                            type: 'GET',
                            dataType: 'json',
                            tryCount: 0,
                            retryLimit: 3,
                            success: function(response) {
                                data = response;
                                suggest(data);
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                if (textStatus == 'timeout') {
                                    this.tryCount++;
                                    if (this.tryCount <= this.retryLimit) {
                                        $.ajax(this);
                                        return;
                                    }
                                    return;
                                }
                                if (xhr.status == 500) {
                                    alert('error 500 - silahkan coba lagi');
                                } else {
                                    alert('error, silahkan coba lagi');
                                }
                            }
                        });
                    },
                    renderItem: function(item, search) {
                        var value = item['deskripsi'];
                        var show = item['deskripsi'] + '-' + item['tags'];
                        content = '<div class="autocomplete-suggestion border-bottom" data-harga="' +
                            item['harga'] + '" data-id="' + item['id'] + '" data-tarif_id="' + item[
                                'tarif_id'] + '" data-tarif_master_id="' + item['tarif_master_id'] +
                            '" data-persen="' + item['persen'] + '" data-val="' + value + '">'
                        content += '<div class="autocomplete-content-top">' + item['deskripsi'] +
                            '</div>'
                        content += '<div class="autocomplete-content-bottom text-muted">' + item[
                            'kategori_all'] + '</div>'
                        content += '</div>'
                        return content;
                    },
                    onSelect: function(event, term, item) {
                        $('#tarifLoading').show();

                        if (item.data('persen') > 0) {
                            $('#tagihanCreatePercent').parent().show(500);
                            currentPercent = item.data('persen');
                        } else {
                            $('#tagihanCreatePercent').parent().hide(500);
                            $("#tagihanCreateUnitPrice").val(item.data('harga'));
                        }
                        $("#tagihanCreateQty").val(1);
                        console.log(item)
                        console.log(item.data)
                        console.log(item.data('tarif_id'))
                        console.log(item.data('tarif_master_id'))
                        $("#tagihanCreateTarifID").val(item.data('tarif_id'));
                        $("#tagihanCreateTarifMasterID").val(item.data('tarif_master_id'));

                        $('#tarifLoading').hide();
                        updateCreateSubTotal()

                        createTagihanLastDesc = item.data('val');

                    }
                });
            };

            return {
                init: function() {
                    // Init jQuery AutoComplete example
                    initAutoCompleteIndex();
                }
            };
        }();

        jQuery(function() {
            AutoCompleteCreateTagihan.init();
        });

        function emptyDaftarHargaID() {
            var current_desc = $(".tagihan-autocomplete").val();

            if (current_desc !== createTagihanLastDesc) {
                $("#tagihanCreateTarifID").val('');
                $("#tagihanCreateTarifMasterID").val('');
            }
        }

        function emptyCreateTagihanDetail() {
            $('#tagihanCreateTarifID').val('')
            $('#tagihanCreateTarifMasterID').val('')
            $('#tagihanCreateDeskripsi').val('')
            $('#tagihanCreatePercent').val('')
            $('#tagihanCreateUnitPrice').val(0)
            $('#tagihanCreateQty').val(1)
            $('#tagihanCreateSubTotalMask').val(0)
        }

        $('#tagihanCreatePercent').on("select2:select", function(e) {
            var unit_price_percent = $(this).val();
            $("#tagihanCreateUnitPrice").val(unit_price_percent * currentPercent / 100);
            updateCreateSubTotal();
        });
        $('#tagihanCreateTarifTipeID').on("select2:select", function(e) {
            emptyCreateTagihanDetail();
        });
    </script>


    <script type="text/javascript">
        function printTagihan(url) {
            window.open(
                url, "popUpWindow",
                "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes"
                );
        }


        $('#submitCheckout').click(function(event) {
            if ($('#selectKasir').val() == '') {
                event.preventDefault();
                $('#selectKasir').parent().addClass('is-invalid');
                $('#error-kasir').remove();
                $('#selectKasir').parent().append(
                    "<div class='invalid-feedback' id='error-kasir'>Pilih Kasir Terlebih Dahulu</div>");

            }
        });
        $('#selectKasir').on("select2:select", function(e) {
            $('#selectKasir').parent().removeClass('is-invalid');
            $('#error-kasir').remove();
        });

        function updateEditSubTotal() {
            var unit_price = $('#tagihanEditUnitPrice').val();
            var qty = $('#tagihanEditQty').val();
            var subtotal = unit_price * qty;
            subtotal = numberWithCommas(subtotal);
            $('#tagihanEditSubTotalMask').val(subtotal);
        }


        function showModalEdit(id) {
            $('#loading-top').fadeIn();
            $.ajax({
                url: API_URL + "/kasus/{{ $kasus->nomor_kasus }}/tagihan/detail/" + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#tagihanEditID').val(response.id);
                    $('#tagihanEditTagihanID').val(response.tagihan_id);
                    $('#tagihanEditDesc').val(response.desc);
                    $('#tagihanEditUnitPrice').val(response.unit_price);
                    $('#tagihanEditQty').val(response.qty);
                    $('#tagihanEditSubTotalMask').val(response.subtotal);
                    $('#tagihanEditTarifID').val(response.tarif_id);
                    $('#tagihanEditTarifKelas').val(response.tarif_kelas);
                    $('#tagihanEditSelectSEP').val(response.sep_id).trigger('change');
                    created_at = response.created_at;
                    created_at = created_at.split(' ');
                    result_created_at = created_at[0].split('-');
                    result_time = created_at[1].split(':');
                    result_hour = result_time[0]
                    result_menit = result_time[1]

                    $('#tagihanEditTanggalTransaksi').val(result_created_at[2] + '-' + result_created_at[1] +
                        '-' + result_created_at[0]);
                    $('#tagihanEditJamTransaksi').val(result_hour).trigger('change')
                    $('#tagihanEditMenitTransaksi').val(result_menit).trigger('change')
                    $('#loading-top').hide();
                    $('#editTagihan').modal('show');
                },
                error: function() {},
            });

        }
        $('#tarifEditLoading').hide();

        function flagIpwl(id) {
            window.location.href = '{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/tagihan-detail/flag-ipwl/' + id;
        }

        function emptyEditDaftarHargaID() {
            var edit_current_desc = $(".tagihan-autocomplete-edit").val();

            if (edit_current_desc !== editTagihanLastDesc) {
                $("#tagihanCreateDaftarHargaID").val('');
            }
        }


        function showModalDelete(id) {
            $('#tagihanDeleteID').val(id)
            $('#tagihanModalDelete').modal('show');
        }

        function showModalCheckout(id) {
            $('#tagihanCheckoutID').val(id)
            $('#checkoutTagihan').modal('show');
        }

        function showModalSyncTagihan(id) {
            $('#tagihanSyncID').val(id)
            $('#modalSyncTagihan .title-number').text(id)
            $('#modalSyncTagihan').modal('show');
        }

        function showModalSplit(id) {
            $('#tagihanSplitID').val(id)
            $('#modalSplitTagihan .title-number').text(id)
            $('#modalSplitTagihan').modal('show');
        }

        function showModalPindahTagihan(tagihan_id) {
            var option = [];
            $('#tujuanTagihanId').html('');
            $('#fromTagihanId').val(tagihan_id);
            $.each(tagihan_collection, function(index, val) {
                if (index != tagihan_id) {
                    option.push({
                        id: val.id,
                        text: 'Tagihan #' + val.id + ' - Rp ' + numeral(val.total_bill).format('0,0')
                    });
                }
            });

            if (option.length == 0) option.push({
                id: "0",
                text: "Tujuan tagihan tidak tersedia"
            });
            $('#tujuanTagihanId').select2({
                data: option
            })

            $('#modalPindahkanTagihan').modal('show');
            $('#modalPindahkanTagihan').find('#detailContent').html('');

            detail_content = $('.detail-tagihan-' + tagihan_id).clone();
            $('#modalPindahkanTagihan').find('#detailContent').html(detail_content)
            $('#modalPindahkanTagihan').find('#detailContent').find('.hide-element').remove();
            $('#detailContent .opsi-element').each(function() {
                detail_id = $(this).parents('tr').data('detail-id');
                $(this).html(`<label class="css-control css-control-success css-checkbox">
                <input name="detail_selected[]" type="checkbox" class="css-control-input" value="${detail_id}">
                <span class="css-control-indicator"></span>
            </label>`);
            });
        }

        $(document).on('click', 'input[name=detail_select_all]', function() {
            if ($(this).prop('checked') == true) {
                $('#detailContent').find('input[type=checkbox]').prop('checked', true);
            } else {
                $('#detailContent').find('input[type=checkbox]').prop('checked', false);
            }
        });
    </script>
@endsection

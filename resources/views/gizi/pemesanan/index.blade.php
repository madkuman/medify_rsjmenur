@extends('gizi.layouts.index')

@section('title')
    Medify - Gizi Pemesanan
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    <div class="content">
        <div class="block p-10">
            <div class="block-header">
                <h6 class="block-title">
                    Daftar Pemesanan Makanan
                    <small><a href="{{url('gizi/pemesanan/baru')}}" class="pull-right mr-15"><i class="fa fa-plus-circle"></i> Buat Permintaan</a></small>
                    <small><a href="#" class="pull-right mr-15" id="print-label"><i class="fal fa-print"></i> Print Label Makanan</a></small>
                </h6>
            </div>
            <div class="block-content" id="filter">
                <form action="{{url()->current()}}" method="GET">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Tanggal</label>
                                 <div class="input-group">
                                       <input type="text" class="js-datepicker form-control" id="filter-tanggal" name="tanggal" data-week-start="1" data-autoclose="true"
                                                   data-date-format="dd-mm-yyyy" autocomplete="off" data-today-highlight="true"
                                                   @if(!empty($tanggal))
                                                   {
                                                   value="{{$tanggal}}"
                                                   }
                                                    @endif
                                       >
                                 </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <label>Waktu Makan</label>
                            <div class="form-group">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="radio" class="css-control-input" id="waktu-makan-pagi" name="waktu_makan" @if($waktu_makan == 1) checked @endif value="1">
                                    <span class="css-control-indicator"></span>Waktu Pagi
                                </label>
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="radio" class="css-control-input" id="waktu-makan-siang" name="waktu_makan" @if($waktu_makan == 2) checked @endif value="2">
                                    <span class="css-control-indicator"></span>Waktu Siang
                                </label>
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="radio" class="css-control-input" id="waktu-makan-sore" name="waktu_makan" @if($waktu_makan == 3) checked @endif value="3">
                                    <span class="css-control-indicator"></span>Waktu Sore
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mt-20">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active tab-rekap-ruangan-nav" data-toggle="tab" href="#nav-tab-rekap-ruangan">Rekap Ruangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-default-nav tab-rekap-diet-nav" data-toggle="tab" href="#nav-tab-rekap-diet">Rekap Diet</a>
                </li>
            </ul>
            <div class="block-content tab-content">
                <div class="tab-pane tab-rekap-diet-content tab-default-content" id="nav-tab-rekap-diet" role="tabpanel">
                <div class="row">
                    @foreach($rekap_pesanan as $key => $item)
                        <div class="col-md-3">
                            <div class="block block-rounded block-bordered block-link-pop block-mode-hidden">
                                <div class="block-header block-header-default" style="border-color: #42a5f5;border-width: 2px;border-style: solid;">
                                        <h6 class="text-uppercase">{{$key}}</h6>
                                        <h6 class="text-uppercase">{{$item->jumlah}}</h6>
                                        @foreach($item as $index=> $list)
                                            @if($list)
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                        </div>
                                                @break
                                            @endif
                                            @endforeach
                                </div>
                                <div class="block-content block-content-full"style="border-color: #42a5f5;border-width: 2px;border-style: solid;">
                                    @foreach($item as $index=> $list)
                                        <h6 class="text-uppercase">Volume {{$index}} = {{$list}}</h6>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                </div>
                <div class="tab-pane active tab-rekap-ruangan-content" id="nav-tab-rekap-ruangan" role="tabpanel">
                <table class="table table-hover table-vcenter" id="pemesanan">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Bangsal</th>
                        <th>Ruangan</th>
                        <th>Pasien</th>
                        <th>Kelas</th>
                        <th>Jenis Makanan</th>
                        <th>Diet</th>
                        <th>Makanan Tambahan</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    @include('gizi.pemesanan.components.modal-print-label')
    @include('gizi.pemesanan.components.modal-edit')
@endsection

@section('js')

    <script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script type="text/javascript">
        $('#print-label').on('click', function(){
            $('#modal-print-label').modal('show');
        });

        function getWaktuMakan(){
            var option = [];
            if ($('#makanan_bayi').is(':checked')) {
                option.push({
                    id: '4',
                    text: 'Snack Pagi',
                });
            }else{
                option.push({
                    id: '1',
                    text: 'Makan Pagi',
                });
                option.push({
                    id: '2',
                    text: 'Makan Siang',
                });
                option.push({
                    id: '3',
                    text: 'Makan Sore',
                });
                option.push({
                    id: '4',
                    text: 'Snack Pagi',
                });
                option.push({
                    id: '5',
                    text: 'Snack Sore',
                });
            }
            $('#waktu_makan_id').html('').select2();
            $('#waktu_makan_id').select2({
                data: option
            });
        }

        $(document).on('submit', '.form-print', function(){
            window.open('', 'newwindow', `width=${screen.width},height=${screen.height}`);
            this.target = 'newwindow';
            $(this).submit();
            $(this).unbind();
        });
        $(document).ready( function () {
            var tanggal = $("#filter-tanggal").val();
            var waktu_makan=1;
            if($("#waktu-makan-pagi").is(":checked")){
                waktu_makan=1;
            }else if($("#waktu-makan-siang").is(":checked")){
                waktu_makan=2;
            }else if($("#waktu-makan-sore").is(":checked")){
                waktu_makan=3;
            }

            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            var table = $('#pemesanan').DataTable({
                fixedHeader: {
                    header: true,
                },
            searching: true,
            ordering: false,
            processing: true,
            serverSide: true,
            pageLength: 10,
            responsive: true,
            scrollY: "calc( 100% - 70px )",
            scrollCollapse: true,
            ajax: {
                dataSrc: "data",
                url: API_URL+'/gizi/pemesanan/load-data',
                type :'GET',
                data :{
                    tanggal : tanggal,
                    waktu_makan : waktu_makan,
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                { data: 'DT_Row_Index' },
                { data: 'bangsal' },
                { data: 'ruangan' },
                { data: 'pasien' },
                { data: 'kelas' },
                { data: 'jenis_makanan' },
                { data: 'diet' },
                { data: 'makanan_tambahan' },
                { data: 'catatan' },
                { data: 'aksi' },
            ],
            order: [[1, 'asc']],
            columnDefs: [
                { "visible": false, "targets": 0 },
                { "visible": false, "targets": 1 }
            ],
                drawCallback: function (settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(1, {
                        page: 'current'
                    }).data().each(function (group, i) {
                        if (last !== group.nama) {
                            $(rows).eq(i).before(
                                '<tr class="group text-center" style="background-color: #3BAB83"><td colspan="8" class="font-w600">Bangsal '+group.nama+'</td></tr>'
                            );

                            last = group.nama;
                        }
                    });
                },
        });
        });

        function modal_order_edit(id) {
            $.ajax({
                url: API_URL + '/gizi/pemesanan/edit/' + id,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    swal({
                        html: `<h4>Mengambil data...</h4><span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>`,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                },
                success: function (data) {
                    var makanan_tambahan = JSON.parse(data.makanan_tambahan_ids)
                    swal.close();
                    $("#select-jenismakanan").val(data.jenis_makanan_id).trigger('change');
                    $("#select-diet").val(data.diet_id).trigger('change');
                    $.each( makanan_tambahan, function( key, value ) {
                        $("#select-makanantambahan option[value=" + value + "]").attr('selected', 'selected');
                    });
                    $("#select-makanantambahan").trigger('change')
                    $("#catatan-input").html(data.catatan);
                    $("#pemesanan_detail_id").val(id);
                    $('#loading-edit-order').hide();
                    $('#content-edit-order').show();
                    $("#modal-order-edit").modal('show');
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    swal.close();
                    console.log(XMLHttpRequest, textStatus, errorThrown);
                },
            });
        }

        function modal_order_delete(id){
            swal({
                title: "Hapus?",
                text: "Anda yakin ingin menghapus, lanjutkan?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "hapus",
                cancelButtonText: 'Batal',
            })
                .then((willDelete) => {
                    if (willDelete.value) {
                        order_delete(id);
                    }
                });
        }

        function order_delete(id) {
            $.ajax({
                type: "GET",
                url: API_URL + "/gizi/pemesanan/delete/"+id,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    swal({
                        html: `<h4>Menghapus data...</h4><span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>`,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                },
                success: function (res) {
                    swal.close();
                    if(res != 200){
                        callSwal('warning', "Gagal menghapus, silahkan coba lagi.", 0, "");
                        return;
                    }else{
                        callSwal('success', 'Berhasil dihapus', '', "");
                        window.location.reload();
                    }
                },
                error: function (error) {
                    swal.close();
                    callSwal("warning", "Gagal menghapus, silahkan coba lagi.", 0, "");
                    return;
                }
            });
        }
    </script>
@endsection
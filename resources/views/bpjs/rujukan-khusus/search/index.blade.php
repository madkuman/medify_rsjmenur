@extends('bpjs.layouts.main')

@section('title')
Daftar Rujukan Khusus
@endsection

@section('subtitle')
Daftar Rujukan Khusus
@endsection

@section('css')
<style type="text/css">
</style>
@endsection

@section('content')
<main id="main-container">
    @include('bpjs.layouts.navbar')
    <div class="container">
        <div class="row row-deck">
            <div class="col-sm-12">
                <div class="block rounded">
                    <div class="block-header">
                        <h3 class="block-title">Daftar Rujukan Khusus</h3>
                        <div class="block-options">
                            <a href="{{ url('') }}/bpjs/rujukan-khusus/create" class="btn btn-primary">Buat Rujukan Khusus</a>
                            {{-- <a href="{{ url('') }}/bpjs/rujuk-balik/search" class="btn btn-primary">Cari dengan Nomor</a> --}}
                        </div>
                    </div>
                    <div class="block-content">
                    <div class="row">
                        {{-- <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">Sumber Data</label>
                                <select class="form-control" data-size="5" id="filter-source" tabindex="-1" aria-hidden="true">
                                    <option value="rs">RS</option>
                                    <option value="bpjs">BPJS</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">Bulan</label>
                                <select class="form-control js-select2" id="filter-month" tabindex="-1" aria-hidden="true">
                                    <option value="1" @if (date('m') == 1) selected @endif>Januari</option>
                                    <option value="2" @if (date('m') == 2) selected @endif>Februari</option>
                                    <option value="3" @if (date('m') == 3) selected @endif>Maret</option>
                                    <option value="4" @if (date('m') == 4) selected @endif>April</option>
                                    <option value="5" @if (date('m') == 5) selected @endif>Mei</option>
                                    <option value="6" @if (date('m') == 6) selected @endif>Juni</option>
                                    <option value="7" @if (date('m') == 7) selected @endif>Juli</option>
                                    <option value="8" @if (date('m') == 8) selected @endif>Agustus</option>
                                    <option value="9" @if (date('m') == 9) selected @endif>September</option>
                                    <option value="10" @if (date('m') == 10) selected @endif>Oktober</option>
                                    <option value="11" @if (date('m') == 11) selected @endif>November</option>
                                    <option value="12" @if (date('m') == 12) selected @endif>Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label">Tahun</label>
                                <select class="form-control js-select2" id="filter-year" tabindex="-1" aria-hidden="true">
                                    @for ($i = date('Y'); $i >= 2010; $i--)
                                        <option value="{{$i}}"> {{$i}} </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg" style="margin-top: 19px; width: 100%;" id="filter-submit"><i
                                        class="fa fa-search mr-5"></i>Filter</button>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-vcenter js-datatable" id="table-rujukan-khusus">
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


@push('js')
    <script>
        var table_rujukan_khusus = $("#table-rujukan-khusus").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL + '/bpjs/rujukan-khusus/get-data',
                data: function(d) {
                    // d.source = $('#filter-source').val();
                    d.bulan = $('#filter-month').val();
                    d.tahun = $('#filter-year').val();
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>'
            },
            columns: [{
                    title: 'No',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    'className': 'text-center'
                },
                {
                    title: 'Nomor Rujukan',
                    data: 'norujukan',
                    orderable: true
                },
                {
                    title: 'No Kartu Pasien',
                    data: 'nokapst',
                    orderable: true
                },
                {
                    title: 'Nama Pasien',
                    data: 'nokapst',
                    orderable: true
                },
                {
                    title: 'Diagnosis PPK',
                    data: 'diagppk',
                    orderable: false
                },
                {
                    title: 'Tanggal Rujukan Awal',
                    data: 'tgl_rujuk_awal_formatted',
                    orderable: true
                },
                {
                    title: 'Tanggal Rujukan Akhir',
                    data: 'tgl_rujuk_akhir_formatted',
                    orderable: true
                },
            ],
            order: [],
            pageLength: 10
        });

        $('#filter-submit').on('click', function() {
            table_rujukan_khusus.ajax.reload();
        })

        $('.btnDelete').on('click', function() {
            let id = $(this).data('id');
            let norujukan = $(this).data('norujukan');
            swal({
                type: "warning",
                title: "Apakah Anda Yakin?",
                text: "Data yang telah dihapus tidak dapat dikembalikan!",
                showCancelButton: true,
                confirmButtonText: "Ya!",
                cancelButtonText: "Tidak",
            }).then(function(confirm) {
                if (confirm.value) {
                    let swal_loading = swalLoading();

                    $.ajax({
                        url: BASE_URL + '/bpjs/rujukan-khusus/delete',
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            'id_rujukan': id,
                            'no_rujukan': norujukan,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            swal_loading.close();
                            if (response.metaData.code == 200) {
                                callSwal('success', 'Berhasil', "Berhasil Menghapus Data", "bpjs/rujukan-list-khusus")
                            } else {
                                callSwal('error', 'Gagal', response.metaData.message, 0)
                            }
                        },
                        error: () => {
                            swal_loading.close();
                        }
                    })
                }
            })
        });
        //  var dataTableObj = $('.js-datatable').DataTable({
        //     ordering: true,
        //     pageLength: 10,
        //     horizontal:true,
        //     lengthChange: true,
        //     searching:true,
        //     lengthMenu: [
        //         [5, 10, 15, 20],
        //         [5, 10, 15, 20]
        //     ],
        //     autoWidth: false,
        // });
        // dataTableObj.clear().draw();

        // $(document).on('click', '.btn-filter', function(){
        //     $("#main-page-loading").css("display","block")
        //     let data = $('.form-filter').serializeArray();
        //     $.ajax({
        //         type: "GET",
        //         url: `${BASE_URL}/vclaim-v2/rujukan/khusus/list/bulan/tahun`,
        //         data:data,
        //         dataType: "json",
        //         success: function (response) {
        //             list = response.rujukan
        //             console.log(list)
        //             // if(typeof list == 'undefined'){
        //             //     console.log(response)
        //             //     swal('Berhasil Request', response.metaData.message, 'warning')
        //             // }else{

        //                 $.each(list, function (index, value) { 
        //                     array_temp = [];
        //                     $.each(value, function(obj_name, obj_value) {
        //                         array_temp.push(obj_value)
        //                     })
        
        //                     dataTableObj.row.add(array_temp).draw(false);
        //                 });
        //             // }
        //             $("#main-page-loading").css("display","none")
        //         }
        //     });
        // })
    </script>
@endpush
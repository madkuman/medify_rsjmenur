@extends('alat-medis.layouts.main')

@section('title')
    Daftar Barang - {{$itemtemplate->name}}
@endsection

@section('content')
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet" />

    <div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">
                <small>NAMA BARANG SATUAN</small> <br>
                {{$itemtemplate->name}} {{$items->no_items}}
            </h3>
            <div class="block-options">
                <button class="btn btn-alt-danger btn-square" data-toggle="modal" data-target="#modal-delete">
                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                </button>
            </div>
            <hr class="my-5">
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col">
                    <label>LOKASI</label>
                    <p>{{$items->location}}</p>
                    <label>Status</label>
                    @if($items->status == 0)
                    <p>{{'Tersedia'}}</p>
                    @elseif($items->status == 1)
                        <p>{{'Terpakai'}}</p>
                    @endif
                    <label>Pasien</label>
                    @if($items->status == 0)
                        <p>{{'-'}}</p>
                    @elseif($items->status == 1)
                    <p>{{$items->transaksi->last()->kasus['pasien']['name']}}</p>
                        @endif
                </div>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Histori Barang Satuan<small> ({{$count_history}} Histori)</small></h3>
        </div>
        <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter dataTable">
                <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Pasien</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Hapus Barang Satuan</h3>
                    </div>
                    <div class="block-content">
                        <p>Apakah Anda benar ingin menghapus item ini?</p>
                        <form  method="post" action="{{route('alat-medis.items.delete',$items->id)}}">
                            {{csrf_field()}}
                            {!! method_field('delete') !!}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                                <button type="submit" class="btn btn-danger btn-square">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
        .bootstrap-tagsinput {
            width: 100%;
        }
        td {
            font-size: 0.8em;
        }
        .bootstrap-tagsinput .tag{
            background-color: deepskyblue;
        }
    </style>
    <style type="text/css">
        .bordered {
            border-bottom: 1px solid #eaecee;
        }
    </style>
@endsection

@section('js')

    <script type="text/javascript">
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    </script>
    <script>
        var table = $('.dataTable').DataTable({
            ordering: false,
            processing: true,
            serverSide: false,
            bLengthChange: false,
            pageLength: 10,
            responsive: true,
            scrollY: "calc( 100% - 70px )",
            scrollCollapse: true,
            ajax: '{{ route('alat-medis.items.history.json',$items->id) }}',
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                { data: 'created_at' },
                { data: 'location' },
                { data: 'pasien' },
            ],

            columnDefs: [

            ],
        });
    </script>
@endsection
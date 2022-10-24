@extends('warehouse.layouts.main')

@section('title')
Gudang Laporan
@endsection

@section('content')
	<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Laporan</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <!-- <div class="col-md-6 col-xl-4">
                    <div class="block block-bordered text-center">
                        <div class="block-header">
                            <h3 class="block-title">Laporan Kartu Stok</h3>
                        </div>
                        <div class="block-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor</p>
                        </div>
                        <div class="block-content block-content-full">
                            <a href="{{ url('gudang/laporan/kartu-stok') }}" class="btn btn-hero btn-sm btn-noborder btn-secondary" target="_blank">
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-6 col-xl-4">
                    <div class="block block-bordered text-center">
                        <div class="block-header">
                            <h3 class="block-title">Laporan Stok Sekarang</h3>
                        </div>
                        <div class="block-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor</p>
                        </div>
                        <div class="block-content block-content-full">
                            <a href="{{url()->current()}}/stok-sekarang" class="btn btn-hero btn-sm btn-noborder btn-secondary" target="_blank">
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="block block-bordered text-center">
                        <div class="block-header">
                            <h3 class="block-title">Laporan Kegiatan Kesehatan</h3>
                        </div>
                        <div class="block-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor</p>
                        </div>
                        <div class="block-content block-content-full">
                            <a href="javascript:void(0);" class="btn btn-hero btn-sm btn-noborder btn-secondary" id="kegiatan-kesehatan" target="_blank">
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="block block-bordered text-center">
                        <div class="block-header">
                            <h3 class="block-title">Laporan Obat Keluar</h3>
                        </div>
                        <div class="block-content">
                            <p>Laporan distribusi obat yang keluar dalam rentang tanggal tertentu</p>
                        </div>
                        <div class="block-content block-content-full">
                            <a href="javascript:void(0);" class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-distribusi-obat-keluar">
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="block block-bordered text-center">
                        <div class="block-header">
                            <h3 class="block-title">Laporan Rekapitulasi Per Kategori</h3>
                        </div>
                        <div class="block-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor</p>
                        </div>
                        <div class="block-content block-content-full">
                            <a href="javascript:void(0);" class="btn btn-hero btn-sm btn-noborder btn-secondary" id="narkotika" target="_blank">
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="block block-bordered text-center">
                        <div class="block-header">
                            <h3 class="block-title">Laporan Penerimaan</h3>
                        </div>
                        <div class="block-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor</p>
                        </div>
                        <div class="block-content block-content-full">
                            <a href="javascript:void(0);" class="btn btn-hero btn-sm btn-noborder btn-secondary" id="penerimaan">
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6 col-xl-4">
                    <div class="block block-bordered text-center">
                        <div class="block-header">
                            <h3 class="block-title">Laporan Kegiatan Kesehatan</h3>
                        </div>
                        <div class="block-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor</p>
                        </div>
                        <div class="block-content block-content-full">
                            <a href="{{ url('gudang/laporan/kegiatan-kesehatan-farmasi') }}" class="btn btn-hero btn-sm btn-noborder btn-secondary" id="" target="_blank">
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-md-6 col-xl-4">
                    <div class="block block-bordered text-center">
                        <div class="block-header">
                            <h3 class="block-title">Resep Obat</h3>
                        </div>
                        <div class="block-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor</p>
                        </div>
                        <div class="block-content block-content-full">
                            <a href="javascript:void(0);" class="btn btn-hero btn-sm btn-noborder btn-secondary" id="resep" target="_blank">
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-6 col-xl-4">
                    <div class="block block-bordered text-center">
                        <div class="block-header">
                            <h3 class="block-title">Laporan Stok Opname</h3>
                        </div>
                        <div class="block-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor</p>
                        </div>
                        <div class="block-content block-content-full">
                            <a href="javascript:void(0);" class="btn btn-hero btn-sm btn-noborder btn-secondary" id="stok-opname" target="_blank">
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6 col-xl-4">
                    <div class="block block-bordered text-center">
                        <div class="block-header">
                            <h3 class="block-title">Laporan Pemakaian Obat</h3>
                        </div>
                        <div class="block-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor</p>
                        </div>
                        <div class="block-content block-content-full">
                            <a href="{{ url('gudang/laporan/pemakaian-obat') }}" class="btn btn-hero btn-sm btn-noborder btn-secondary" target="_blank">
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="block block-bordered text-center">
                        <div class="block-header">
                            <h3 class="block-title">Laporan Pengeluaran Obat</h3>
                        </div>
                        <div class="block-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor</p>
                        </div>
                        <div class="block-content block-content-full">
                            <a href="{{ url('gudang/laporan/pengeluaran-obat') }}" class="btn btn-hero btn-sm btn-noborder btn-secondary" target="_blank">
                                Buat Laporan
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <div class="modal" id="modal-kegiatan-kesehatan" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="GET" action="{{ url('gudang/laporan/kegiatan-kesehatan') }}" target="_blank" id="kegiatan-kesehatan-form">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Pilih Tanggal</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <label for="penyedia">TANGGAL </label>
                                <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                                <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">

                                <div class="export-as" id="form-group-ks"></div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="col">
                                <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-ks">
                            <i class="fa fa-file-pdf-o"></i> Export Pdf
                        </button>
                        <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                            <i class="fa fa-file-excel-o"></i> Export Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-stok-opname" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="GET" action="{{ url('gudang/laporan/stok-opname') }}" target="_blank">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Pilih Tanggal</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <label for="penyedia">TANGGAL </label>
                                <input type="text" class="js-datepicker form-control datepicker" name="tanggal" placeholder="Tanggal" id="tanggal" autocomplete="off">
                            </div>
                            <div class="export-as" id="form-group-ks"></div>
                        </div>
                        <div class="block-content">
                            <div class="col">
                                <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-rn">
                            <i class="fa fa-file-pdf-o"></i> Export Pdf
                        </button>
                        <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-rn">
                            <i class="fa fa-file-excel-o"></i> Export Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-narkotika" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="GET" action="{{ url('gudang/laporan/rekapitulasi-narkotika') }}" target="_blank">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Pilih Tanggal</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <label for="penyedia">TANGGAL </label>
                                <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                                <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                            </div>
                            <div class="col">
                                <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                            </div>
                            <div class="form-group">
                                <label for="penyedia">Kategori Barang</label>
                                <select class="js-example-basic-multiple form-control" name="kategori[]" placeholder="Pilih Kategori" multiple="multiple" style="width: 100%;">
                                    @foreach($gorilla as $gori)
                                        <option value="{{$gori->id}}">{{$gori->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="export-as" id="form-group-rn"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-rn">
                            <i class="fa fa-file-pdf-o"></i> Export Pdf
                        </button>
                        <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-rn">
                            <i class="fa fa-file-excel-o"></i> Export Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-penerimaan" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="GET" action="{{ url('gudang/pengadaan/print-faktur') }}" target="_blank">
                {{--<form method="GET" action="{{ url('gudang/laporan/penerimaan') }}" target="_blank">--}}
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Pilih Tanggal</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <label for="penyedia">TANGGAL </label>
                                <input type="text" class="js-datepicker form-control datepicker" name="tgl_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                                <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tgl_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                            </div>
                            <div class="export-as" id="form-group-rn"></div>
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-rn">
                            <i class="fa fa-file-pdf-o"></i> Export Pdf
                        </button>
                        <button type="submit" class="btn btn-alt-success btn-square btn-excel d-none" id="btn-excel-rn">
                            <i class="fa fa-file-excel-o"></i> Export Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-distribusi-obat-keluar" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="GET" action="{{ url('gudang/laporan/distribusi-obat-keluar') }}" target="_blank">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Laporan Distribusi Obat Keluar</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <label for="penyedia">TANGGAL </label>
                                <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                                <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                            </div>
                            <div class="col">
                                <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                            </div>  
                            <div class="export-as" id="form-group-ks"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-ks">
                            <i class="fa fa-file-pdf-o"></i> Export Pdf
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-resep" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="GET" action="{{ url('gudang/laporan/resep-obat') }}" target="_blank">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Pilih Tanggal</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <label for="penyedia">TANGGAL </label>
                                <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                                <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                            </div>
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-alt-primary" id="btn-simpan">
                            <i class="fa fa-check"></i> Lanjut
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style type="text/css">
        .modal-content {
            border-radius: 0;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.js-example-basic-multiple').select2();
        });

        $('#kegiatan-kesehatan').on('click', function(){
            $('#modal-kegiatan-kesehatan').modal('show');
        });

        $('#stok-opname').on('click', function(){
            $('#modal-stok-opname').modal('show');
        });

        $('#penerimaan').on('click', function(){
            $('#modal-penerimaan').modal('show');
        });

        $('#resep').on('click', function(){
            $('#modal-resep').modal('show');
        });

        $('#narkotika').on('click', function(){
            $('#modal-narkotika').modal('show');
        });

        $('.btn-pdf').on('click', function(e){
            e.preventDefault();
            var pdf = '<input type="hidden" name="export_as" value="pdf">';
            var $this = $(this).parents('form');

            date = $(this).parents('form').find('.datepicker');
            
            flag=0;
            for(i=0;i<date.length;i++)
            {
                if($(date[i]).val()) continue;
                else flag++;
            }
            if(!flag)
            {
                $this.find('.export-as').html(pdf);
                $this.submit();
                $this.find('.text-warning').addClass('d-none');
            }
            else $this.find('.text-warning').removeClass('d-none');
        });

        $('.btn-excel').on('click', function(e){
            e.preventDefault();
            var xls = '<input type="hidden" name="export_as" value="xls">';
            var $this = $(this).parents('form');

            date = $(this).parents('form').find('.datepicker');
            
            flag=0;
            for(i=0;i<date.length;i++)
            {
                if($(date[i]).val()) continue;
                else flag++;
            }
            if(!flag)
            {
                $this.find('.export-as').html(xls);
                $this.submit();
                $this.find('.text-warning').addClass('d-none');
            }
            else $this.find('.text-warning').removeClass('d-none');

        });

        datepicker();

        function datepicker() {
            $('.datepicker').datepicker({
                // startDate: "today",
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
            });
        }
    </script>    
@endsection
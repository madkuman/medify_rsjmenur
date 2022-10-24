@extends('pasien.layouts.main')

@section('title')
    Pasien - Medify
@endsection

@section('subtitle')
    Statistik Pasien
@endsection

@section('css')
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <style type="text/css">
        .js-select2 {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <main id="main-container">
        @include('pasien.layouts.navbar')
        <div class="container">
            <div class="row row-deck">
                <div class="col-sm-4" style="max-height: 200px;">
                    <div class="block">
                        <div class="block-content">
                            <span class="fa fa-4x fa-cog fa-spin text-primary text-center loader" style="display: none;"></span>
                            <div id="total-pasien" class="text-right text-primary display-4 font-w600"></div>
                            <div class="font-size-md font-w600 text-uppercase text-right">total pasien</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4" style="max-height: 200px;">
                    <div class="block">
                        <div class="block-content">
                            <span class="fa fa-4x fa-cog fa-spin text-primary text-center loader" style="display: none;"></span>
                            <div id="new-pasien" class="text-right text-primary display-4 font-w600"></div>
                            <div class="font-size-md font-w600 text-uppercase text-right">pasien baru</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4" style="max-height: 200px;">
                    <div class="block col-sm-2">
                        <div class="block-content">
                            <span class="fa fa-4x fa-cog fa-spin text-primary text-center loader" style="display: none;"></span>
                            <div id="total-transaksi" class="text-right text-primary display-4 font-w600"></div>
                            <div class="font-size-md font-w600 text-uppercase text-right">total transaksi hari ini</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-deck">
                <div class="col-xl-12">
                    <div class="block" id="kunjunganPasienBlock">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Statistik Transaksi Pasien</h3>
                            <!-- <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                            </div> -->
                        </div>
                        <div class="block-content block-content-full">
                            <div id="kunjunganChart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row row-deck">
                <div class="col-xl-6">
                    <div class="block" id="jenisPasienBlock">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Jenis Pembayaran Pasien</h3>
                            <!-- <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                            </div> -->
                        </div>
                        <div class="block-content block-content-full">
                            <div id="jenisPasienChart" style="height: 250px; width: 100%;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="block" id="pasienBaruBlock">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Statistik Pasien Baru</h3>
                            <div class="block-options">
                                <!-- <div style="margin-left:35px;">
                                <button type="button" class="btn-block-option">
                                    <i class="si si-refresh"></i>
                                </button>
                                </div> -->
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <div id="pasienBaruChart" style="width: 100%; height: 250px;"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row row-deck">
                <div class="col-xl-12">
                    <div class="block" id="lamaBaruBlock">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Statistik Transaksi Lama/Baru</h3>
                            <!-- <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                            </div> -->
                        </div>
                        <div class="block-content block-content-full row">
                            <div id="lamaChart" class="col-xl-6" style="height: 300px;"></div>
                            <div id="baruChart" class="col-xl-6" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection

@section('js')
    <script src="{{ asset('bower/amcharts3/amcharts/amcharts.js') }}"></script>
    <script src="{{ asset('bower/amcharts3/amcharts/serial.js') }}"></script>
    <script src="{{ asset('bower/amcharts3/amcharts/pie.js') }}"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="{{ asset('js/pasien/pasien-baru.js')}}"></script>
    <script src="{{ asset('js/pasien/pasien-jenis.js')}}"></script>
    <script src="{{ asset('js/pasien/pasien-kunjungan.js')}}"></script>
    <script src="{{ asset('js/pasien/pasien-lamabaru.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                url: API_URL + '/pasien/statistik',
                type: 'GET',
                dataType: 'json',
                beforeSend: function(){
                    $('.loader').css('display', 'block');
                },
                success: function(data){
                    console.log(data);
                    $('#total-pasien').text(data.totalPasien);
                    $('#new-pasien').text(data.pasienBaru);
                    $('#total-transaksi').text(data.transaksi);
                },
                complete: function(){
                    $('.loader').css('display','none');
                }
            });
        });
    </script>
@endsection
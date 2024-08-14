@extends('bpjs.layouts.main')

@section('title')
    Monitoring Antrean BPJS
@endsection

@section('subtitle')
    Monitoring Antrean BPJS
@endsection

@section('css')
    <style type="text/css">
        .block-content {
            padding-bottom: 18px;
        }
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
                            <h3 class="block-title">Monitoring Antrean BPJS
                                <br>
                                <small>Data ini berdasarkan data yang ada pada server BPJS.</small><br>
                            </h3>
                        </div>

                        <div class="block-content">
                            <div class="row">
                                <div class="col-6">
                                    <form id="form-search">
                                        <div class="form-group">
                                            <label for="select">Kode Booking</label>
                                            <input type="text" id="kodebooking" name="kodebooking" class="form-control">
                                        </div>
                                        <div class="alert alert-danger mt-3 mb-0" id="error-message" style="display: none;">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg"
                                                style="margin-top: 19px; width: 100%;" id="btnSubmit"><i
                                                    class="fa fa-search mr-5" onclick="checkPatient()"></i>Cari</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <i class="fa fa-3x fa-asterisk fa-spin text-primary" id="loading-spin"
                                    style="display: none"></i>
                            </div>
                            <div class="row">
                                <div class="col-12 result"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script type="text/javascript">
        function checkPatient() {
            var kodeBooking = $('#kodebooking').val();

            $.ajax({
                url: "{{ url('bpjs/monitoring/antrean') }}",
                type: 'GET',
                data: {
                    kodeBooking: kodeBooking
                },
                success: function(data) {
                    $('#kodebooking').text(data.kodebooking);
                    $('#tanggal').text(data.tanggal);
                    $('#kodepoli').text(data.kodepoli);
                    $('#kodedokter').text(data.kodedokter);
                    $('#jampraktek').text(data.jampraktek);
                    $('#nik').text(data.nik);
                    $('#nokapst').text(data.nokapst);
                    $('#nohp').text(data.nohp);
                    $('#norekammedis').text(data.norekammedis);
                    $('#jeniskunjungan').text(data.jeniskunjungan);
                    $('#nomorreferensi').text(data.nomorreferensi);
                    $('#sumberdata').text(data.sumberdata);
                    $('#ispeserta').text(data.ispeserta);
                    $('#noantrean').text(data.noantrean);
                    $('#estimasidilayani').text(data.estimasidilayani);
                    $('#nocreatedtimehp').text(data.createdtime);
                    $('#status').text(data.status);
                    $('#patient-data').show();
                },
                error: function() {
                    alert('Data tidak ditemukan');
                }
            });
        }
    </script>
@endsection

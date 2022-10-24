@extends('layouts.main2')
@section('title')
Permintaan Transaksi #{{$transaksi->id}}
@endsection
@section('content')
@include('labpk.components.header')
<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Transaksi #{{$transaksi->id}}</h3>
        </div>
        <div class="block-content pb-20">
            <div class="row" style="padding-left: 2%; padding-right: 2%">
                @include('layouts.components2.lab.biodata-pasien-lab')
                @include('layouts.components2.lab.jadwal-pasien')
            </div>
            <div class="row">
                <div class="col-12">
                    <hr>
                    <p class="h6 my-0 mb-10">PERMINTAAN PEMERIKSAAN</p>
                    @include('layouts.components2.lab.verifikasi-permintaan')

                    @php $total_spesimen = count($transaksi->spesimen) ?? 0 @endphp
                    @if($total_spesimen > 0)
                    <p class="h6 my-0 mb-10">DAFTAR SPESIMEN</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;">No</th>
                                <th>Spesimen</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php $count = 1 @endphp
                            @php $total_biaya = 0 @endphp
                            @foreach($transaksi->spesimen as $spesimen)
                            <tr>
                                <td class="text-center">{{$count++}}</td>
                                <td>
                                    <p class="font-w600 mb-5">
                                        {{$spesimen->spesimen->kategori->nama}} - {{$spesimen->spesimen->nama}} 
                                        @if(!empty($spesimen->keterangan))
                                        : {{$spesimen->keterangan}}
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">
                                    @if(empty($transaksi->spesimen_terima_at))
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalTerimaSpesimen">Terima Spesimen</button>
                                    @else
                                    <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#modalTerimaSpesimen">Update Data Penerimaan Spesimen</button>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif


                    <button class="btn btn-secondary" type="button" onclick="window.open('{{url('labpk/transaksi/cetak/permintaan/'.$transaksi->slug)}}', 
                       'newwindow', 
                       `width=${screen.width},height=${screen.height}`); return false;">Cetak Permintaan</button>
                    <button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#modalCancelConfirmation">Batalkan Pemeriksaan</button>

                    <div class="pull-right">
                        <a href="{{url('labpk/transaksi/periksa')}}/{{$transaksi->slug}}" class="btn btn-hero btn-primary">Lakukan Pemeriksaan</a>
                    </div>
                </div>
                @include('layouts.components2.lab.transaksi-creator')
            </div>
        </div>
    </div>

</div>
@include('layouts.components2.lab.cancel-modal-lab')
@include('labpk.components.sep-modal')
@include('labpk.components.footer')
<div class="modal fade" id="modalTerimaSpesimen" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-content">
                    <form action="{{url('labpk/transaksi/mikrobiologi-spesimen-terima/'.$transaksi->slug)}}" method="POST">
                        <h3>Terima Spesimen</h3>
                        {{csrf_field()}}

                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Kategori Spesimen</label><br>
                                    <label class="css-control css-control-primary css-radio">
                                        <input type="radio" class="css-control-input" name="spesimen_kualitas" value="Layak" @if($transaksi->spesimen_kualitas == 'Layak') checked @endif>
                                        <span class="css-control-indicator"></span> Layak
                                    </label>
                                    <label class="css-control css-control-primary css-radio">
                                        <input type="radio" class="css-control-input" name="spesimen_kualitas" value="Tidak Layak" @if($transaksi->spesimen_kualitas == 'Tidak Layak') checked @endif>
                                        <span class="css-control-indicator"></span> Tidak Layak
                                    </label>
                                </div>
                            </div>
                        </div>

                        @php
                            if(!empty($transaksi->spesimen_terima_at))
                            {
                                $value_tanggal_terima = $transaksi->spesimen_terima_at->format('d-m-Y');
                                $value_waktu_terima = $transaksi->spesimen_terima_at->format('H:i');
                            }
                            else
                            {
                                $now = Carbon\Carbon::now();
                                $value_tanggal_terima = $now->format('d-m-Y');
                                $value_waktu_terima = $now->format('H:i');
                            }
                        @endphp


                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Tanggal Terima Spesimen</label>
                                    <input type="text" class="form-control js-datepicker" autocomplete="off" name="spesimen_terima_tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" value="{{$value_tanggal_terima}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Waktu Terima Spesimen</label>
                                    <input type="text" class="form-control time" autocomplete="off" name="spesimen_terima_time" placeholder="00:00" value="{{$value_waktu_terima}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Keterangan (Opsional)</label>
                                    <textarea type="text" class="form-control" name="spesimen_terima_keterangan"  value="">{{$transaksi->spesimen_terima_keterangan}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal
                            </button>
                            <button type="submit" class="btn btn-primary">Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    function submitForm(){
        $("#cancelForm").submit();
    }
</script>
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.time').mask('00:00');
    });
</script>
@endsection
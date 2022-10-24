@extends('keuangan.layouts.main')

@section('title')
File Pengadaan #{{$file->id}} - Keuangan
@endsection

@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection

@section('content')
@include('keuangan.transaksi-file.components.header')
<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-content">
                <h4 class="mb-5"><small>INFORMASI FILE</small></h4>
                <div class="row">
                    <div class="col-4">
                        <label>Mengenai</label>
                        <p class="h5">{{$file->judul}}</p>
                    </div>
                    <div class="col-4">
                        <label>Perusahaan</label>
                        <p class="h5">{{$file->perusahaan->nama}}</p>
                    </div>
                    <div class="col-4">
                        <label>Jumlah</label>
                        <p class="h5">Rp {{number_format($file->total)}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h4 class="mb-5"><small>STATUS TERAKHIR</small></h4>
                        <p>
                            Asal: <strong>{{$transaksi[0]->lokasi_last}}</strong><br>
                            Tujuan: <strong>{{$transaksi[0]->lokasi_tujuan}}</strong><br>
                            @if($transaksi[0]->status == 0)

                                @if(!empty($transaksi[0]->cancel_sent_by))
                                <span class="badge badge-danger">Batal Dikirim</span><br>
                                PIC: <strong>{{$transaksi[0]->send_canceler->name}}, {{indonesian_date($transaksi[0]->updated_at, "j F Y, H:i", "WIB")}}</strong>

                                @elseif(!empty($transaksi[0]->cancel_confirmed_by))
                                <span class="badge badge-danger">Batal Dikonfirmasi</span><br>
                                PIC: <strong>{{$transaksi[0]->confirm_canceler->name}}, {{indonesian_date($transaksi[0]->updated_at, "j F Y, H:i", "WIB")}}</strong>

                                @else
                                <span class="badge badge-primary">Menunggu Konfirmasi</span><br>
                                Pengirim: <strong>{{$transaksi[0]->sender->name}}, {{$transaksi[0]->sent_at}}</strong><br>
                                <button class="btn btn-sm btn-success btn-hero confirm mt-20" data-pk="{{$transaksi[0]->id}}">
                                    <i class="fa fa-check"></i> Konfirmasi File
                                </button>
                                @endif

                            @else
                            <span class="badge badge-success">Sudah Konfirmasi</span><br>
                            Penerima: <strong>{{$transaksi[0]->holder->name}}, {{$transaksi[0]->confirmed_at}}</strong><br>
                            @if($transaksi[0]->lokasi_tujuan == 'BP')
                            @if($transaksi[0]->transfer_status != 2)
                            <button class="btn btn-sm btn-success btn-hero selesai mt-20" data-pk="{{$transaksi[0]->id}}">
                                <i class="fa fa-check"></i> Selesai
                            </button>
                            @else
                            <button class="btn btn-sm btn-default btn-hero mt-20">
                                Transaksi Selesai
                            </button>
                            @endif
                            @else
                            <a href="{{url('keuangan/transaksi-file/baru')}}?file_id={{$transaksi[0]->id}}&lokasi_asal={{$transaksi[0]->lokasi_tujuan}}" class="btn btn-sm btn-primary btn-hero mt-20">
                                <i class="fa fa-paper-plane"></i> Kirim File
                            </a>
                            @endif
                            @endif
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>

        <h5><small>Daftar Transaksi File Ini</small></h5>
     
        @foreach($transaksi as $item)
        <div class="block">
            <div class="block-content">
                <div class="row ">
                    <div class="col-2 h-100 d-flex align-self-center">
                        <div class="">
                            <h5 class="font-w400 mb-5"><small>Lokasi Asal</small></h5>
                            <h5 class="mb-5">{{$item->lokasi_last}}</h5>
                        </div>
                    </div>
                    <div class="col-2 h-100 d-flex align-self-center">
                        <div class="">
                            <h5 class="font-w400 mb-5"><small>Lokasi Tujuan</small></h5>
                            <h5 class="mb-5">{{$item->lokasi_tujuan}}</h5>
                        </div>
                    </div>
                    <div class="col-2 h-100 d-flex align-self-center">
                        <div class="">
                            @if(!empty($item->cancel_sent_by))
                            <h5 class="font-w400 mb-5"><small>Pengiriman Dibatalkan Oleh</small></h5>
                            <h5 class="mb-5">{{$item->send_canceler->name}}</h5>
                            <h6 class="font-w400">{{indonesian_date($item->updated_at, "j F Y, H:i", "WIB")}}</h6>
                            @else
                            <h5 class="font-w400 mb-5"><small>Dikirim Oleh</small></h5>
                            <h5 class="mb-5">{{$item->sender->name}}</h5>
                            <h6 class="font-w400">{{$item->sent_at}}</h6>
                            @endif
                        </div>
                    </div>
                    <div class="col-2 h-100 d-flex align-self-center">
                        <div class="">
                            @if($item->status == 1)
                            @if(!empty($item->cancel_confirmed_by))
                            <h5 class="font-w400 mb-5"><small>Konfirmasi Dibatalkan Oleh</small></h5>
                            <h5 class="mb-5">{{$item->confirm_canceler->name}}</h5>
                            <h6 class="font-w400">{{indonesian_date($item->updated_at, "j F Y, H:i", "WIB")}}</h6>
                            @else
                            <h5 class="font-w400 mb-5"><small>Diterima Oleh</small></h5>
                            <h5 class="mb-5">{{$item->holder->name}}</h5>
                            <h6 class="font-w400">{{$item->confirmed_at}}</h6>
                            @endif
                            @else
                            Menunggu Konfirmasi <br>
                            @endif
                        </div>
                    </div>
                    <div class="col-3 h-100 d-flex align-self-center">
                        <div class="">
                            <h5 class="font-w400 mb-5"><small>Keterangan</small></h5>
                            <h5 class="font-w400">{{$item->sender_keterangan ?? '-'}}</h5>
                        </div>
                    </div>
                    <div class="col-1 h-100 d-flex align-self-center">
                        <div class="">
                            <h5 class="font-w400 mb-5"><small>Checklist</small></h5>
                            <button class="btn btn-sm btn-alt-primary checklist mt-5" data-toggle="tooltip" data-checklist="{{$item->checklist}}" title="Lihat Checklist"><i class="fa fa-list"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="checklistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Checklist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-6 row">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="sprin" value="1" onclick="return false;">
                            <label class="custom-control-label" for="sprin">Sprin (Pejabat Ada & Pan Riksa)</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="hps" value="2" onclick="return false;">
                            <label class="custom-control-label" for="hps">HPS (OE)</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="spph" value="3" onclick="return false;">
                            <label class="custom-control-label" for="spph">SPPH + Pakta Integritas</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="sph" value="4" onclick="return false;">
                            <label class="custom-control-label" for="sph">SPH + Pakta Integritas</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="penetapan" value="5" onclick="return false;">
                            <label class="custom-control-label" for="penetapan">Penetapan Penyedia</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="pernyataan" value="6" onclick="return false;">
                            <label class="custom-control-label" for="pernyataan">Pernyataan Pengadaan</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="negosiasi" value="7" onclick="return false;">
                            <label class="custom-control-label" for="negosiasi">Negosiasi</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="penunjukan" value="8" onclick="return false;">
                            <label class="custom-control-label" for="penunjukan">Penunjukan Penyedia</label>
                        </div>
                    </div>
                    <div class="col-6 row">
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="spk" value="9" onclick="return false;">
                            <label class="custom-control-label" for="spk">SPK + SPMK</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="fakturbarang" value="10" onclick="return false;">
                            <label class="custom-control-label" for="fakturbarang">Faktur Barang</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="ba" value="11" onclick="return false;">
                            <label class="custom-control-label" for="ba">BA. Hasil Pengadaan</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="sptjm" value="12" onclick="return false;">
                            <label class="custom-control-label" for="sptjm">SPTJM</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="pertagih" value="13" onclick="return false;">
                            <label class="custom-control-label" for="pertagih">Pertagih</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="ku17" value="14" onclick="return false;">
                            <label class="custom-control-label" for="ku17">KU 17 + Kuitansi</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="fakturpajak" value="15" onclick="return false;">
                            <label class="custom-control-label" for="fakturpajak">Faktur Pajak + SSP</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline mb-5">
                            <input class="custom-control-input" type="checkbox" name="checklist[]" id="spp" value="16" onclick="return false;">
                            <label class="custom-control-label" for="spp">SPP</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{url('keuangan/transaksi-file/konfirmasi')}}" id="formKonfirmasi">
    {{csrf_field()}}
    <input name="file_id" type="hidden" value="{{$transaksi[0]->id}}">
</form>
<form method="POST" action="{{url('keuangan/transaksi-file/selesai')}}" id="formSelesai">
    {{csrf_field()}}
    <input name="file_id" type="hidden" value="{{$transaksi[0]->id}}">
</form>
@endsection


@section('js')




<script type="text/javascript">
    $(document).on('click', '.confirm', function(){
        swal({
            title: "Konfirmasi File Ini?",
            showCancelButton: true,
            reverseButtons: true,
            type: 'warning',
            confirmButtonClass: "btn btn-success",
            cancelButtonClass: "btn btn-default",
            confirmButtonText: "Ya!",
            cancelButtonText: "Tidak",
            closeOnConfirm: false
        }).then(function(result) {
            if(result.value)
            {
                $('#formKonfirmasi').submit();
            }
        });
    });
    $(document).on('click', '.selesai', function(){
        swal({
            title: "Akhiri Transaksi File Ini?",
            showCancelButton: true,
            reverseButtons: true,
            type: 'warning',
            confirmButtonClass: "btn btn-success",
            cancelButtonClass: "btn btn-default",
            confirmButtonText: "Ya!",
            cancelButtonText: "Tidak",
            closeOnConfirm: false
        }).then(function(result) {
            if(result.value)
            {
                $('#formSelesai').submit();
            }
        });
    });
    $(document).on('click', '.checklist', function(){
        var checklist = $(this).data('checklist');
        $('input[name="checklist[]"]').each(function() {
            if (jQuery.inArray($(this).val(), checklist) != -1) {
                $(this).prop("checked", true);
            }
            else {
                $(this).prop("checked", false);
            }
        });
        $('#checklistModal').modal('toggle');
    });
</script>
@endsection
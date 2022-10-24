@extends('layouts.main2')

@section('title')
Permintaan Operasi - Medify
@endsection

@section('sidebarcomponent')
@include('kamaroperasi.components.sidebar')
@endsection

@section('css')

<style>
div.dataTables_wrapper div.dataTables_processing {
    top: 10%;
    text-align: center;
}
</style>
@endsection

@section('content')
<main id="main-container">
    <div class="content">
        @include('kamaroperasi.components.navbar')
        <div class="row">
            <div class="col-12">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="block-title">Permintaan Jadwal Operasi</h3>
                        <a href="{{url('kamaroperasi/pendaftaran/tambah_permintaan')}}" class="btn btn-secondary" style="margin-left: 10px;  display: none;"><i class="fa fa-plus"></i> Tambah Permintaan Operasi</a>
                        <hr>
                    </div>
                    <div class="block-content">
                        <div class="row mb-20">
                            <div class="col-4">
                                <label>Spesialis operasi</label>
                                <select class="form-control" id="select_spesialis_operasi">
                                    <option value="" selected="">Semua</option>
                                    @foreach($spesialis_operasi as $item)
                                    <option value="{{$item->nama}}" >{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-striped table-vcenter no-footer" aria-describedby="DataTables_info" id="permintaanTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%">#</th>
                                            <th style="width: 25%">IDENTITAS</th>
                                            <th style="width: 10%">ASAL</th>
                                            <th style="width: 7%">JENIS</th>
                                            <th style="width: 8%">SPESIALIS</th>
                                            <th style="width: 8%">DIAGNOSIS</th>
                                            <th style="width: 10%">KETERANGAN</th>
                                            <th style="width: 5%;">WAKTU</th>
                                            <th style="width: 10%">DIBUAT OLEH</th>
                                            <th style="width: 15%">MASA-TUNGGU</th>
                                            <th class="text-center" style="width: 15%">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('kamaroperasi.components.tr')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="masa_tunggu_modal" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <form action="{{ url('kamaroperasi/pemesanan/masa_tunggu') }}" method="post" id="" autocomplete="off">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-content">
                            <h3 class="block-title">Ubah Masa Tunggu</h3>
                            <br>
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="operasi_id" value="">
                            <label>Masa Tunggu</label>
                            <input type="text" class="js-datepicker form-control" name="masa_tunggu" id="masa_tunggu" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" placeholder="Pilih Tanggal" value="" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-alt-primary">
                            <i class="fa fa-check"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')


<script>
  var tolakButton = function(id){
    swal({
      title: "Apa anda yakin ?",
      text: "Pasien ini akan dihapus dari daftar permintaan operasi.",
      type: "warning",
      showCancelButton: true,
      reverseButtons: true,
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-default',
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
      closeOnConfirm: false,
      closeOnCancel: false,
      allowOutsideClick: false
  }).then(function(result) {
      if(result.value)
        window.location = "{{url('/kamaroperasi/pemesanan/tolak')}}/"+id;
});
};

$("#permintaanTable").DataTable({
    scrollX:        true,
    scrollCollapse: true,
    processing: true,
    language: {
        processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>'
    },
});


var change_id = function(id, masa_tunggu){
    $("#operasi_id").val(id);
    $("#masa_tunggu").val(masa_tunggu);
};

</script>


<script type="text/javascript">
  $('document').ready(function() {
    $("#permintaan_jadwal").addClass('active');
    Codebase.helpers(['datepicker']);
});

  $(document).ready(function() {
    $.fn.dataTableExt.afnFiltering.push(function(oSettings, aData, iDataIndex) {
        var spesialis_operasi = $('#select_spesialis_operasi').val();
        if (aData[4].includes(spesialis_operasi)) {
            return true;
        }
    });
    var oTable = $('#permintaanTable').dataTable();
    $('#select_spesialis_operasi').on("change", function(e) {
        oTable.fnDraw();
    });
});

</script>
@endsection

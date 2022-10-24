@extends('kepegawaian.layouts.main')

@section('title')
  {{$htmlheader_title}}
@endsection

@section('subtitle')
  {{$contentheader_title}}
@endsection

@section('css')
  <style type="text/css">
    td {
      overflow: visible;
      word-break: break-word;
    }
  </style>
@endsection

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

@section('content')
  <div class="container">
    <div class="row justify-content-around">
      <div class="col-6 py-20 text-left">
        <h3>{{$contentheader_title}}</h3>
      </div>
      <div class="col-6 py-20 text-right float-right">
        <a href="{{ route('pegawai-baru') }}" class="btn btn-outline-primary pull-right"><i class="fa fa-plus mr-5 mb-10"></i> Pegawai Baru</a>
      </div>
    </div>
    <div class="row justify-content-around">
      <div class="col-lg-12 col-12">
        @include('kepegawaian.layouts.partials.formsearch')
      </div>

      <div class="col-lg-12 col-12">
        <div class="block rounded main-content transaction-index">
          <div class="table-responsive">
            <table class="table table-hover table-pointer table-vcenter js-dataTable-full" id="data_tabel_pegawai" style="font-family: sans-serif; width: 100%" >
              <thead>
              <tr class="header">
                <th style="min-width:50px" class="align-middle text-center">No</th>
                <th style="min-width:200px" class="align-middle text-center">Nama</th>
                <th style="min-width:100px" class="align-middle text-center">NRP</th>
                <th style="min-width:150px" class="align-middle text-center">Jabatan</th>
                <th style="min-width:150px" class="align-middle text-center">Pangkat</th>
                <th style="min-width:120px" class="align-middle text-center">Status</th>
                <th style="min-width:120px" class="align-middle text-center">Status Aktif</th>
                <th style="min-width:110px" class="align-middle text-center">JK</th>
                <th style="min-width:110px" class="align-middle text-center">Usia</th>
                <th style="min-width:100px" class="align-middle text-center">Agama</th>
                <th style="min-width:150px" class="align-middle text-center">Alamat</th>
                <th style="min-width:150px" class="align-middle text-center">Departemen</th>
                <th style="min-width:150px" class="align-middle text-center">Kualifikasi</th>
                <th style="min-width:150px" class="align-middle text-center">Tanggal Masuk</th>
                <th style="min-width:150px" class="align-middle text-center">Tanggal Keluar</th>
              </tr>
              </thead>
              <tbody id="tabel_pegawai">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('footer-script')
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> --}}
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script>

    $(window).ready(function(){
      var width = $('#employeetable').width();
      $('.copy-table').css('width', width);
    })

    $('#form_search').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) {
        e.preventDefault();
        return false;
      }
    });

    $(document).ready(function(){
      $('.btn-spin').hide();
    })

    $(document).ready(function(){
      $('#btn_export_pegawai').click(function(){
        $('#form_search').unbind('submit').submit();
        exportPegawai();
      })
    })

    function exportPegawai(){
      $.ajax({
        type: 'GET',
        url: "{{route('export-file')}}",
        data: $('#form_search').serialize(),
        beforeSend:function() {
          $('#loading').removeClass('d-none');
        },
        success: function(data){
          $('#loading').addClass('d-none');
        },
      });
    }

    $(document).on("click",".btn-submit", function () {
      $('.btn-spin').show();
    })

    $(document).on("click",".btn-batal", function () {
      $('.btn-spin').hide();
    })

    initTabelPegawai();

    function initTabelPegawai() {
      table = $('#data_tabel_pegawai').DataTable({
        orderCellsTop: false,
        ordering: false,
        fixedHeader: true,
        processing: true,
        serverSide: true,
        searching: false,
        pagingType: "full_numbers",
        paging: true,
        lengthChange: false,
        language: {
          processing: '<div style="position: absolute; left:50%; top:25%"><i class="fa fa-4x fa-spinner fa-spin text-info"></i></div>'
        },
        ajax: {
          url: "{{route('pegawai-list')}}",
          data: function(d){
            d.name = $('#filter_name').val();
            d.nrp = $('#filter_nrp').val();
            d.agama = $('#filter_agama').val();
            d.alamat = $('#filter_alamat').val();
            d.min_age = $('#filter_min_age').val();
            d.max_age = $('#filter_max_age').val();
            d.gender = $('#filter_gender').val();
            d.jenis_pegawai = $('#filter_jenis_pegawai').val();
            d.status_pegawai = $('#filter_status_pegawai').val();
            d.kualifikasi = $('#filter_kualifikasi').val();
            d.jabatan = $('#filter_jabatan').val();
            d.pangkat = $('#filter_pangkat').val();
            d.departemen = $('#filter_departemen').val();
            d.golongan_darah = $('#filter_golongan_darah').val();
            d.pendidikan = $('#filter_pendidikan').val();
            d.tmt_masuk_awal = $('#filter_tmt_masuk_awal').val();
            d.tmt_masuk_akhir = $('#filter_tmt_masuk_akhir').val();
            d.tmt_keluar_awal = $('#filter_tmt_keluar_awal').val();
            d.tmt_keluar_akhir = $('#filter_tmt_keluar_akhir').val();
          },
        },
        columnDefs: [
          { width: 50, targets: 0, className: "text-center" },
          { width: 200, targets: 1, className: "text-center" },
          { width: 100, targets: 2, className: "text-center" },
          { width: 150, targets: 3, className: "text-center" },
          { width: 150, targets: 4, className: "text-center" },
          { width: 120, targets: 5, className: "text-center" },
          { width: 120, targets: 6, className: "text-center" },
          { width: 110, targets: 7, className: "text-center" },
          { width: 110, targets: 8, className: "text-center" },
          { width: 100, targets: 9, className: "text-center" },
          { width: 150, targets: 10, className: "text-center" },
          { width: 250, targets: 11, className: "text-center" },
          { width: 150, targets: 12, className: "text-center" },
          { width: 150, targets: 13, className: "text-center" }
        ],
        columns: [
          {
            data: 'id', sortable: false,
            render: function(data, type, row, meta)
            {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
          },
          { data: 'name', name: 'name' },
          { data: 'nrp', name: 'nrp' },
          { data: function (data) {
              var ks = ''
              if (data.master_jabatan == null) {
                return ks;
              }else{
                return data.master_jabatan.nama;
              }
            }, name: 'jabatan_id'
          },
          {
            data: function (data) {
              var pangkat = ''
              if(data.master_pangkat_pegawai != null){
                pangkat = data.master_pangkat_pegawai.nama;
              }
              return pangkat;
            }, name: 'pangkat'
          },
          {
            data: function (data) {
              return data.master_jenis_pegawai.nama;
            }, name: 'jenis_pegawai_id'
          },
          {
            data: function (data) {
              var st = ''
              if (data.master_status_pegawai == null) {
                return st;
              } else {
                return data.master_status_pegawai.status;
              }
            }, name: 'status_pegawai_id'
          },
          { data: 'genders', name: 'genders' },
          { data: 'age_just_year', name: 'age_just_year' },
          { data: function (data) {
              var kosong = ''
              if (data.agama == null) {
                return kosong;
              }else{
                return data.agama.nama;
              }
            }, name:'agama'
          },
          { data: 'address', name: 'address' },
          {
            data: function (data) {
              var jabatan = data.master_jabatan;
              var nll = '';

              if (jabatan == null || jabatan.departemen == null) {
                return nll;
              }else{
                return jabatan.departemen.nama;
              }
            }, name: 'departemen'
          },
          {
            data: function (data) {
              if (data.master_kualifikasi == null) {
                return '';
              }
              if (data.master_subkualifikasi == null) {
                return data.master_kualifikasi.nama;
              } else {
                return data.master_kualifikasi.nama + '-' + data.master_subkualifikasi.nama;;
              }
            }, name: 'kualifikasi'
          },
          { data: 'tmt_formatted', name: 'tmt_formatted' },
          { data: 'tmt_out_formatted', name: 'tmt_out_formatted' }
        ],
      });

      $('#data_tabel_pegawai tbody').on('click', 'tr', function () {
        var datas = table.row(this).data();
        var q = datas.id;
        url = BASE_URL+'/kepegawaian/pegawai/profile/'+q;
        window.location.href = url;
      });
    }

    $('#btn_filter').click(function(){
      $('#spinner').removeAttr('class');
      $('#data_tabel_pegawai').dataTable().fnDestroy();
      initTabelPegawai();
    })

    $('#manGender').change(function(){
      $('#manGender').val('L');
    })

    $('#womanGender').change(function(){
      $('#womanGender').val('P');
    })
  </script>
@endpush  
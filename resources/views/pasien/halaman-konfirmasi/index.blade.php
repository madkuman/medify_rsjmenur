@extends('pasien.layouts.main')

@section('title')
Pasien - halaman konfirmasi
@endsection

@section('subtitle')
Halaman Konfirmasi
@endsection

@section('css')
<style type="text/css">
.block-content {
    padding-bottom: 18px;
}
.select2-container--default .select2-selection--single{
    background-color: #42a5f5!important;
    font-size: 1.5em;
    color: #FFF;
    padding-bottom: 45px !important;
}
.select2-container--disabled .select2-selection--single {
    background-color: #dddd!important;
    color: #000;
}
#select2-selectDokter-container{
    color: #fff;
}
.select2-container--disabled #select2-selectDokter-container{
    color: #575757;
}
#select2-selectPoli-container{
    color: #FFF;
    margin-left: 2%;
}
.select2-container--default .select2-selection--single .select2-selection__arrow b {
    border-color: #FFF transparent transparent transparent;
}
</style>
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="row row-deck">
            <div class="col-sm-12">
                <div class="block rounded main-content transaction-index"  ng-controller="PasienController">
                    <div class="block-header">
                        <h3 class="block-title">Halaman Konfirmasi</h3>
                    </div>
                    <div class="block-content">
                        <div class="row mb-20">
                            <div class="col-sm-12"> 
                                <form style="margin-top: 10px">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <select name="loket" class="form-control block-header bg-primary js-select2" data-size="5" id="loket" style="width: 100%;">
                                                @foreach($loket as $item)
                                                    <option value="{{$item->id}}">{{$item->nama_loket}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 mt-10">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                    <input type="text" class="form-control" id="start_date" name="start_date" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{Carbon\Carbon::now()->format('d/m/Y')}}" autocomplete="off">
                                                    <div class="input-group-prepend input-group-append">
                                                      <span class="input-group-text font-w600">to</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="end_date" name="end_date" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{Carbon\Carbon::now()->format('d/m/Y')}}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12">
                        <div class="block rounded main-content transaction-index">
                          <div class="table-responsive" style="overflow-x: hidden">
                            <table class="table table-hover table-pointer table-bordered table-vcenter js-dataTable-full" id="data_tabel_halaman_konfirmasi" style="font-family: sans-serif; width: 100%" >
                              <thead>
                                <tr class="header">
                                    <th class="text-center" style="width:8%;">No</th>
                                    <th class="text-center" style="width:15%">No RM </th>
                                    <th class="text-center" style="width:20%">Nama Pasien</th>
                                    <th class="text-center" style="width:20%">Poliklinik</th>
                                    <th class="text-center" style="width:20%">Dokter</th>
                                    <th class="text-center" style="width:10%">No Antrian</th>
                                    <th class="text-center" style="width:7%">Aksi</th>
                                </tr>
                              </thead>
                              <tbody id="tabel_daftar_konfirmasi">
                              </tbody>
                            </table>
                            
                          </div>
                          
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</main>

<form method="POST" action="{{url('pasien/konfirmasi-antrian/cancel')}}" id="formBatal">
    {{csrf_field()}}
    <input type="hidden" id="cancel_id" name="id">
    <input type="hidden" id="cancel_keterangan" name="keterangan">
</form>
@endsection

@section('js')
<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $('#loket').change(function(){
        $('#data_tabel_halaman_konfirmasi').dataTable().fnDestroy();
        loadData();
    })
    $('#start_date').change(function(){
        $('#data_tabel_halaman_konfirmasi').dataTable().fnDestroy();
        loadData();
    })
    $('#end_date').change(function(){
        $('#data_tabel_halaman_konfirmasi').dataTable().fnDestroy();
        loadData();
    })

    loadData()

    function loadData() {
        table = $('#data_tabel_halaman_konfirmasi').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        processing: true,
        serverSide: true,
        searching: true,
        pagingType: "full_numbers",
        paging: true,
        lengthMenu: [[10, 15, 25, 50], [10, 15, 25, 50]],
        language: {
                processing: '<div style="position: absolute; left:50%; top:25%"><i class="fa fa-4x fa-spinner fa-spin text-info"></i></div>'
            },
        ajax: {
            url: BASE_URL + '/pasien/konfirmasi-antrian/get-data',
            data: function(d){
                d.loket = $('#loket').val();
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
            },
        },
        columns: [
            { data: '', sortable: false, class: 'text-center',
                render: function(data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1;
                } 
            },
            { data: 'no_rm', class: 'text-center'},
            { data: 'nama_pasien'},
            { data: 'poliklinik'},
            { data: 'dokter'},
            { data: 'antrian', class: 'text-center'},
            { data: 'aksi', class: 'text-center'},
        ],
        });
    }

    $(document).on('click', '.button-call-antrian', function(){ 
        var antrian_id = $(this).data("antrian");
        var loket_id = $(this).data("loket");

        var url = "{{url('')}}/assets/img/rawatjalan-tv/sound/antrian-pasien/";
		var audio_file = url + loket_id + '-' + antrian_id;
		// var audio_file = url + 'bell'; //cadangan jika tidak bisa
		doAnnounce(audio_file);
    });

    function doAnnounce(file_name)
	{
        console.log(file_name);
		waiting_call = 1;
		var audio = document.getElementById("player");
		audio.src = file_name + '.mp3';
		audio.load();
		audio.play();
		audio.addEventListener("paused", function() {
			audio.removeAttribute('src');
			audio.src = file_name + '.wav';
			audio.load();
			audio.play();
		});
		audio.addEventListener("ended", function() {
			audio.removeAttribute('src');
			waiting_call = 0;
		});
	};

    function confirmSwalBatalkan(id)
    {
        swal({
            title: 'Apa anda yakin?',
            input: 'text',
            text: "Mengapa anda membatalkan transaksi ini?",
            type: 'warning',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-danger',
            showCancelButton: true,
            confirmButtonText: 'Tolak Transaksi',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                return !value && 'Masukan Alasan Pembatalan!'
            }
        }).then((result) => {
            if (result.value) {
                $('#cancel_keterangan').val(result.value)            
                $('#cancel_id').val(id)
                $('#formBatal').submit()
            }
        })
    }
</script>

@endsection
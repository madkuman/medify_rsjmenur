@extends('layouts.main2')

@section('title')
Pengaturan Sync
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="row">
            @include('settings.components.sidebar')
            <div class="col-md-9 mb-20">
                <div class="container bg-white px-100 py-50" data-toggle="appear">
                    <div class="row justify-content">
                        <form method="POST" class="col-md-12" action="{{url()->current()}}">
                            {{csrf_field()}}
                            <h4 class="font-w400 mb-5 text-center">Sync</h4>
                            <hr>
                            <div class="row">
                                <div class="alert alert-info alert-dismissable col-md-12" role="alert">
                                    <!-- <button type="button" class="close" data-dismiss="alert" aria-close="Close">
                                        <span aria-hidden="true">x</span>
                                    </button> -->
                                    <h5 class="alert-heading font-w400">Data Kepegawaian</h5>
                                    <p class="mb-0">Pilih data sesuai dengan nama anda untuk melakukan sinkronisasi data. Tahap ini akan membantu anda untuk lebih cepat menambahkan informasi pada laman profil atau keperluan lain yang membutuhkan data dari kepegawaian.</p>
                                </div>
                                <label class="col-md-12">Ambil data kepegawaian dari...</label>
                                <div class="form-group col-md-12">
                                    <select class="js-select2 form-control" id="kepegawaian" name="employee" required>
                                        @if(!empty(Auth::user()->employee_id))
                                        <option value="{{$synced_acc->id}}" selected>{{$synced_acc->name}}</option>
                                        @else
                                        <option value="">Pilih Nama...</option>
                                        @endif
                                        @foreach($employee_list as $emp)
                                        <option value="{{$emp->id}}">{{$emp->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" id="btn_submit" class="btn btn btn-primary mt-10">Simpan</button>
                        </form>
                        <form method="POST" class="col-md-12" action="{{url('settings/integrasi-dpjp')}}">
                            {{csrf_field()}}
                            <hr>
                            <div class="form-group">
                                <div class="alert alert-info alert-dismissable col-md-12" role="alert">
                                    <h5 class="alert-heading font-w400">Integrasi DPJP BPJS</h5>
                                    <p class="mb-0">Pilih data sesuai dengan nama anda untuk melakukan sinkronisasi data.</p>
                                </div>
                                <select class="js-select2 form-control" name="dokter_id">
                                    <option selected value="">Pilih Dokter</option>
                                    @foreach($dokter as $item)
                                    <option value="{{$item->id}}" @if($item->id == Auth::user()->dokter_id) selected @endif>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" id="btn_submit_dpjp" class="btn btn-primary mt-10">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')
<script src="assets/js/pages/be_pages_dashboard.js"></script>
<script>
    $(document).ready(function(){
        $('#kepegawaian').select2();
    });
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#specialty').select2();
    $('#service-type').select2();
    $('#dpjp').select2();
    $.ajax({
        type: "POST",
        url: API_URL + '/getting-started/bpjs/referensi/spesialis',
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.response.list.length != 0)
            {
                $.each(data.response.list, function(key, value){
                    $('#specialty').append('<option value="'+value.kode+'">'+value.nama+'</option>');
                });
            }
            $('#spesialisasiLoading').hide();
        }
    });
});
$('#specialty').on('change', function(){
    getDPJPList();
});
$('#service-type').on('change', function(){
    getDPJPList();
});

function getDPJPList() {
    var specialty = $('#specialty').val();
    var service_type = $('#service-type').val();
    if(specialty != '' && service_type != ''){
        $.ajax({
            url: API_URL + '/getting-started/bpjs/referensi/dpjp/'+service_type+'/'+specialty,
            type: "GET",
            dataType: "json",
            beforeSend: function(){
                $('#loader').show();
                $('#form-dpjp').hide();
                $('#btn_submit_dpjp').hide();
                $('#dpjpError').hide();
                $('#dpjpError201').hide();
            },
            success: function(data){
                $('#dpjp').empty();
                if (data.metaData.code == 200 && data.response.list.length != 0)
                {
                    $.each(data.response.list, function(key, value){
                        $('#dpjp').append('<option value="'+value.kode+'">'+value.nama+'</option>');
                    });
                    $('#form-dpjp').show();
                    $('#loader').hide()
                    $('#dpjpError201').hide();
                    $('#dpjpError').hide();
                    $('#btn_submit_dpjp').show(500);
                }
                else if(data.metaData.code == 201)
                {
                    $('#dpjpError').hide();
                    $('#dpjpError201').show();
                    $('#form-dpjp').hide();
                    $('#loader').hide()
                    $('#btn_submit_dpjp').hide();
                }
                else
                {
                    $('#dpjpError').show();
                    $('#dpjpError201').hide();
                    $('#form-dpjp').hide();
                    $('#loader').hide()
                    $('#btn_submit_dpjp').hide();
                }
            },
            complete: function(){
            }
        });
    }
}
</script>
@endsection

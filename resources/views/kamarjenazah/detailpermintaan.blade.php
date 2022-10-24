@extends('kamarjenazah.layouts.main')

@section('title')
Kamar Jenazah - Medify
@endsection

@section('toprightmenu')
+ Permintaan Penjemputan Jenazah
@endsection

@section('subtitle')
Permintaan Penjemputan Jenazah
@endsection

@section('url')
{{url('kamarjenazah/permintaan_jemput')}}
@endsection

@section('css')
<style type="text/css">
    .js-select2 {
        width: 100%;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="block rounded">
            <div class="block-content">
                {{-- <button class="btn btn-primary dropdown-toggle pull-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-print"></i> Print
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url("kamarjenazah/transaksi/sertifikat/{$jenazah['permintaan'][0]['id']}")}}">Sertifikat</a>
                  </div> --}}
                <h4 class="mb-0">Permintaan #{{$jenazah['permintaan'][0]['id']}}</h4>
                <br>
                <form id="jemputSubmit">
                    <h5 class="uppercase text-secondary">INFORMASI PASIEN
                    <hr>
                    </h5>

                        <div class="row mb-20">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Nama</label>
                                    </div>
                                    <div class="col-md-9">
                                        {{$pasien['identitas']['name']}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>No RM</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{$pasien['identitas']['id']}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>JK</label>
                                    </div>
                                    <div class="col-md-6">
                                        @if($pasien['identitas']['gender'] == 1) Laki laki
                                        @else Perempuan
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Pekerjaan</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{$pasien['identitas']['job']}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Usia</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{$pasien['identitas']['age']}} tahun
                                    </div>
                                </div>
                            </div>
                             <div class="col-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Agama</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{$pasien['identitas']['agama']['nama']}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Kelahiran</label>
                                    </div>
                                    <div class="col-md-9">
                                        {{$pasien['identitas']['place_of_birth']}}, {{date('d F Y', strtotime($pasien['identitas']['date_of_birth']))}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Pendidikan</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{$pasien['identitas']['pendidikan']['nama']}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Pernikahan</label>
                                    </div>
                                    <div class="col-md-6">
                                        @if($pasien['identitas']['marriage'] == 1 ) Single
                                        @elseif($pasien['identitas']['marriage'] == 2 ) Menikah
                                        @elseif($pasien['identitas']['marriage'] == 3 ) Duda/Janda
                                        @else -
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Alamat</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{$pasien['identitas']['address']}},
                                        @if(!empty($pasien['identitas']['alamat_kecamatan']))
                                        {{$pasien['identitas']['alamat_kecamatan']['name']}}, {{$pasien['identitas']['alamat_kota']['name']}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    <h5 class="uppercase text-secondary">INFORMASI KEMATIAN
                    <hr>
                    </h5>
                        <div class="row mb-20">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Tempat Meninggal</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{$jenazah['tempat_kematian'][0]['nama_tempat']}} - {{$jenazah['permintaan'][0]['detail_tempat']}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Perkiraan Waktu Meninggal</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{$jenazah['permintaan'][0]['waktu_meninggal']}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Dasar Diagnosis</label>
                                    </div>
                                    <div class="col-md-6">
                                          <ul>
                                            @foreach($jenazah['nama_diagnosis'] as $namanya)
                                            <li>{{$namanya}}</li>
                                            @endforeach
                                          </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Penyebab Kematian</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{$jenazah['sebab_kematian'][0]['nama_sebab']}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Detail Penyebab Kematian</label>
                                    </div>
                                    <div class="col-6">
                                       {{$jenazah['permintaan'][0]['detail_kematian']}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Waktu Penjemputan Jenazah</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{$jenazah['permintaan'][0]['waktu_jemput']}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" style="height: 75px">
                            <button class="btn btn-success btn-hero pull-right" type="submit" style="margin-left:8px;" formaction="{{url('kamarjenazah/transaksi/new/'.$jenazah['permintaan'][0]['id'])}}"><i class="fa fa-check"></i> Lanjutkan</button>
                            <button class="btn btn-alt-success btn-hero pull-right" style="display: none" type="button"  id="buttonLoadingSubmit">
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                            </button>
                            <button class="btn btn-danger btn-hero pull-right" type="button" id="buttonDelete"><i class="fa fa-close"></i> Batalkan Permintaan</button>
                            <button class="btn btn-alt-danger btn-hero pull-right" style="display: none" type="button"  id="buttonLoadingDelete">
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('angular')

<script type="text/javascript">

    $('#buttonDelete').click(function() {

        $('#buttonDelete').hide();
        $('#buttonLoadingDelete').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        id = {{$jenazah['permintaan'][0]['id']}};

        var formData = new FormData();
        formData.append('id',id);
        for (var pair of formData.entries()) {
            console.log(pair[0]+ ', ' + pair[1]);
        }
        $.ajax({
            type: "POST",
            url: API_URL + "/kamarjenazah/permintaan/delete",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {

                callSwalString(response);
                $('#buttonSubmit').show();
                $('#buttonLoadingDelete').hide();
            },
            error: function () {
                callSwal('error','Aksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonSubmit').show();
                $('#buttonLoadingDelete').hide();
            }
        });

        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }

    });

</script>

@endsection

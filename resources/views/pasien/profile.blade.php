@extends('pasien.layouts.main')

@section('title')
{{$identitas->name}} - Profile - Pasien
@endsection

@section('subtitle')
{{$identitas->name}}
@endsection

@section('css')
    <style>
        .pasien-foto-data .block-content {
            padding: 0px;
        }
        .pasien-foto-data .block-content form button.btn-download {
            position: absolute;
            top: 10px;
            right: 25px;
            opacity: 0.8;
        }
        .pasien-foto-data .block-content img {
            width: 100%;
        }
    </style>
@endsection

@section('content')
@php $flag = 0; @endphp
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="block">
            <div class="block-content">
                <div class="row mx-0 mb-20">
                    <div class="col-lg-1 px-0 full-only">
                        <img src="{{asset('')}}/{{$identitas->photo_thumb}}" class="img-avatar-lg" >
                    </div>
                    <div class="col-lg-11 col-sm-12 px-0 row mx-0" style="padding-top: 0px;">
                        <div class="col-lg-5 col-sm-12 mb-5">
                            <h4 class="title mb-5">{{$identitas->name}}</h4>
                            <h6 class="font-w400 mb-5">
                                @if($identitas->gender == 1) Laki laki
                                @else Perempuan
                                @endif
                                , 
                                {{$identitas->detailed_long_age}}
                            </h6>
                            <h6 class="font-w400 mb-0">No Rekam Medis : #{{$identitas->no_rm_formatted}}</h6>
                            <span class="badge badge-primary">
                                @if(empty($pembayaran[0]->perusahaan))
                                Umum
                                @else
                                {{$pembayaran[0]->perusahaan->tipe->nama}}
                                @endif
                            </span>
                        </div>

                        <div class="col-lg-7 full-only">
                            @if($is_pendaftaran_disabled )
                            <button href="{{url()->current()}}/pendaftaran" class="btn btn-primary pull-right disabled" style="margin-left: 1%;pointer-events: auto;"   data-toggle="tooltip" data-placement="top" title="Informasi Metode Bayar Kurang. Cek Kelas atau Perusahaan Pembayaran"><i class="fa fa-paper-plane"></i> Daftar Pelayanan</button>
                            <button href="{{url()->current()}}/pendaftaran-inap" class="btn btn-alt-primary pull-right disabled" style="margin-left: 1%;pointer-events: auto;"   data-toggle="tooltip" data-placement="top" title="Informasi Metode Bayar Kurang. Cek Kelas atau Perusahaan Pembayaran"><i class="fa fa-bed"></i> Daftar Rawat Inap</button>
                            @else
                            <a href="{{url()->current()}}/pendaftaran" class="btn btn-primary pull-right" style="margin-left: 1%;" ><i class="fa fa-paper-plane"></i> Daftar Pelayanan</a>
                            <a href="{{url()->current()}}/pendaftaran-inap" class="btn btn-alt-primary pull-right" style="margin-left: 1%;pointer-events: auto;"><i class="fa fa-bed"></i> Daftar Rawat Inap</a>
                            @endif
                            <a href="{{url()->current()}}/edit" class="btn btn-warning pull-right" style="margin-left: 1%;"><i class="fa fa-pencil"></i> Edit</a>
                            <a class="btn btn-secondary pull-right" id="page-header-user-dropdown-full" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Print<i class="fa fa-angle-down ml-5"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="page-header-user-dropdown-full" x-placement="bottom-end" style="position: absolute; transform: translate3d(-57px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item" href="javascript:void(0)" onclick="new_window('{{url()->current()}}/print/profile', '')">
                                    <i class="si si-user mr-5"></i> Profile
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="new_window('{{url()->current()}}/print/label', '')">
                                    <i class="fa fa-ticket mr-5"></i> Label
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="new_window('{{url()->current()}}/print/kartu', '')">
                                    <i class="fa fa-address-card mr-5"></i> Kartu Berobat
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="new_window('{{url()->current()}}/print/ktp', '')">
                                    <i class="fa fa-address-card mr-5"></i> Kartu Identitas
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="new_window('{{url()->current()}}/print/gelangdewasa', '')">
                                    <i class="fa fa-circle-o-notch mr-5"></i> Gelang
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="new_window('{{url()->current()}}/print/general-consent', '')">
                                    <i class="fa fa-file-text mr-5"></i> General Consent
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="new_window('{{url()->current()}}/print/tindakan-kedokteran', '')">
                                    <i class="fa fa-file-text mr-5"></i> Tindakan Kedokteran
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="new_window('{{url()->current()}}/print/aktivitas-poli-psikologi', '')">
                                    <i class="fa fa-file-text mr-5"></i> Aktivitas Poli Psikologi
                                </a>
                                <a class="dropdown-item" href="{{url()->current()}}/pernyataan-pilih-dokter">
                                    <i class="fa fa-file-text mr-5"></i> Surat Pernyataan Memilih Dokter
                                </a>
                                <a class="dropdown-item" href="{{url()->current()}}/permohonan-pindah-kelas">
                                    <i class="fa fa-file-text mr-5"></i> Surat Permohonan Pindah Kelas
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-12 mobile-block">
                            @if($is_pendaftaran_disabled )
                            <button href="{{url()->current()}}/pendaftaran" class="btn btn-primary pull-right disabled" style="margin-left: 1%;pointer-events: auto; width: 100%; margin-bottom: 3px;"   data-toggle="tooltip" data-placement="top" title="Informasi Metode Bayar Kurang. Cek Kelas atau Perusahaan Pembayaran"><i class="fa fa-paper-plane"></i> Daftar Pelayanan</button>
                            <button href="{{url()->current()}}/pendaftaran-inap" class="btn btn-alt-primary pull-right disabled" style="margin-left: 1%;pointer-events: auto; width: 100%; margin-bottom: 3px;"   data-toggle="tooltip" data-placement="top" title="Informasi Metode Bayar Kurang. Cek Kelas atau Perusahaan Pembayaran"><i class="fa fa-bed"></i> Daftar Rawat Inap</button>
                            @else
                            <a href="{{url()->current()}}/pendaftaran" class="btn btn-primary pull-right" style="width: 100%; margin-bottom: 3px;" ><i class="fa fa-paper-plane"></i> Daftar Pelayanan</a>
                            <a href="{{url()->current()}}/pendaftaran-inap" class="btn btn-alt-primary pull-right" style="pointer-events: auto; width: 100%; margin-bottom: 3px;"><i class="fa fa-bed"></i> Daftar Rawat Inap</a>
                            @endif
                            <a href="{{url()->current()}}/edit" class="btn btn-warning pull-right" style="width: 100%; margin-bottom: 3px;"><i class="fa fa-pencil"></i> Edit</a>
                            <a class="btn btn-secondary pull-right" style="width: 100%; margin-bottom: 3px;" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Print<i class="fa fa-angle-down ml-5"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown" x-placement="bottom-end" style="position: absolute; transform: translate3d(-57px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item" onclick="new_window('{{url()->current()}}/print/profile', '')">
                                    <i class="si si-user mr-5"></i> Profile
                                </a>
                                <a class="dropdown-item" onclick="new_window('{{url()->current()}}/print/label', '')">
                                    <i class="fa fa-ticket mr-5"></i> Label
                                </a>
                                <a class="dropdown-item" onclick="new_window('{{url()->current()}}/print/kartu', '')">
                                    <i class="fa fa-address-card-o mr-5"></i> Kartu
                                </a>
                                <a class="dropdown-item" onclick="new_window('{{url()->current()}}/print/gelangdewasa', '')">
                                    <i class="fa fa-opera mr-5"></i> Gelang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block block-transparent">
                    <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tabs-identitas">Identitas Pasien</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tabs-kasus">Histori Kunjungan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tabs-permintaan-rujuk">Permintaan Rujuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tabs-general-consent">General Consent</a>
                        </li>
                    </ul>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="tabs-identitas" role="tabpanel">
                            <div class="alert alert-warning alert-dismissable" role="alert" id="peringatan">
                                <h5 class="alert-heading font-size-h4 font-w400">Terdapat Data Kosong Pada Bagian Berikut</h5>
                                <ul>
                                    @if(empty($identitas->name) || $identitas->name == '-') @php $flag = 1; @endphp <li>Nama</li> @endif
                                    @if(empty($identitas->jenis_identitas)) @php $flag = 1; @endphp <li>Jenis Identitas</li> @endif
                                    @if(empty($identitas->gender)) @php $flag = 1; @endphp <li>Jenis Kelamin</li> @endif
                                    @if(empty($identitas->job) || $identitas->job == '-') @php $flag = 1; @endphp <li>Pekerjaan</li> @endif
                                    @if(empty($identitas->place_of_birth || $identitas->place_of_birth == '-')) @php $flag = 1; @endphp <li>Tempat Lahir</li> @endif
                                    @if(empty($identitas->date_of_birth)) @php $flag = 1; @endphp <li>Tanggal Lahir</li> @endif
                                    @if(empty($identitas->pendidikan)) @php $flag = 1; @endphp <li>Pendidikan</li> @endif
                                    @if(empty($identitas->marriage)) @php $flag = 1; @endphp <li>Pernikahan</li> @endif
                                    @if(empty($identitas->phone)) @php $flag = 1; @endphp <li>No HP</li> @endif
                                    @if(empty($identitas->address)) @php $flag = 1; @endphp <li>Alamat</li> @endif
                                    @if(empty($identitas->alamat_kecamatan) && $identitas->district != 0) @php $flag = 1; @endphp <li>Kecamatan</li> @endif
                                    @if(empty($identitas->alamat_kelurahan) && $identitas->kelurahan != 0) @php $flag = 1; @endphp <li>Kelurahan</li> @endif
                                    @if(empty($identitas->alamat_kota) && $identitas->city != 0) @php $flag = 1; @endphp <li>Kota</li> @endif
                                    @if(empty($identitas->suku)) @php $flag = 1; @endphp <li>Suku</li> @endif
                                    @if($identitas->is_anggota == 1)
                                    @if(empty($identitas->tni_nrp)) @php $flag = 1; @endphp <li>NRP</li> @endif
                                    @if(empty($identitas->tni_keanggotaan)) @php $flag = 1; @endphp <li>Keanggotaan</li> @endif
                                    @if(empty($identitas->tni_pangkat)) @php $flag = 1; @endphp <li>Pangkat</li> @endif
                                    @if(empty($identitas->tni_kotama)) @php $flag = 1; @endphp <li>Kotama</li> @endif
                                    @if(empty($identitas->tni_satker)) @php $flag = 1; @endphp <li>Satker</li> @endif
                                    @endif

                                    @if(!empty($identitas->wali))
                                    @if(empty($identitas->wali->name)) @php $flag = 1; @endphp <li>Nama Keluarga</li> @endif
                                    @if(empty($identitas->wali->phone)) @php $flag = 1; @endphp <li>No HP Keluarga</li> @endif
                                    @if(empty($identitas->wali->address)) @php $flag = 1; @endphp <li>Alamat Keluarga</li> @endif
                                    @if(empty($identitas->jenis_hubungan_keluarga)) @php $flag = 1; @endphp <li>Hubungan Keluarga</li> @endif
                                    @endif
                                </ul>
                            </div>
                            @include('pasien.profile.identitas')
                        </div>
                        <div class="tab-pane" id="tabs-kasus" role="tabpanel">
                            @include('pasien.profile.histori-kasus')
                        </div>
                        <div class="tab-pane" id="tabs-permintaan-rujuk" role="tabpanel">
                            @include('pasien.profile.permintaan-rujuk')
                        </div>
                        <div class="tab-pane" id="tabs-general-consent" role="tabpanel">
                            @include('pasien.profile.general-consent.index')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@include('pasien.pembayaran.delete-modal')
@include('kasus.asesmen.general-consent.modal-ttd')
@endsection

@section('angular')

<script type="text/javascript">
    function new_window(url, windowName) {
        popupwindow(url,windowName,600,800);
    }
</script>
<script type="text/javascript">
    $('#kasusModal').modal({
        show:false,

    }).on('show.bs.modal', function(){
    });

    function pembayaranDeleteModal(id)
    {
        $('#pembayaranDeleteModal #pembayaran-id').val(id)
        $('#pembayaranDeleteModal').modal('show');
    }
    var flag = "{{$flag}}";
    console.log(flag);
    if(flag == 0)
    {
        $('#peringatan').hide();    
    }
</script>

{{-- histori kunjungan --}}
<script type="text/javascript">
    $(document).ready(function () {
        var tab_active ="{{ $tab_active ?? 'tabs-identitas'}}";
        var filter_dokter = "{{ $filter_dokter ?? null }}";
        var filter_lokasi = "{{ $filter_lokasi ?? null }}";

        if (filter_lokasi != '' || filter_dokter != '') {
            $(`#btnFilter`).trigger("click");
        } else {
            $(`#tutupFilter`).trigger("click");
        }

        $(`a[href="#${tab_active}"]`).trigger("click");
        $(".js-select2[name='dokter[]']").val(filter_dokter.split(',')).trigger("change");
        $(".js-select2[name='lokasi']").val(`${filter_lokasi}`).trigger("change");
    });

    $('#btnFilter').click(function(e){
        $('#formFilter').attr("hidden", false);
        $('#btnFilter').attr("hidden", true);
    })
    
    $('#tutupFilter').click(function(e){
        $('#formFilter').attr("hidden", true);
        $('#btnFilter').attr("hidden", false);
    })
</script>
@include('kasus.asesmen.general-consent.js-ttd')
<script type="text/javascript">
	$(".deleteBtn").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$("#deleteInputId").val(id);
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus data ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: "warning",
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Kembali",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value)
			{
				$("#formDelete").submit();
			}
		});
	});
</script>
@endsection
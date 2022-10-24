@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Penunjang - Kasus
@endsection

@section('css')

@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            <!-- Updates -->
            <div class="col-lg-4 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        @if(empty($kasus->pasien_id))
                        <div class="block">
                            <div class="block-content tab-content overflow-hidden">
                                <div class="col-12 text-center py-50">
                                    <h4 class="font-w400 mb-5">Data pasien belum tersinkronisasi. Silahkan lakukan Sinkronisasi dahulu</h4>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="block">
                            <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if (session('active_nav') == 'permintaan') active @endif" href="#permintaan" id="nav-permintaan">Permintaan Operasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if (session('active_nav') == 'jadwal') active @endif" href="#jadwal" id="nav-jadwal">Jadwal Operasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if (session('active_nav') == 'asesmen') active @endif" href="#asesmen" id="nav-asesmen">Asesmen</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if (session('active_nav') == 'hasil') active @endif" href="#hasil" id="nav-hasil">Hasil Operasi</a>
                                </li>
                                
                            </ul>
                            <div class="block-content tab-content overflow-hidden">
                                <div class="tab-pane fade fade-left @if (session('active_nav') == 'permintaan') show active @endif" id="permintaan" role="tabpanel">
                                    @include('kasus.operasi.content.permintaan')
                                </div>
                                <div class="tab-pane fade fade-left @if (session('active_nav') == 'jadwal') show active @endif" id="jadwal" role="tabpanel">
                                    @include('kasus.operasi.content.jadwal')
                                </div>
                                <div class="tab-pane fade fade-left @if (session('active_nav') == 'asesmen') show active @endif" id="asesmen" role="tabpanel">
                                    @include('kasus.operasi.content.asesmen')
                                </div>
                                <div class="tab-pane fade fade-left @if (session('active_nav') == 'hasil') show active @endif" id="hasil" role="tabpanel">
                                    @include('kasus.operasi.content.hasil')
                                </div>
                                
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
</main>
<!-- END Main Container -->    
<form method="POST" action="{{url()->current()}}/permintaan" id="formPermintaan">
    {{csrf_field()}}
</form>
<form method="POST" action="{{url()->current()}}/tolak" id="formTolak">
    {{csrf_field()}}
    <input type="hidden" id="tolakId" name="id">
    <input type="hidden" name="nomor_kasus" value="{{$kasus->nomor_kasus}}">
</form>


<!--MODAL-->
@include('kasus.operasi.content.modals.hasil-operasi')
<div class="modal fade show" id="modal-hasil-operasi" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-popin" role="document">
      <div class="modal-content">
        <form action="{{url('kamaroperasi/pelaksanaan/pasca')}}" method="post" id="">
          <div class="block block-themed block-transparent mb-0">
              <div class="block-content">
                <h3 class="block-title">Hasil Operasi</h3>
                <br>
                {{ csrf_field() }}
                <input type="hidden" name="kasus_id" value="{{ $kasus->id }}">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Diagnosa Awal</label>
                      <input type="text" name="diag_awal" class="form-control" placeholder="Diagnosa pasien sebelum operasi" @if(!empty($diagnosis)) value="{{ $diagnosis->icd10->code_icd }} - {{ $diagnosis->icd10->long_desc }}" @endif required>
                    </div>
                    <div class="form-group">
                      <label>Diagnosa Akhir</label>
                      <input type="text" name="diag_akhir" class="form-control" placeholder="Diagnosa pasien setelah operasi" @if(!empty($diagnosis)) value="{{ $diagnosis->icd10->code_icd }} - {{ $diagnosis->icd10->long_desc }}" @endif required>
                    </div>
                    <div class="form-group">
                      <label>Persiapan</label>
                      <textarea name="persiapan" rows="3" class="form-control" placeholder="Hal yang dilakukan sebelum operasi" required></textarea>
                    </div>
                    <div class="form-group">
                      <label>Posisi Pasien</label>
                      <input type="text" name="posisi" class="form-control" placeholder="Posisi pasien saat dioperasi" required>
                    </div>
                    <div class="form-group">
                      <label>Disinfektan</label>
                      <input type="text" name="disinfektan" class="form-control" placeholder="Disinfektan yang digunakan" required>
                    </div>
                    <div class="form-group">
                      <label>Incisi</label>
                      <input type="text" name="incisi" class="form-control" placeholder="Incisi yang dilakukan" required>
                    </div>
                    <div class="form-group">
                      <label>Temuan Operasi</label>
                      <input type="text" name="temuan" class="form-control" placeholder="Temuan pasca operasi" required>
                    </div>
                    <div class="form-group">
                      <label>Tindakan Operasi</label>
                      <textarea name="tindakan" rows="3" class="form-control" placeholder="Tindakan yang dilakukan saat operasi" required></textarea>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label>Pendarahan</label>
                      <input type="text" name="pendarahan" class="form-control" placeholder="Jumlah pendarahan yang terjadi pada pasien" required>
                    </div>
                    <div class="form-group">
                      <label>Advice Post Ops</label>
                      <textarea name="advice" rows="3" class="form-control" placeholder="Saran yang diberikan pasca operasi" required></textarea>
                    </div>
                    <div class="form-group">
                      <label>Pemeriksaan PA</label>
                      <select class="form-control" style="width: 100%;" name="pemeriksaan_pa" required>
                        <option value="">-- Pilih --</option>
                        <option value="ya">Ya</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jenis Operasi</label>
                      <select class="form-control" style="width: 100%;" name="jenis_operasi" required>
                        <option value="">-- Pilih --</option>
                        @foreach($jenis_operasi as $jenis_item)
                        <option value="{{$jenis_item->id}}">{{$jenis_item->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Operasi</label>
                      <input type="text" class="js-datepicker form-control" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd MM yyyy" placeholder="dd/mm/yy" required autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label>Waktu Mulai</label>
                      <input type="text" class="js-masked-time form-control" name="waktu_mulai" placeholder="00:00" required>
                    </div>
                    <div class="form-group">
                      <label>Waktu Selesai</label>
                      <input type="text" class="js-masked-time form-control" name="waktu_selesai" placeholder="00:00" required>
                    </div>
                    <div class="form-group">
                      <label>Lama Anastesi</label>
                      <input type="text" class="js-masked-time form-control" name="anastesi" placeholder="00:00" required>
                    </div>
                    <div class="form-group">
                      <label>Macam Anastesi</label>
                      <select class="form-control" style="width: 100%;" name="macam_anestesi" required>
                        <option value="">-- Pilih --</option>
                        <option value="general">General Anestesi</option>
                        <option value="regional">Regional Anestesi</option>
                        <option value="local">Local Anestesi</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Status Pasien</label>
                      <select class="form-control" style="width: 100%;" name="status_pasien" required>
                        <option value="" disabled selected>-- Pilih --</option>
                        <option value="Hidup">Hidup</option>
                        <option value="Mati">Mati</option>
                      </select>
                    </div>
                  </div>
                </div>
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
<div class="modal fade show" id="modalOperasiBaru" tabindex="-1" role="dialog" aria-labelledby="modalOperasiBaru" aria-hidden="true">
    <form method="POST" action="{{url()->current()}}/permintaan">
        {{csrf_field()}}
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Permintaan operasi?</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <p>Anda akan meminta jadwal operasi kepada kamar operasi. Apakah Anda yakin?</p>
                        <div class="form-group row">
                            <label class="col-12">Jenis Spesialis</label>
                            <div class="col-12">
                                <select class="js-select2 form-control" name="jenis_spesialis_id" id="jenis_spesialis_dropdown" data-width="100%" data-placeholder="Pilih Spesialis" required>
                                    <option value="" selected="" disabled="">Pilih</option>
                                    @foreach($spesialis_operasi as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">ICD 9</label>
                            <div class="col-12">
                                <select class="js-select2 form-control" name="icd9_id" id="icd9_dropdown" data-width="100%" data-placeholder="Pilih ICD 9" required>
                                    <option value="" selected="" disabled="">Pilih</option>
                                    @foreach($kasus->tindakan_icd9 as $item)
                                    <option value="{{$item->icd_9}}">{{$item->desc}}</option>
                                    @endforeach
                                </select>
                                @if(!empty($kasus->tindakan))
                                <small>Silahkan mengisi Tindakan ICD 9 pada Data Medis sebelum melanjutkan</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">

                            <label>Keterangan :</label>
                            <textarea class="form-control" name="keterangan" placeholder="Tambahkan keterangan disini..." rows="4"></textarea>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-click-animate">
                        <i class="fa fa-check"></i> Ya, Minta Jadwal Operasi!
                    </button>
                </div>
            </div>
        </div>    
    </form>
</div>




@endsection

@section('js')


<script type="text/javascript">
window.onhashchange = locationchange;

function locationchange()
{   
    var lokasi = location.hash;
    var satuan = lokasi.split("");
    satuan.splice(0,1);
    var hash = satuan.join("");
    if(lokasi === '')
    {
        $('.tab-pane').removeClass('show active');
        $('.nav-link').removeClass('active');
        $('#permintaan').addClass('show active');
        $('#nav-permintaan').addClass('active');    
    }
    else
    {
        $('.tab-pane').removeClass('show active');
        $('.nav-link').removeClass('active');
        $(''+lokasi+'').addClass('show active');
        $('#nav-'+hash+'').addClass('active');    
    }
}

$(".nav-tabs").find("li a").last().click();

var url = document.URL;
var hash = url.substring(url.indexOf('#'));

$(".nav-tabs").find("li a").each(function(key, val) {
    if (hash == $(val).attr('href')) {
        $(val).click();
    }
    $(val).click(function(ky, vl) {
        location.hash = $(this).attr('href');
    });
});

$(document).ready(function() {
   locationchange();
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("#jenis_spesialis_dropdown").select2({
        dropdownParent: $("#modalOperasiBaru")
    });
    $("#icd9_dropdown").select2({
        dropdownParent: $("#modalOperasiBaru")
    });
});

    function permintaan()
    {
        swal({
          title: 'Permintaan operasi?',
          text: "Anda akan meminta jadwal operasi kepada kamar operasi. Apakah Anda yakin?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Minta Jadwal Operasi!',
          confirmButtonClass: 'btn btn-primary ml-10',
          cancelButtonClass: 'btn btn-outline-danger ',
          buttonsStyling: false,
          reverseButtons: true
      }).then((result) => {
          if (result.value) {
            $('#formPermintaan').submit();
        }
    })
  }

  function permintaanGagal()
  {
    swal("Permintaan Gagal!", "Silahkan mengisi Diagnosis ICD10 pada Data Medis sebelum melakukan permintaan operasi.", "error");
}
function tolakTransaksi(id){
    swal({
        title: 'Apa anda yakin membatalkan permintaan operasi?',
        type: 'warning',
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-outline-danger',
        showCancelButton: true,
        confirmButtonText: 'Batalkan Permintaan',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.value) {            
            $('#tolakId').val(id)
            $('#formTolak').submit()
        }
    })
}

function rencana_operasi(id)
{
    window.open(
        "{{url('kamaroperasi/pelaksanaan/')}}/"+id,"popUpWindow",
        "height=1280,width=1280,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
}

function hasil_operasi(id)
{   
    window.open(
        "{{url('kamaroperasi/pelaksanaan/')}}/"+id+"#hasil_operasi","popUpWindow",
        "height=1280,width=1280,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");   
}

</script>

@endsection
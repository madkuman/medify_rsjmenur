@extends('pasien.layouts.main')

@section('title')
Rujuk ke Poli Lain
@endsection

@section('subtitle')
Rujuk ke Poli Lain
@endsection

@section('css')
<style type="text/css">
.labl {
    display : block;
}
.labl > input{ /* HIDE RADIO */
    visibility: hidden; /* Makes input not-clickable */
    position: absolute; /* Remove input from document flow */
}
.labl > input + div{ /* DIV STYLES */
    cursor:pointer;
    border:2px solid transparent;
}
.labl > input:checked + div{ /* (RADIO CHECKED) DIV STYLES */
    border: 4px solid #42a5f5;
}
</style>
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="">
            <div class="block-content">
                <h4 class="mb-0">Rujuk Pasien ke Poli Lain</h4>
                Anda akan merujuk pasien ke salah pelayanan poli lain di rumah sakit
                <hr>
                <form id="pasienSubmit">

                    <div class="block rounded" id="dataJenis">
                        <div class="block-content">
                            <h5 class="uppercase">Form Rujuk Rawat Jalan
                                <hr>
                            </h5>
                            <div class="row pilih-poli">
                                <div class="col-6">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label class="control-label">Asal Poli</label>
                                                <input type="text" class="form-control" readonly="" value="{{$asal_poli->nama}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Poli Tujuan</label>
                                                <select name="poli_tujuan_id[]" class="form-control js-select2" data-size="5" id="tujuanPoli" style="width: 100%;" multiple>
                                                    @foreach($poli as $item)
                                                    @if($item->lokasi_id != $asal_poli->id)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Tipe Rujukan</label>
                                                <select name="rujuk_type" class="form-control" data-size="5" id="rujuktype" style="width: 100%;">
                                                    <option value="1">Konsul</option>
                                                    <option value="2">Alih Rawat</option>
                                                    <option value="3">Rawat Bersama</option>
                                                </select>
                                            </div>
                                            <div class="form-group" style="display: none">
                                                <div class="custom-control custom-checkbox custom-control-inline mb-5">
                                                    <input class="custom-control-input" type="checkbox" name="buat_kasus_baru" checked id="buat-kasus-baru-check" value="1">
                                                    <label class="custom-control-label" for="buat-kasus-baru-check">Buat Kasus Baru</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">KETERANGAN</label>
                                                <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="pasien_id" id="pasien_id" value="{{$kasus->pasien_id}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="kasus_id" id="kasus_id" value="{{$kasus->id}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="poli_asal_id" id="poli_asal_id" value="{{$asal_poli->id}}">
                                        </div>

                                    </div>
                                </div>                             
                            </div>
                        </div>
                    </div>

                    <div class="col-12" style="height: 75px">
                        <button class="btn btn-success btn-hero pull-right" type="button" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                        <button class="btn btn-alt-success btn-hero pull-right" style="display: none" type="button"  id="buttonLoading">
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

@endsection


@section('angular')
<script type="text/javascript">
    $('#select').select2();
    $('.js-select2').select2();

    
    $('#buttonSubmit').click(function() {

        $('#buttonSubmit').hide();
        $('#buttonLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


        pasien_id = $("#pasien_id").val();
        poli_tujuan_id = $("#tujuanPoli").val();
        kasus_id = $("#kasus_id").val();
        poli_asal_id = $("#poli_asal_id").val();
        keterangan = $("#keterangan").val();
        buat_kasus_baru = $("#buat-kasus-baru-check").prop('checked');
        rujuktype = $("#rujuktype").val();
        if(buat_kasus_baru) buat_kasus_baru = 1
        else buat_kasus_baru = 0
        
        if(poli_tujuan_id.length == 0)
        {
            callSwal('error','Sorry','Poli tujuan belum terisi',0);
            $('#buttonSubmit').show();
            $('#buttonLoading').hide();
            return;
        }

        
        var formData = new FormData();
        formData.append('pasien_id', pasien_id);
        formData.append('poli_tujuan_id', poli_tujuan_id);
        formData.append('kasus_id', kasus_id);
        formData.append('poli_asal_id', poli_asal_id);
        formData.append('keterangan', keterangan);
        formData.append('buat_kasus_baru', buat_kasus_baru);
        formData.append('rujuktype', rujuktype);

        $.ajax({
            type: "POST",
            url: API_URL + "/kasus/administrasi/rujuk/rawatjalan",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                callSwalString(response);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            },
            error: function () {
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            }
        });

        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }
        

    });

        $( "#rujuktype" ).change(function() {
          if(this.value == 2)
          {
            $('#buat-kasus-baru-check').prop('checked', true);
          }
          else
          {
            $('#buat-kasus-baru-check').prop('checked', false);
          }
      });

</script>

@endsection
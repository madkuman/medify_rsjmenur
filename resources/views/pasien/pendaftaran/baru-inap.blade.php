@extends('pasien.layouts.main')

@section('title')
Pasien - Medify
@endsection

@section('subtitle')
Pendaftaran Pasien Baru
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

.custom-tabbable .custom-nav-tabs {
   overflow-x: auto;
   overflow-y:hidden;
   flex-wrap: nowrap;
}

.modal-full {
    min-width: 100%;
    margin: 0;
}
.modal-full .modal-content {
    min-height: 100vh;
}
</style>
@endsection

@section('content')
<main id="main-container">
    @include('pasien.layouts.navbar')
    <div class="container">
        <div class="">
            <div class="block-content">
                <h4 class="mb-0">Pendaftaran Pasien ke Rawat Inap</h4>
                Anda akan mendaftarkan pasien ke Rawat Inap di rumah sakit
                <br><br>
                <form id="pasienSubmit" method="post" action="{{url()->current()}}/submit">
                    {{csrf_field()}}
                    <input type="hidden" name="pasien_id" value="{{$identitas->id}}">
                    <div class="block rounded" id="dataJenis">
                        <div class="block-content">
                            <h5 class="uppercase">Form Pendaftaran Layanan 
                                <hr>
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Pasien</label>
                                        <div class="block block-bordered">
                                            <div class="block-content">
                                                <div class="row" style="margin-left: 1%;">
                                                    <div class="col-lg-2 px-0 full-only">
                                                        <img src="{{asset('')}}/{{$identitas->photo_thumb}}" class="img-avatar-lg" >
                                                    </div>
                                                    <div class="col-lg-10 col-12 pl-0" style="padding-top: 0px;">
                                                        <h4 class="title mb-5">{{$identitas->name}}</h4>
                                                        <h6 class="font-w400 mb-5">
                                                            @if($identitas->gender == 1) Laki laki
                                                            @else Perempuan
                                                            @endif
                                                            , 
                                                            {{$identitas->age}} tahun
                                                        </h6>
                                                        <h6 class="font-w400 mb-0">No Rekam Medis : #{{$identitas->no_rm}}</h6>
                                                        <h6> </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label class="control-label">Permintaan Rawat Inap</label>
                                        <select name="permintaan-ranap" class="form-control js-select2" data-size="5" style="width: 100%;" id="permintaanRanap">
                                            @foreach($permintaan as $p)
                                                <option value="{{$p->id}}">{{date('d F Y', strtotime($p->created_at))}} - {{$p->kasus->lokasi->lokasi->nama ?? ''}}</option>
                                            @endforeach
                                            <option value="0">Tanpa Permintaan</option>
                                        </select>
                                    </div>
                                    <div class="form-group selected-div hide" style="" id="tanpa-permintaan">
                                        <label class="control-label">Pilih Kasus</label>
                                        <select name="pilih-kasus" class="form-control js-select2" id="pilih-kasus" data-size="5" style="width: 100%;">
                                            <option value="" disabled="" selected="">Pilih Kasus yang sesuai</option>
                                            @foreach($kasus as $k)
                                                @if(!in_array($k->id,$kasus_id))
                                                <option value="{{$k->id}}">{{date('d F Y', strtotime($k->created_at))}} - {{$k->lokasi->lokasi->nama ?? ''}} - {{$k->judul_kasus}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-10 text-center font-w600 bg-danger text-white mb-20 align-middle" id="error-wrapper" style="display: none;">
                        <i class="fa fa-exclamation-circle mr-5"></i>
                        <span></span>
                    </div>
                    <div class="col-12">
                        <div class="row flex-row-reverse">
                            <button class="btn btn-success btn-hero col-lg-2 col-12" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>  
                        </div>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</main>

@endsection


@section('js')
<script type="text/javascript">
    $( document ).ready(function() {    
        if($('#permintaanRanap').val() == 0){
            $('#tanpa-permintaan').show();
            $('#pilih-kasus').prop('required',true);
        }
    });
    $(function() {
        $('#permintaanRanap').change(function(){
            if($(this).val() == 0){
                $('#tanpa-permintaan').show();
                $('#pilih-kasus').prop('required',true);
            } else {
                $('#tanpa-permintaan').hide();    
                $('#pilih-kasus').prop('required',false);            
            }
        });
    });
</script>
@endsection
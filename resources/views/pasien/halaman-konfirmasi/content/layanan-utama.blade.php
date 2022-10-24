
<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Pasien</label>
                    <div class="block block-bordered">
                        <div class="block-content">
                            <div class="row" style="margin-left: 1%;">
                                <div class="col-2 px-0 full-only">
                                    <img src="{{asset('')}}/{{$pasien->photo_thumb}}" class="img-avatar-lg" >
                                </div>
                                <div class="col-lg-10 col-12 pl-0" style="padding-top: 0px;">
                                    <h4 class="title mb-5">{{$pasien->name}}</h4>
                                    <h6 class="font-w400 mb-5">
                                        @if($pasien->gender == 1) Laki laki
                                        @else Perempuan
                                        @endif
                                        , 
                                        {{$pasien->age}} tahun
                                    </h6>
                                    <h6 class="font-w400 mb-0">No Rekam Medis : #{{$pasien->no_rm}}</h6>
                                    <h6> </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-group">
                    <label hidden class="control-label">Pilih Layanan Rumah Sakit</label>
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <label hidden class="labl">
                                <input type="radio" name="radioname" value="1" {{!isset($online_id) ? 'checked' : ''}}/>
                                <div class="block block-bordered block-link-shadow text-center">
                                    <div class="block-content">
                                        <p class="mt-5">
                                            <i class="fal fa-wheelchair fa-4x"></i>
                                        </p>
                                        <p class="font-w600">Rawat Jalan</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-lg-4 col-12">
                            <label hidden class="labl">
                                <input type="radio" name="radioname" value="2"/>
                                <div class="block block-bordered block-link-shadow text-center">
                                    <div class="block-content">
                                        <p class="mt-5">
                                            <i class="fal fa-ambulance fa-4x"></i>
                                        </p>
                                        <p class="font-w600">IGD</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-lg-4 col-12">
                            <label hidden class="labl">
                                <input type="radio" name="radioname" value="3" {{isset($online_id) ? 'checked' : ''}} />
                                <div class="block block-bordered block-link-shadow text-center">
                                    <div class="block-content">
                                        <p class="mt-5">
                                            <i class="fal fa-medkit fa-4x"></i>
                                        </p>
                                        <p class="font-w600">URIKKES</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                             
</div>
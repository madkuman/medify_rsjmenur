@if(!empty($cppt->updated_by))
    <div class="col-4">
        <h6 class="p-10">
            <small class="text-muted">Diupdate Oleh</small><br>
            `+item.updater.name+`<br>
            <span class="font-w400"> `+item.tanggal_update+`</span>
        </h6>
    </div>
@endif

@if(!empty($cppt->verified_by))
    <div class="col-4 ">
        <h6 class="p-10">
            <small class="text-muted">Verifikasi Dokter Oleh</small><br>
            `+item.verifier->name+`<br>
            <span class="font-w400"> `+item.tanggal_verifikasi+`</span>
        </h6>
    </div>
@else
    <div class="col-4 hide" id="cppt_container_verified_{{$i}}">
        <h6 class="p-10">
            <small class="text-muted">Verifikasi Dokter Oleh</small><br>
            <span id="cppt_verified_by_{{$i}}"></span><br>
            <span class="font-w400" id="cppt_verified_at_{{$i}}"></span>
        </h6>
    </div>
@endif

@if(!empty($cppt->verified_ners_by))
    <div class="col-4 ">
        <h6 class="p-10">
            <small class="text-muted">Verifikasi NERS Oleh</small><br>
            `+item.verifikatorNers.name+`<br>
            <span class="font-w400"> `+item.tanggal_verifikasi_ners+`</span>
        </h6>
    </div>
@else
    <div class="col-4 hide" id="cppt_ners_container_verified_{{$i}}">
        <h6 class="p-10">
            <small class="text-muted">Verifikasi NERS Oleh</small><br>
            <span id="cppt_ners_verified_by_{{$i}}"></span><br>
            <span class="font-w400" id="cppt_ners_verified_at_{{$i}}"></span>
        </h6>
    </div>
    @endif
    </div>
    </div>
    </div>
    </div>
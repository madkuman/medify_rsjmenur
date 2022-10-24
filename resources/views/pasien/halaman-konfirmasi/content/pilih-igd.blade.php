<div class="row pilih-igd">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <div class="row mb-5">
                        <label class="col-12">Mode Pendaftaran IGD</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="opsi_igd" id="opsiIGD1" value="1" checked="">
                                <label class="custom-control-label" for="opsiIGD1">Pilih Kasus</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="opsi_igd" id="opsiIGD2" value="2">
                                <label class="custom-control-label" for="opsiIGD2">Pilih Ruang</label>
                            </div>
                        </div>
                    </div>
                    <div class="igd-ruang">
                        <label class="control-label">Ruang IGD</label>
                        <select name="igd" class="form-control js-select2 select-igd" data-size="5" id="selectIGDRuang" style="width: 100%;">
                            <option></option>
                            @foreach($igd as $item)
                            @if($item->name=='P3')
                            <option value="{{$item->id}}" selected="selected">{{$item->name}}</option>
                            @else
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="igd-triage">
                        <label class="control-label">Pilih Kasus</label>
                        <select name="igd" class="form-control js-select2 select-igd" data-size="5" id="selectIGDTriage" style="width: 100%;">
                            <option></option>
                            @foreach($kasus_igd as $item)
                            <option value="{{$item->id}}">{{$item->identitas->nama ?? ''}} ({{$item->judul_kasus ?? ''}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>                             
</div>
<div class="row">
        <div class="col-md-12">
            <h5>DIAGNOSA</h5>
            <hr>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" class="css-control-input" id="prefix" name="prefix" 
                    @if($asuhan->prefix)
                        checked="" 
                    @endif>
                    <span class="css-control-indicator"></span> Prefix Diagnosa
                </label>
            </div>
            <div class="form-group">
                <label class="text-uppercase">DESKRIPSI DIAGNOSA</label>
            <textarea class="form-control" name="diagnosa">{{$asuhan->diagnosa}}</textarea>
            </div>
            <div class="form-group">
                <h6 class="text-uppercase">Data Diagnosa</h6>
                @foreach ($diagnosa as $item)
                    <div id="opsiPilihanDiagnosaContainer">
                        <div class="row justify-content-center item-wrapper">
                            <div class="col-md-10">
                                <div class="form-group">
                                <input type="text" class="form-control" name="opsi_diagnosa[{{$item->id}}]" onblur="" value="{{$item->konten}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div id="opsiPilihanDiagnosaContainer">
                    <div class="row justify-content-center item-wrapper">
                        <div class="col-md-10">
                            <div class="form-group">
                            <input type="text" class="form-control opsi" name="opsi_diagnosa[]" onblur="" placeholder="Deskripsikan Opsi Pilihan">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h6 class="text-uppercase">Data Penunjang</h6>
                @foreach ($penunjang as $item)
                    <div id="opsiPilihanDataPenunjangContainer">
                        <div class="row justify-content-center item-wrapper">
                            <div class="col-md-10">
                                <div class="form-group">
                                <input type="text" class="form-control" name="opsi_data_penunjang[{{$item->id}}]" onblur="" value="{{$item->konten}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div id="opsiPilihanDataPenunjangContainer">
                    <div class="row justify-content-center item-wrapper">
                        <div class="col-md-10">
                            <div class="form-group">
                            <input type="text" class="form-control opsi" name="opsi_data_penunjang[]" onblur="" placeholder="Deskripsikan Opsi Pilihan">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="form-group">
                <h6 class="text-uppercase">Data Subjektif</h6>
                @foreach ($subjektif as $item)
                    <div id="opsiPilihanDataSubjektifContainer">
                        <div class="row justify-content-center item-wrapper">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="opsi_data_subjektif[{{$item->id}}]" onblur="" value="{{$item->konten}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div id="opsiPilihanDataSubjektifContainer">
                    <div class="row justify-content-center item-wrapper">
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control opsi" name="opsi_data_subjektif[]" onblur="" placeholder="Deskripsikan Opsi Pilihan">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="form-group">
                <h6 class="text-uppercase">Data Objektif</h6>
                @foreach ($objektif as $item)
                    <div id="opsiPilihanDataObjektifContainer">
                        <div class="row justify-content-center item-wrapper">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="opsi_data_objektif[{{$item->id}}]" onblur="" value="{{$item->konten}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div id="opsiPilihanDataObjektifContainer">
                    <div class="row justify-content-center item-wrapper">
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control opsi" name="opsi_data_objektif[]" onblur="" placeholder="Deskripsikan Opsi Pilihan">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
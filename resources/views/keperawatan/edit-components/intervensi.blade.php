<div class="row">
        <div class="col-md-12">
            <h5>INTERVENSI</h5>
            <hr>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <h6 class="text-uppercase">Mandiri</h6>
                @foreach ($mandiri as $item)
                    <div id="opsiPilihanDiagnosaContainer">
                        <div class="row justify-content-center item-wrapper">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="opsi_mandiri[{{$item->id}}]" onblur="" value="{{$item->konten}}">
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
                                <input type="text" class="form-control opsi" name="opsi_mandiri[]" onblur="" placeholder="Deskripsikan Opsi Pilihan">
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
                <h6 class="text-uppercase">Kolaborasi</h6>
                @foreach ($kolaborasi as $item)
                    <div id="opsiPilihanDataSubjektifContainer">
                        <div class="row justify-content-center item-wrapper">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="opsi_kolaborasi[{{$item->id}}]" onblur="" value="{{$item->konten}}">
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
                                <input type="text" class="form-control opsi" name="opsi_kolaborasi[]" onblur="" placeholder="Deskripsikan Opsi Pilihan">
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
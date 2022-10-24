<div class="row">
        <div class="col-md-12">
            <h5>TUJUAN</h5>
            <hr>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-uppercase">DESKRIPSI Tujuan</label>
                <textarea class="form-control" name="tujuan">{{$asuhan->tujuan}}</textarea>
            </div>
            <div class="form-group">
                <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" class="css-control-input" id="durasi_tujuan" name="durasi_tujuan" @if($asuhan->durasi_tujuan) checked @endif>
                    <span class="css-control-indicator"></span> Durasi Tujuan
                </label>
            </div>
            <div class="form-group" @if(!$asuhan->durasi_tujuan) style="display: none" @endif id="sub_tujuan_container">
                <label class="text-uppercase">Sub Tujuan</label>
                <textarea class="form-control" name="sub_tujuan">{{$asuhan->sub_tujuan}}</textarea>
            </div>

            <div class="form-group">
                <h6 class="text-uppercase">Kriteria Hasil</h6>
                @foreach ($kriteriahasil as $item)
                    <div id="opsiPilihanDiagnosaContainer">
                        <div class="row justify-content-center item-wrapper">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="opsi_tujuan[{{$item->id}}]" onblur="" value="{{$item->konten}}">
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
                                <input type="text" class="form-control opsi" name="opsi_tujuan[]" onblur="" placeholder="Deskripsikan Opsi Pilihan">
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
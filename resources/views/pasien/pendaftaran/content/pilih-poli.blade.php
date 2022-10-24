<div class="row pilih-poli">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group row">
                    <div class="col-6">
                        <label class="control-label">Pilih Poli</label>
                        <select name="poli" class="form-control js-select2" data-size="5" id="selectPoli" style="width: 100%;">
                            <option value="0" selected disabled>Pilih Poli</option>
                            @foreach($poli as $item)
                            <option value="{{$item->id}}" @if(!is_null($mesin_antrian) && $mesin_antrian->poliklinik_id == $item->id) selected @endif data-kode="{{$item->bpjs_id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="control-label">Pilih Kelas Antrian</label>
                        <select name="antrian_kelas" class="form-control js-select2" data-size="5" id="selectKelasAntrian" style="width: 100%;">
                            <option value="0" selected disabled>Pilih Kelas Antrian</option>
                            @foreach($poli_level as $level)
                            <option value="{{$level->id}}" {{$level->level == 2 ? 'selected' : ''}}>{{$level->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="block block-bordered">
                        <div class="block-content">
                            <div id="InfoPoli" class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" id="selectDokter">
                <label class="control-label">Pilih Dokter Praktek <i id="selectDokterLoading" class="fa fa-asterisk fa-spin text-info" style="display: none"></i></label>
                <select name="dokter_poli" id="selectDokterElement" class="form-control js-select2" style="width: 100%;" disabled>
                    <option value="0" selected disabled>Dokter praktek belum tersedia hari ini</option>
                </select>
            </div>
            <div class="col-12 mt-10">
                <div class="py-10 text-center font-w600 bg-danger text-white mb-20 align-middle" id="error-wrapper-poliklinik" style="display: none;">
                    <i class="fa fa-exclamation-circle mr-5"></i>
                    <span></span>
                </div>
            </div>
        </div>
    </div>                             
</div>
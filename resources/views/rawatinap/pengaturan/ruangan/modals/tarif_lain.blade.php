<div class="modal" id="modal_tarif" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Edit Data Ruangan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <strong class="col-3 form-group">
                            Kelas
                        </strong>
                        <strong class="col-5 form-group">
                            Tarif
                        </strong>
                        <strong class="col-3 form-group">
                            Harga
                        </strong>
                        <div class="col-1 form-group">
                        </div>
                    </div>
                    <div id="tarif-wrapper">
                        @forelse($ruangan->tarif_lain as $tarif)
                        <div class="row" id="tarif-{{$loop->iteration}}" data-index="{{$loop->iteration}}">
                            <div class="col-3 form-group">
                                <select class="js-select2 form-control select-kelas-tarif" style="width: 100%;" data-placeholder="Pilih Kelas Tarif" id="kelas-tarif-{{$loop->iteration}}" disabled="">
                                    <option value=""></option>
                                    @foreach($tarif_kelas as $t)
                                    <option value="{{$t->id}}" @if($tarif->tarif->kelas_id == $t->id) selected="" @endif>Kelas {{$t->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5 form-group">
                                <select class="js-select2 form-control select-tarif" style="width: 100%;" data-placeholder="Pilih Tarif" id="tarif-{{$loop->iteration}}">
                                    <option value="{{json_encode($tarif->tarif)}}">{{$tarif->tarif->master->deskripsi}}</option>
                                </select>
                            </div>
                            <div class="col-3 form-group">
                                <input class="form-control harga-tarif" type="text" readonly="" value="Rp {{number_format($tarif->tarif->harga,0)}}" id="harga-tarif-{{$loop->iteration}}">
                            </div>
                            <div class="col-1 form-group">
                                <button type="button" class="btn btn-outline-danger btn-circle" onclick="removeTarif({{$loop->iteration}})">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        @empty

                        <div class="row" id="tarif-1" data-index="1">
                            <div class="col-3 form-group">
                                <select class="js-select2 form-control select-kelas-tarif" style="width: 100%;" data-placeholder="Pilih Kelas Tarif" id="kelas-tarif-1" disabled="">
                                    <option value=""></option>
                                    @foreach($tarif_kelas as $t)
                                    <option value="{{$t->id}}" @if($ruangan->kelas == $t->id) selected="" @endif>Kelas {{$t->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5 form-group">
                                <select class="js-select2 form-control select-tarif" style="width: 100%;" data-placeholder="Pilih Tarif" id="tarif-1">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-3 form-group">
                                <input class="form-control" type="text" readonly="" value="" id="harga-tarif-1">
                            </div>
                            <div class="col-1 form-group">
                                <button type="button" class="btn btn-outline-danger btn-circle" onclick="removeTarif(1)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        @endforelse
                       
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-lg btn-primary btn-circle" onclick="addTarif()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-hero" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-alt-primary btn-hero" onclick="simpanTarif()">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

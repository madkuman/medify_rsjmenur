<div class="row pilih-urikkes">
    <div class="col-8">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Pilih Paket
                        <span data-toggle="modal" data-target="#modal-paket">
                            <a  id="helpPaket" class="js-popover-enabled text-primary ml-5" data-toggle="popover" title="Informasi Paket" data-placement="top" data-content="Klik untuk menampilkan informasi detail paket dan layanan-layanan yang tersedia." data-trigger="hover" data-original-title="Top Popover" href="javascript:;" > <i class="fa fa-question-circle mr-5"></i></a>
                        </span>
                    </label>
                    <select name="poli" class="form-control js-select2" data-size="5" id="selectPaket" style="width: 100%;">
                        @foreach($paket as $item)
                        <option value="{{$item->id}}" data-harga="{{$item->total}}">{{$item->nama}}</option>
                        @endforeach
                        <option value="0" data-harga="0">Paket Custom</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Pilih Dokter</label>
                    <select name="dokter" class="form-control js-select2 not-required" data-size="5" id="selectDokterUrikkes" style="width: 100%;">
                        <option></option>
                        @foreach($dokter as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <button class="btn btn-success" type="button" id="urikkes_tambah" style="margin-top: 25px"><i class="fa fa-plus"></i> Tambah Layanan</button>
    </div>
</div>
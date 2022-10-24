<div class="row pilih-medical-checkup">
    <div class="col-12">
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
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>                             
</div>
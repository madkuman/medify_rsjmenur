<div class="modal" id="modal-print-resep-index" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="GET" action="{{url('farmasi/'.session('farmasi')->slug.'/resep/print')}}" target="_blank" id="form-print">

            <input type="hidden" name="id" id="id-transaksi">
            <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Print Resep </h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="dokter-container">
                                    <div class="form-group dokter-radio">
                                        <div class="custom-control custom-radio custom-control-inline mb-5">
                                            <input class="custom-control-input" type="radio" name="dokter_jenis" id="radio-button-1-resep" value="rsal" checked="">
                                            <label class="custom-control-label" for="radio-button-1-resep">RS</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline mb-5">
                                            <input class="custom-control-input" type="radio" name="dokter_jenis" id="radio-button-2-resep" value="luar">
                                            <label class="custom-control-label" for="radio-button-2-resep">Dokter Luar</label>
                                        </div>
                                    </div>
                                    <div class="form-group dokter-luar hide">
                                        <label>Dokter</label>
                                        <input type="text" name="dokter_luar" class="dokter-luar form-control" placeholder="Nama Dokter" value="" id="nama-dokter-print">
                                    </div>
                                    <div class="form-group dokter-rsal">
                                        <label>Dokter</label>
                                        <select class="js-select2 form-control" name="dokter_rsal" style="width: 100%;" id="select-dokter">
                                            <option value="" selected="" disabled>Pilih dokter</option>
                                            @foreach($dokter as $key => $d)
                                            <option value="{{$d->id}}" 
                                                @if($key == 0) selected
                                                @endif>{{$d->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="penyedia">Nomor Resep</label>
                                    <input type="text" class="form-control" name="nomor_resep" placeholder="Nomor Resep" id="nomor-resep-print">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-primary" id="btn-simpan-print">
                        <i class="fa fa-check"></i> Cetak
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
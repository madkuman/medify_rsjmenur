<div class="modal fade" id="modal-laporan-sk-dokter" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Surat Keterangan Dokter</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="dokter_laporan">Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control form-control-lg" id="dokter-nomor_surat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="dokter_laporan">Keperluan</label>
                            <input type="text" name="keperluan" class="form-control form-control-lg" id="dokter-keperluan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12">Buku Hasil SK Dokter</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio mb-5 custom-control-inline">
                                <input class="custom-control-input" type="radio" name="sk_dokter_ttd" id="dokter-radio1" value="sk_dokter1">
                                <label class="custom-control-label" for="dokter-radio1">1 TTD</label>
                            </div>
                            <div class="custom-control custom-radio mb-5 custom-control-inline">
                                <input class="custom-control-input" type="radio" name="sk_dokter_ttd" id="dokter-radio2" value="sk_dokter2">
                                <label class="custom-control-label" for="dokter-radio2">2 TTD</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-5" style="display: none;" id="dokter_laporan2_wrapper">
                        <div class="col-6">
                            <label for="dokter_laporan">Tanda Tangan Kedua</label>
                            <select  class="form-control form-control-lg js-select2" data-size="5" id="dokter_laporan2" name="dokter2" style="width: 100%;" placeholder="Dokter Pemeriksa">
                                <option value="" disabled>Pilih Dokter</option>
                                @foreach($dokter as $doc)
                                <option value="{{$doc->id}}" data-sebagai="{{$doc->sebagai}}" data-keterangan="{{$doc->keterangan}}" >{{$doc->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" id="submit_laporan_sk_dokter">Cetak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
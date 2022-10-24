<div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout modal-dialog-centered modal-lg" role="document">
        <div class="block rounded modal-content transaction-index" ng-controller="PasienController">
            <div class="modal-header pb-0">
                <h2>Penerimaan Barang Cuci</h2>
            </div>
            <div class="modal-body pb-0 pt-0">
                <h5>Lakukan cek terhadap barang yang anda terima</h5>
            </div>
            <div class="modal-content">
                <div class="table-full-width">
                    <div class="block-content">
                            <table class="table table-vcenter table-stripped">
                                <thead>
                                    <tr class="header">
                                      <th width="5%">#</th>
                                      <th width="15%">NAMA BARANG</th>
                                      <th width="18%">JUMLAH DISERAHKAN</th>
                                      <th width="22%">KET</th>
                                      <th width="18%">JUMLAH DITERIMA</th>
                                      <th width="22%">KET</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form id="modalAccept">
                                        @foreach ($permintaan as $pa)
                                        <tr>
                                            <td>{{$pa->nomor}}</td>
                                            <td>{{$pa->nama_barang}}</td>
                                            <td>{{$pa->diserahkan}}</td>
                                            <td>{{$pa->keterangan}}</td>
                                            <td><input class="form-control" type="number" id="barang{{$pa->nomor}}" placeholder="Jumlah" min="0" step="1" oninput="validity.valid||(value='');"/><input class="form-control" type="hidden"  id="detail{{$pa->nomor}}" placeholder="Jumlah" value="{{$pa->detail_id}}" /></td>
                                            <td><input class="form-control" type="text" id="ket{{$pa->nomor}}" placeholder="Keterangan" min="0" step="1" oninput="validity.valid||(value='');"/></td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            <div class="block-content">
                                <div class="col-md-12 text-right">
                                        <button class="btn btn-secondary" style="padding:0px 40px;" type="button" id="buttonCancelModal" data-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary ml-2" style="padding:0px 40px;" type="button" id="buttonSubmitModal">Simpan</button>
                                        <button class="btn btn-alt-primary ml-2" style="display: none; padding:0px 40px;" type="button"  id="buttonLoading">
                                        <i class="fa fa-asterisk fa-spin"></i> Memuat
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

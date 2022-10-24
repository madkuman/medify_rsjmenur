<div class="modal fade" id="modal-subscribe-resep" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block mb-0">
                <div class="block-header">
                    <h3 class="block-title">Subscribe Paket Obat</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <label class="col-12" for="">Cari Paket Obat</label>
                                <div class="col-12">
                                    <input type="text" class="form-control form-control-lg" placeholder="Ketikkan Kata Kunci" id="search-paket-obat" autocomplete="off">
                                </div>
                                <div class="col-12 mt-20">
                                    <table table class="table table-striped table-hover">
                                        <tr class="header">
                                            <th style="width:75%">Nama Paket</th>
                                            <th style="width:25%">Aksi</th>
                                        </tr>
                                    </table>
                                    <div class="form-group" style="height: 350px;overflow-y: scroll; overflow-x: hidden;">
                                        <div class="daftar-paket" id="daftar-paket">
                                            <ul class=" list">
                                                @foreach($all_paket_obat as $item)
                                                <li class="row py-10" style="border-bottom: solid 1px #ccc" id="paket-obat-{{$item->id}}">
                                                    <div class="item-paket col-8">
                                                        {{$item->nama}} - {{$item->creator->name ?? ''}} 
                                                        @if($item->subscribe)
                                                        <span class="badge badge-success">Subscribed</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-4">
                                                        <button type="button" class="btn btn-primary" onclick="previewPaketSubscribe({{$item->id}})">
                                                            Lihat
                                                        </button>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div id="error-subscribe-paket-obat" class="text-center" style="display: none">
                                <div class="alert alert-danger">
                                    <span>Sorry Terjadi Kesalahan Server. <br>Silahkan coba lagi</span>
                                </div>
                            </div>
                            <div id="success-subscribe-paket-obat" class="text-center" style="display: none">
                                <div class="alert alert-primary">
                                    <span>Subscribe Sukses!</span>
                                </div>
                            </div>
                            <div id="warning-subscribe-paket-obat" class="text-center" style="display: none">
                                <div class="alert alert-warning">
                                    <span>Subscribe Sukses!</span>
                                </div>
                            </div>
                            <div id="paket-obat-result-container" style="display: none">
                                <button class="btn btn-primary pull-right" id="btn-subscribe-paket-obat">Subscribe</button>
                                <button class="btn btn-primary pull-right" id="btn-subscribe-paket-obat-loading" disabled><i class="fa fa-spinner fa-spin"></i> Subscribe</button>
                                <button class="btn btn-primary pull-right" id="btn-subscribe-paket-obat-success" disabled><i class="fa fa-check"></i> Subscribe</button>
                                <h4 id="paket-obat-nama">Nama Paket Obat</h4>
                                <div id="paket-obat-result">
                                </div>
                            </div>
                            <div id="loading-subscribe-paket-obat" class="py-50 text-center" style="display: none">
                                <i class="fa fa-spin fa-spinner fa-4x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
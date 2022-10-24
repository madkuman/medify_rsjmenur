<div class="modal fade" id="modal-update-pembayaran" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Edit Pembayaran</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content py-0">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/identitas/pembayaran/update" method="post">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-8">
                                <label for="be-contact-name">Pembayaran Utama</label>
                                <select class="form-control" data-size="5" id="identitas-edit-asuransi" name="pembayaran_utama_id" style="width: 100%;">
                                    @foreach($metode as $item)
                                    @if($item->id == $kasus->pasien_pembayaran_id)
                                        <option value="{{$item->id}}" selected="selected">{{$item->perusahaan->nama ?? '-'}} - {{$item->no_asuransi ?? '-'}}  - Kelas {{$item->kelas->nama ?? '-'}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->perusahaan->nama}} - {{$item->no_asuransi}}  - Kelas {{$item->kelas->nama}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h5 class="mb-0">Pembayaran Tambahan</h5>
                        <p>Digunakan jika pasien melakukan IUR, naik kelas, atau pihak penjamin utama <br>tidak dapat memenuhi seluruh tagihan pasien.</p>
                       
                        @if(count($kasus->pembayaranTambahan) > 0)
                            @foreach($kasus->pembayaranTambahan as $item)
                                @include('kasus.datamedis.content.identitas.components.select-edit-pembayaran-tambahan',['active_select_pembayaran_tambahan' => $item->pasien_pembayaran_id])
                            @endforeach
                        @else
                            @include('kasus.datamedis.content.identitas.components.select-edit-pembayaran-tambahan',['active_select_pembayaran_tambahan' => 0])
                        @endif
                        <div id="append-pembayaran-tambahan-container">
                        </div>
                        <div class="row">
                            <div class="col-10 text-center mt-20">
                                <button type="button" class="btn btn-primary btn-circle" id="btn-add-edit-pembayaran-tambahan"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-alt btn-click-animate btn-hero btn-primary min-width-175 pull-right">
                                    <i class="fa fa-send mr-5"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
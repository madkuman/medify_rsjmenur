<div class="modal fade" id="checkoutTagihan" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{url()->current()}}/checkout" method="POST" id="tagihanCheckout">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header ">
                        <h3 class="block-title">Checkout Tagihan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    @if(!empty($kasus->pasien_pembayaran_id))
                        @if($kasus->pembayaran->perusahaan->tipe->slug == 'tunai')
                        <div class="block-content px-0 row">
                            {{csrf_field()}}
                            <input type="hidden" name="tagihan_id" id="tagihanCheckoutID" value="{{$tagihan->id}}">
                            <div class="form-group col-md-12">
                                <label>Kasir Tujuan</label>
                                <select name="kasir_tujuan" id="selectKasir" class="form-control js-select2" style="width: 100%;" data-size="2" data-placeholder="Pilih Kasir Tujuan">
                                    <option></option>
                                    @foreach($kasir as $item)
                                    <option value="{{$item->id}}"
                                    @if($item->id == $default_kasir->id) selected @endif
                                    >{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @else
                        <div class="block-content px-0 row">
                            {{csrf_field()}}
                            <input type="hidden" name="tagihan_id" id="tagihanCheckoutID" value="{{$tagihan->id}}">
                            <div class="form-group col-md-12">
                                <span style="font-size: 1.25em;">Apakah anda yakin akan mengirim tagihan untuk diklaimkan ke Asuransi?</span>
                            </div>
                            @if($split == 1 && 0)
                            <div class="col-12">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" name="split_piutang" class="css-control-input">
                                    <span class="css-control-indicator"></span> Tagihkan kekurangan kepada pasien.
                                </label>
                            </div>
                            @endif
                        </div>
                        @endif
                    @else
                    <div class="block-content px-0 row">
                        <div class="form-group col-md-12">
                            <label>Silahkan lakukan pengisian Metode Pembayaran pada halaman Data Medis agar dapat melakukan Checkout ke Kasir</label>
                        </div>
                    </div>
                    @endif
                </div>
                @if(!empty($kasus->pasien_pembayaran_id))
                <div class="text-center py-10">
                    <button type="submit" class="btn-alt btn-grass min-width-100 float-right" id="submitCheckout">
                        <i class="fa fa-check"></i> Checkout
                    </button>
                    <button type="button" data-dismiss="modal" class="btn-alt btn-hero btn-regular min-width-100 float-right">Batal
                </div>
                @endif
            </form>
        </div>
    </div>
</div>


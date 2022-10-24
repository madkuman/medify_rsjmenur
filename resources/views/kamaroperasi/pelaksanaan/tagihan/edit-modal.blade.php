<div class="modal fade" id="editTagihan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{url('kamaroperasi/pelaksanaan/tagihan-edit')}}">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header ">
                        <h3 class="block-title">Edit Tagihan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content px-0 row">
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="tagihanEditID">
                        <input type="hidden" name="kasus_id" value="{{$trans_info->kasus->id}}">
                        <input type="hidden" name="operasi_id" value="{{$transaksi->id}}"> 
                        @if(!empty($trans_info->kasus->tagihan->id))
                        <input type="hidden" name="tagihan_id" id="tagihanEditID" value="{{$trans_info->kasus->tagihan->id}}">
                        @else
                        <input type="hidden" name="tagihan_id" id="tagihanEditID" value="">
                        @endif
                        <!-- <input type="hidden" name="daftar_harga_id" id="tagihanEditDaftarHargaID"> -->
                        <input type="hidden" name="tarif_id" id="tagihanEditTarifID">
                        <!-- <input type="hidden" name="departemen_id" id="tagihanEditDepartemenID" value="5"> -->
                        <input type="hidden" name="lokasi" value="{{$trans_info->ruangan->lokasi_id}}">
                        <!-- <input type="hidden" name="tarif_tipe_id" id="tagihanEditTarifTipeID"> -->
                        <input type="hidden" name="tarif_kelas" id="tagihanEditTarifKelas" value="{{$trans_info->kasus->kelas->id}}">

                        <div class="form-group col-md-12">
                            <label>Deskripsi Tagihan</label>
                            <input readonly type="text" id="tagihanEditDesc" required=""  class="tagihan-autocomplete-edit form-control form-control-lg"  name="desc" placeholder="Uraian Penagihan" value="" onchange="emptyEditDaftarHargaID()">
                        </div>

                        <div class="form-group col-md-12 ">
                            <label>Harga Satuan <i id="tarifEditLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Rp
                                    </span>
                                </div>
                                <input type="text" class="form-control" onchange="updateEditSubTotal()" id="tagihanEditUnitPrice" required=""  name="unit_price" placeholder="Harga Satuan" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group col-md-12 ">
                            <label>Jumlah</label>
                            <input type="text" class="form-control form-control-lg" required=""  onchange="updateEditSubTotal()" id="tagihanEditQty" name="qty" placeholder="Uraian Penagihan" value="">
                        </div>


                        <div class="form-group col-md-12 ">
                            <label>Sub Total</label>
                            <input type="text" class="form-control form-control-lg" required=""  id="tagihanEditSubTotalMask" placeholder="Total Penagihan" value="" disabled>
                        </div>

                    </div>
                </div>
                <div class="text-center py-10">
                    <button type="submit" class="btn-alt btn-grass">
                        <i class="fa fa-check"></i> Edit Tagihan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


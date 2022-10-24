<div class="modal fade" id="editTagihan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/tagihan-detail/edit">
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
                        <input type="hidden" name="kasus_id" value="{{$kasus->id}}">
                        <input type="hidden" name="tagihan_id" id="tagihanEditTagihanID" value="{{$tagihan->id}}">
                        <input type="hidden" name="tarif_id" id="tagihanEditTarifID">
                        <input type="hidden" name="kategori_id" id="tagihanEditKategoriID" value="{{$kasus->lokasi->lokasi->kategori_keuangan_id}}">
                        <input type="hidden" name="lokasi_id" id="tagihanEditLokasiID" value="{{$kasus->lokasi->lokasi->id}}">
                        {{--<input type="hidden" name="departemen_id" id="tagihanEditDepartemenID">
                        <input type="hidden" name="tarif_tipe_id" id="tagihanEditTarifTipeID">--}}
                        <input type="hidden" name="tarif_kelas" id="tagihanEditTarifKelasID" value="{{$kasus->kelas->id}}">

                        <div class="form-group col-md-12 ">
                            <label>BPJS SEP</label>
                            <select name="sep_id" id="tagihanEditSelectSEP" class="form-control js-select2" style="width: 100%;" data-size="2">
                                @foreach($bpjssep as $item)
                                    <option value="{{$item->id}}">{{$item->no_sep}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Tanggal Transaksi </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_transaksi" placeholder="Pilih Tanggal" id="tagihanEditTanggalTransaksi" data-week-start="1" data-autoclose="true" data-today-highlight="true"  data-date-format="dd-mm-yyyy" autocomplete="off" value="" onkeydown="return false" required>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <div class="row gutters-tiny">
                                    <div class="col-6">
                                        <label class="control-label">Jam</label>
                                        <select class="form-control" name="jam" style="width: 100%;" id="tagihanEditJamTransaksi">
                                            @for($i=00; $i<=23; $i++)
                                                <option value="@if(strlen($i) == 1 ){{'0'.$i}}@else{{$i}}@endif" @if(date('H') == $i){{'selected'}}@endif>@if(strlen($i) == 1 ){{'0'.$i}}@else{{$i}}@endif</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label">Menit</label>
                                        <select class="form-control" name="menit" style="width: 100%;" id="tagihanEditMenitTransaksi">
                                            @for($i=00; $i<=59; $i++)
                                                <option value="@if(strlen($i) == 1 ){{'0'.$i}}@else{{$i}}@endif" @if(date('i') == $i){{'selected'}}@endif>@if(strlen($i) == 1 ){{'0'.$i}}@else{{$i}}@endif</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Deskripsi Tagihan</label>
                            <input readonly type="text" id="tagihanEditDesc" class="tagihan-autocomplete-edit form-control form-control-lg" required=""  name="desc" placeholder="Uraian Penagihan" value="" onchange="emptyEditDaftarHargaID()">
                        </div>

                        <div class="form-group col-md-12 ">
                            <label>Harga Satuan <i id="tarifEditLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                            <input readonly type="text" class="form-control form-control-lg" onchange="updateEditSubTotal()" id="tagihanEditUnitPrice" required="" name="unit_price" placeholder="Harga Satuan" value="">

                        </div>


                        <div class="form-group col-md-12 ">
                            <label>Jumlah</label>
                            <input type="number" class="form-control form-control-lg" onchange="updateEditSubTotal()" id="tagihanEditQty" required="" name="qty" placeholder="Uraian Penagihan" value="">
                        </div>

                        <div class="form-group col-md-12 ">
                            <label>Sub Total</label>
                            <input type="text" class="form-control form-control-lg"  id="tagihanEditSubTotalMask" placeholder="Total Penagihan" required="" value="" disabled>
                        </div>

                    </div>
                </div>
                <div class="text-center py-10">
                    <button type="submit" class="btn-alt btn-grass btn-click-animate">
                        <i class="fa fa-check"></i> Edit Tagihan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPindahkanTagihan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/tagihan-detail/pindahkan-multi">
                {{csrf_field()}}
                <input type="hidden" name="tagihan_id" id="fromTagihanId">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header ">
                        <h3 class="block-title">Pindahkan Tagihan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content px-0 row">
                        <div class="form-group col-md-12 ">
                            <label>Tujuan Tagihan</label>
                            <select name="tujuan_tagihan" id="tujuanTagihanId" class="form-control js-select2" style="width: 100%;">
                            </select>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                            <label class="css-control css-control-lg css-control-secondary css-checkbox pull-right">
                                <input type="checkbox" name="detail_select_all" class="css-control-input">
                                <span class="css-control-indicator"></span> Pilih Semua
                            </label>
                        </div>
                        <div class="col-12" id="detailContent">
                        </div>
                    </div>
                </div>
                <div class="text-center py-10">
                    <button type="submit" class="btn-alt btn-grass btn-click-animate">
                        <i class="fa fa-check"></i> Pindahkan Tagihan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


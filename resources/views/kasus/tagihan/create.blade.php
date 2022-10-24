<div class="modal fade" id="tambahTagihan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/tagihan-detail/create">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header ">
                        <h3 class="block-title">Tambah Tagihan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content px-0 row">
                        {{csrf_field()}}
                        <input type="hidden" name="kasus_id" value="{{$kasus->id}}">
                        <input type="hidden" name="tagihan_id" id="tagihanCreateTagihanID" value="{{$tagihan->id}}">
                        <input type="hidden" name="tarif_id" id="tagihanCreateTarifID">
                        <input type="hidden" name="tarif_master_id" id="tagihanCreateTarifMasterID">
                        <input type="hidden" name="kategori_id" id="tagihanCreateKategoriID" value="{{$kasus->lokasi->lokasi->kategori_keuangan_id}}">
                        <input type="hidden" name="lokasi_id" id="tagihanCreateLokasiID" value="{{$kasus->lokasi->lokasi->id}}">
                        <!-- <input type="hidden" name="departemen_id" id="tagihanCreateDepartemenID"> -->
                        <!-- <input type="hidden" name="tarif_tipe_id" id="tagihanCreateTarifTipeID"> -->
                        <input type="hidden" name="tarif_kelas_id" id="tagihanCreateTarifKelasID" value="{{$kasus->kelas->id}}">

                        <div class="form-group col-md-6">
                            <label>Tanggal Transaksi </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_transaksi" placeholder="Pilih Tanggal" id="tagihanTanggalTransaksi" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d-m-Y', time())}}" data-date-format="dd-mm-yyyy" autocomplete="off" onkeydown="return false" required>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <div class="row gutters-tiny">
                                    <div class="col-6">
                                        <label class="control-label">Jam</label>
                                        <select class="form-control" name="jam" style="width: 100%;">
                                            @for($i=00; $i<=23; $i++)
                                                <option value="@if(strlen($i) == 1 ){{'0'.$i}}@else{{$i}}@endif" @if(date('H') == $i){{'selected'}}@endif>@if(strlen($i) == 1 ){{'0'.$i}}@else{{$i}}@endif</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label">Menit</label>
                                        <select class="form-control" name="menit" style="width: 100%;">
                                            @for($i=00; $i<=59; $i++)
                                                <option value="@if(strlen($i) == 1 ){{'0'.$i}}@else{{$i}}@endif" @if(date('i') == $i){{'selected'}}@endif>@if(strlen($i) == 1 ){{'0'.$i}}@else{{$i}}@endif</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group col-md-12">
                            <label>Tipe Tarif</label>
                            <select class="js-select2 form-control" name="tarif_tipe_id" id="tagihanCreateTarifTipeID" style="width: 100%;" data-placeholder="Pilih Tipe Tarif">
                                @foreach($tipe_tarif as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Deskripsi Tagihan</label>
                            <input type="text" id="tagihanCreateDeskripsi" class="tagihan-autocomplete form-control form-control-lg"  name="desc" placeholder="Uraian Penagihan" value="" required="" onchange="emptyDaftarHargaID()">
                            <span class="text-danger hide" id="warningPilihTipeTarif">Pilih Tipe Tarif terlebih dahulu</span>
                            <div>Bingung mencari tarif? <a href="javascript:void(0)" onclick="lihatDaftarTarif()">Lihat Daftar Tarif Disini</a></div>
                        </div>

                        <div class="form-group col-md-12" style="display: none;">
                            <label>Pilih Tagihan Acuan</label>
                            <select class="js-select2 form-control" id="tagihanCreatePercent" style="width: 100%;" data-placeholder="Pilih Tagihan Acuan">
                                <option></option>
                                @foreach($tagihan->detail_descending as $item)
                                <option value="{{$item->subtotal}}">{{$item->desc}} (Rp. {{number_format($item->subtotal,0)}})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12 ">
                            <label>Harga Satuan <i id="tarifLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                            <input readonly type="text" class="form-control form-control-lg" onchange="updateCreateSubTotal()" id="tagihanCreateUnitPrice" required="" name="unit_price" placeholder="Harga Satuan" value="">

                        </div>


                        <div class="form-group col-md-12 ">
                            <label>Jumlah</label>
                            <input type="number" class="form-control form-control-lg" onchange="updateCreateSubTotal()" id="tagihanCreateQty" required="" name="qty" placeholder="Uraian Penagihan" value="">
                        </div>


                        <div class="form-group col-md-12 ">
                            <label>Sub Total</label>
                            <input type="text" class="form-control form-control-lg"  id="tagihanCreateSubTotalMask" placeholder="Total Penagihan" required="" value="" disabled>
                        </div>

                    </div>
                </div>
                <div class="text-center py-10">
                    <button type="submit" class="btn-alt btn-grass btn-click-animate">
                        <i class="fa fa-check"></i> Tambah Tagihan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


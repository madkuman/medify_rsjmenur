{{--
<div class="modal fade" id="tambahTagihan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="{{url('kamaroperasi/pelaksanaan/tagihan-tambah')}}">
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
                        <input type="hidden" name="kasus_id" value="{{$trans_info->kasus->id}}">
                        @if(!empty($trans_info->kasus->tagihan->id))
                        <input type="hidden" name="tagihan_id" id="tagihanCreateTagihanID" value="{{$trans_info->kasus->tagihan->id}}">
                        @else
                        <input type="hidden" name="tagihan_id" id="tagihanCreateTagihanID" value="">
                        @endif

                        <!-- <input type="hidden" name="daftar_harga_id" id="tagihanCreateDaftarHargaID"> -->
                        <input type="hidden" name="kategori_id" id="tagihanCreateKategoriID" value="{{$trans_info->kasus->lokasi->lokasi->kategori_keuangan_id}}">
                        <input type="hidden" name="tarif_id" id="tagihanCreateTarifID">
                        <!-- <input type="hidden" name="departemen_id" id="tagihanCreateDepartemenID" value="5"> -->
                        <input type="hidden" name="lokasi" value="{{$trans_info->ruangan->lokasi_id}}">
                        <!-- <input type="hidden" name="tarif_tipe_id" id="tagihanCreateTarifTipeID"> -->
                        <input type="hidden" name="tarif_kelas" id="tagihanCreateTarifKelas" value="{{$trans_info->kasus->kelas->id}}">
                        <input type="hidden" name="transaksi_kamar_operasi_id" id="transaksiKamarOperasiID" value="{{$transaksi->id}}">


                        <div class="form-group col-md-12">
                            <label>Tipe Tarif</label>
                            <select class="js-select2 form-control" name="tarif_tipe_id" id="tagihanCreateTarifTipeID" style="width: 100%;" data-placeholder="Pilih Tipe Tarif">
                                <option></option>
                                @foreach($tipe_tarif as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Deskripsi Tagihan</label>
                            <input type="text" class="tagihan-autocomplete form-control form-control-lg"  name="desc" placeholder="Uraian Penagihan" required="" value="" onchange="emptyDaftarHargaID()">
                            <span class="text-danger" id="warningPilihTipeTarif">Pilih Tipe Tarif terlebih dahulu</span>
                            <div>Bingung mencari tarif? <a href="javascript:void(0)" onclick="lihatDaftarTarif()">Lihat Daftar Tarif Disini</a></div>
                        </div>

                        <div class="col-md-12">
                            
                        </div>

                        <div class="form-group col-md-12" style="display: none;">
                            <label>Pilih Tagihan Acuan</label>
                            <select class="js-select2 form-control" id="tagihanCreatePercent" style="width: 100%;" data-placeholder="Pilih Tagihan Acuan">
                                <option></option>
                                @foreach($tagihan as $item)
                                <option value="{{$item->subtotal}}">{{$item->desc}} (Rp. {{number_format($item->subtotal,0)}})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12 ">
                            <label>Harga Satuan <i id="tarifLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Rp
                                    </span>
                                </div>
                                <input type="text" class="form-control" onchange="updateCreateSubTotal()" id="tagihanCreateUnitPrice" required=""  name="unit_price" placeholder="Harga Satuan" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12 ">
                            <label>Jumlah</label>
                            <input type="text" class="form-control form-control-lg" onchange="updateCreateSubTotal()" id="tagihanCreateQty" required=""  name="qty" placeholder="Uraian Penagihan" value="">
                        </div>


                        <div class="form-group col-md-12 ">
                            <label>Sub Total</label>
                            <input type="text" class="form-control form-control-lg"  id="tagihanCreateSubTotalMask" placeholder="Total Penagihan" required=""  value="" disabled>
                        </div>

                    </div>
                </div>
                <div class="text-center py-10">
                    <button type="submit" class="btn-alt btn-grass">
                        <i class="fa fa-check"></i> Tambah Tagihan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
--}}

<div data-keyboard="false" class="modal fade" id="modal-create-tindakan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-full" role="document" style="min-width: 100%; margin: 0;">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Buat Tagihan Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <form class="js-validation-be-contact" action="{{url('kamaroperasi/pelaksanaan/tagihan-tambah')}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="transaksi_kamar_operasi_id" id="transaksiKamarOperasiID" value="{{$transaksi->id}}">
                    <input type="hidden" name="kasus_id" value="{{$trans_info->kasus->id}}">
                    <input type="hidden" name="lokasi" value="{{$trans_info->ruangan->lokasi_id}}">
                    <input type="hidden" name="kategori_id" id="tagihanCreateKategoriID" value="{{$trans_info->ruangan->lokasi->kategori_keuangan_id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="block-content" style="border-right: 1px solid #e6e6e6;">                            
                            <!-- <input type="hidden" name="icd_9" id="icd_9">

                            <div class="form-group row">
                                 <label class="col-12">Kategori Tindakan</label>
                                 <div class="col-12">
                                     <div class="custom-control custom-radio custom-control-inline mb-5">
                                         <input class="custom-control-input" type="radio" name="kategori-tindakan" id="example-inline-radio1" value="keperawatan" onchange="show_top()" checked>
                                         <label class="custom-control-label" for="example-inline-radio1">Keperawatan</label>
                                     </div>
                                     <div class="custom-control custom-radio custom-control-inline mb-5">
                                         <input class="custom-control-input" type="radio" name="kategori-tindakan" id="example-inline-radio2" onchange="hide_top()" value="icd9">
                                         <label class="custom-control-label" for="example-inline-radio2">Tindakan ICD9</label>
                                     </div>
                                 </div>
                             </div> -->
                            @include('kasus.datamedis.content.tindakan.components-perawat.main')
                            </div>
                        </div>
                        <div class="col-md-6 top-tindakan">
                            @include('kasus.datamedis.content.tindakan.components-perawat.tindakan-selected')
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div data-keyboard="false" class="modal fade" id="modal-create-tindakan-manual" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
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
                    <input type="hidden" name="transaksi_kamar_operasi_id" id="transaksiKamarOperasiIDManual" value="{{$transaksi->id}}">
                    <input type="hidden" name="kasus_id" value="{{$trans_info->kasus->id}}">
                    <input type="hidden" name="lokasi" value="{{$trans_info->ruangan->lokasi_id}}">
                    <input type="hidden" name="kategori_id" id="tagihanCreateKategoriIDManual" value="{{$trans_info->ruangan->lokasi->kategori_keuangan_id}}">
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
                            @include('kasus.datamedis.content.tindakan.components-perawat.main-manual')
                            </div>
                        </div>
                        <div class="col-md-6 top-tindakan">
                            @include('kasus.datamedis.content.tindakan.components-perawat.tindakan-selected-manual')
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
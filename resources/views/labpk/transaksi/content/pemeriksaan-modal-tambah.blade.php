@foreach($transaksi->detail as $detail)
    @if(is_null($detail->result))
        <div class="modal fade" id="periksa{{$detail->slug}}" tabindex="-1" role="dialog" aria-labelledby="modal-slideleft" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-slideleft" role="document">
                <div class="modal-content">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Pemeriksaan {{$detail->tarif->deskripsi}}</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <input type="hidden" name="layanan_id[{{$detail->id}}]" value="{{$detail->tarif_id}}">

                                @php $print_header = 0 @endphp

                                @foreach($detail->tarif->labpk_form_tarif as $form_tarif)
                                @if(isset($form_tarif->form->type))
                                @if($form_tarif->form->type == 'parameter-number' || $form_tarif->form->type == 'parameter-text' || $form_tarif->form->type == 'parameter-number-greatherthan' || $form_tarif->form->type == 'parameter-number-lessthan')

                                    @if($print_header == 0)
                                    <div class="row">
                                        <label class="col-lg-2 col-form-label">Parameter</label>
                                        <div class="col-lg-2 col-form-label text-center">Hasil</div>
                                        <label class="col-lg-2 col-form-label text-center">Satuan</label>
                                        <label class="col-lg-3 col-form-label text-center">Referensi</label>
                                        <label class="col-lg-3 col-form-label text-center">Nilai Kritis</label>
                                        <div class="col-12"><hr></div>
                                    </div>
                                    @endif
                                    @php $print_header = 1 @endphp

                                    @foreach($form_tarif->form->detail as $form_detail)
                                    @if(($form_detail->jk_pria && $transaksi->pasien->gender == 1) || ($form_detail->jk_wanita && $transaksi->pasien->gender != 1))
                                    @if($form_detail->usia_min <= $usia_px && $form_detail->usia_max >= $usia_px)

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label">{{$form_tarif->form->parameter}}</label>
                                        <div class="col-lg-2">
                                            <input type="text" class="form-control" name="form_{{$detail->slug}}_{{$form_detail->id}}" placeholder="Hasil">
                                        </div>
                                        <label class="col-lg-2 col-form-label text-center">{{$form_tarif->form->satuan}}</label>

                                        @if($form_tarif->form->type == 'parameter-number')
                                        <label class="col-lg-3 col-form-label text-center">{{$form_detail->referensi_min ?? 'XXX'}} - {{$form_detail->referensi_max ?? 'XXX'}}</label>
                                        <label class="col-lg-3 col-form-label text-center">< {{$form_detail->kritis_min ?? 'XXX'}} dan > {{$form_detail->kritis_max ?? 'XXX'}}</label>
                                        @elseif($form_tarif->form->type == 'parameter-text')
                                        <label class="col-lg-3 col-form-label text-center">{{$form_detail->referensi_lainnya ?? 'XXX'}}</label>
                                        @elseif($form_tarif->form->type == 'parameter-number-greatherthan')
                                        <label class="col-lg-3 col-form-label text-center"> >{{$form_detail->referensi_min ?? 'XXX'}}</label>
                                        <label class="col-lg-3 col-form-label text-center"> <{{$form_detail->kritis_min ?? 'XXX'}}</label>
                                        @elseif($form_tarif->form->type == 'parameter-number-lessthan')
                                        <label class="col-lg-3 col-form-label text-center"> <{{$form_detail->referensi_max ?? 'XXX'}}</label>
                                        <label class="col-lg-3 col-form-label text-center"> >{{$form_detail->kritis_max ?? 'XXX'}}</label>
                                        @endif
                                    </div>
                                    @endif
                                    @endif
                                    @endforeach
                                    <hr>
                                @elseif($form_tarif->form->type == 'paragraph')
                                    <div class="form-group">
                                        <label>{{$form_tarif->form->parameter}}</label>
                                        <textarea class="form-control" name="form_text_{{$detail->slug}}_{{$form_tarif->form->id}}" rows="5"></textarea>
                                    </div>
                                @elseif($form_tarif->form->type == 'text')
                                    <div class="form-group">
                                        <label>{{$form_tarif->form->parameter}}</label>
                                        <input type="text" class="form-control" name="form_text_{{$detail->slug}}_{{$form_tarif->form->id}}">
                                    </div>
                                @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" data-dismiss="modal">
                                <i class="fa fa-check"></i> Simpan
                            </button>
                        </div>
                    </div>
            </div>
        </div>
    @endif
@endforeach
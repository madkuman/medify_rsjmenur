@foreach($transaksi->detail as $detail)
<div class="modal fade" id="modalEdit{{$detail->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-slideleft" aria-hidden="true">
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
                        @php $print_header = 0 @endphp
                        <input type="hidden" name="layanan_id[{{$detail->id}}]" value="{{$detail->tarif_id}}">
                        <input type="hidden" name="transaksi_detail_id[]" value="{{$detail->id}}">
                        @if(count($detail->hasil) > 0)
                            @foreach($detail->hasil as $hasil)
                                @if($hasil->form_type == 'parameter-number' || $hasil->form_type == 'parameter-text' || $hasil->form_type == 'parameter-number-greatherthan' || $hasil->form_type == 'parameter-number-lessthan')

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

                                @endif

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">{{$hasil->parameter}}</label>
                                    @if($hasil->form_type == 'parameter-number' || $hasil->form_type == 'parameter-text' || $hasil->form_type == 'parameter-number-greatherthan' || $hasil->form_type == 'parameter-number-lessthan')
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control" value="{{$hasil->value}}" name="form_{{$detail->slug}}_{{str_replace(' ', '_',$hasil->form_detail_id)}}" placeholder="Hasil">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">{{$hasil->satuan}}</label>
                                    <label class="col-lg-3 col-form-label text-center">
                                        @if($hasil->form_type == 'parameter-number')
                                        {{$hasil->referensi_min ?? ''}} - {{$hasil->referensi_max ?? ''}}
                                        @elseif($hasil->form_type == 'parameter-text')
                                        {{$hasil->referensi_lainnya ?? ''}}
                                        @elseif($hasil->form_type == 'parameter-number-greatherthan')
                                        >{{$hasil->referensi_min ?? ''}}
                                        @elseif($hasil->form_type == 'parameter-number-lessthan')
                                        <{{$hasil->referensi_max ?? ''}}
                                        @endif
                                    </label>
                                    @if($hasil->form_type == 'parameter-number-greatherthan')
                                    <label class="col-lg-3 col-form-label text-center">@if(!empty($hasil->kritis_min))< {{$hasil->kritis_min ?? ''}} @endif</label>
                                    @elseif($hasil->form_type == 'parameter-number-lessthan')
                                    <label class="col-lg-3 col-form-label text-center">@if(!empty($hasil->kritis_max))> {{$hasil->kritis_max ?? ''}} @endif</label>
                                    @else
                                    <label class="col-lg-3 col-form-label text-center">@if(!empty($hasil->kritis_min) || !empty($hasil->kritis_max))< {{$hasil->kritis_min ?? ''}} dan > {{$hasil->kritis_max ?? ''}} @endif</label>
                                    @endif
                                    @elseif($hasil->form_type == 'text')
                                    <div class="col-lg-10">
                                    <input type="text" class="form-control" value="{{$hasil->value}}" name="form_text_{{$detail->slug}}_{{str_replace(' ', '_',$hasil->form_id)}}" placeholder="Hasil">
                                    </div>
                                    @elseif($hasil->form_type == 'paragraph')
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name="form_text_{{$detail->slug}}_{{str_replace(' ', '_',$hasil->form_id)}}" rows="5">{{$hasil->value}}</textarea>
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            @foreach($detail->tarif->labpk_form_tarif as $form_tarif)
                            @foreach($form_tarif->form->detail ?? [] as $form_detail)
                            @php $form = $form_tarif->form @endphp

                                @if(($form_detail->jk_pria && $transaksi->pasien->gender == 1) || ($form_detail->jk_wanita && $transaksi->pasien->gender != 1))
                                @if($form_detail->usia_min <= $usia_px && $form_detail->usia_max >= $usia_px)
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">{{$form->parameter}}</label>
                                    <div class="col-lg-2">
                                        <input type="{{$form->type}}" class="form-control" name="form_{{$detail->slug}}_{{str_replace(' ', '_',$form_detail->id)}}" placeholder="Hasil">
                                    </div>
                                    <label class="col-lg-2 col-form-label text-center">{{$form->satuan}}</label>
                                    <label class="col-lg-3 col-form-label text-center">{{$form_detail->referensi_min ?? 'XXX'}} - {{$form_detail->referensi_max ?? 'XXX'}}</label>
                                    <label class="col-lg-3 col-form-label text-center">< {{$form_detail->kritis_min ?? 'XXX'}} dan > {{$form_detail->kritis_max ?? 'XXX'}}</label>
                                </div>
                                @endif
                                @endif
                            @endforeach
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </div>
    </div>
</div>
@endforeach
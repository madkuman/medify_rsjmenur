@foreach($transaksi->detail as $detail)
<div class="modal fade" id="modalHasil{{$detail->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-slideleft" aria-hidden="true">
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
                        <table class="table table-vcenter">
                            <tbody>
                                @php $count = 0 @endphp
                                @foreach($detail->hasil as $hasil)

                                @if($print_header == 0 && ($hasil->form_type == 'parameter-number' ||  $hasil->form_type == 'parameter-text' || $hasil->form_type == 'parameter-number-greatherthan' || $hasil->form_type == 'parameter-number-lessthan'))
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">#</th>
                                        <th style="width: 15%;">Parameter</th>
                                        <th style="width: 15%;">Hasil</th>
                                        <th style="width: 15%;">Satuan</th>
                                        <th style="width: 20%;">Referensi</th>
                                        <th style="width: 20%;">Nilai Kritis</th>
                                        <th style="width: 10%;">Keterangan</th>
                                    </tr>
                                </thead>
                                @endif
                                @php $print_header = 1 @endphp

                                @if($hasil->keterangan_result == 'kritis')
                                <tr class="table-danger">
                                @elseif($hasil->keterangan_result == 'bahaya')
                                <tr class="table-warning">
                                @else
                                <tr>
                                @endif
                                    <th style="width: 5%" class="text-center">{{++$count}}</th>
                                    <td style="width: 15%">{{$hasil->parameter}}</td>
                                    <td style="white-space: pre">{{$hasil->value}}</td>
                                    <td>{{$hasil->satuan}}</td>
                                    
                                    @if($hasil->form_type == 'parameter-number')
                                    <td>{{$hasil->referensi_min ?? ''}} - {{$hasil->referensi_max}}</td>
                                    <td>@if(!empty($hasil->kritis_min) || !empty($hasil->kritis_max))< {{$hasil->kritis_min ?? ''}} dan > {{$hasil->kritis_max}} @endif</td>
                                    @elseif($hasil->form_type == 'parameter-number-greatherthan')
                                    <td>>{{$hasil->referensi_min ?? ''}}</td>
                                    <td>@if(!empty($hasil->kritis_min))<{{$hasil->kritis_min ?? ''}} @endif</td>
                                    @elseif($hasil->form_type == 'parameter-number-lessthan')
                                    <td><{{$hasil->referensi_max}}</td>
                                    <td>@if(!empty($hasil->kritis_max))>{{$hasil->kritis_max}} @endif</td>
                                    @elseif($hasil->form_type == 'parameter-text')
                                    <td>{{$hasil->referensi_lainnya ?? ''}}</td>
                                    <td></td>
                                    @endif

                                    <td>
                                        @if($hasil->keterangan_result == 'kritis')
                                            <span class="badge badge-danger">Kritis</span>
                                        @elseif($hasil->keterangan_result == 'bahaya')
                                            <span class="badge badge-warning">Abnormal</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
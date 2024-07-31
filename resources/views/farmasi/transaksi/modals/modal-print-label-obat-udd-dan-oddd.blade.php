<div class="modal" id="modal-print-label-obat-udd-oddd" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
       <form id="form-cetak-label-rawat-inap" method="GET" action="{{url('farmasi/'.session('farmasi')->slug.'/label-obat/print-udd-oddd-rawat-inap/'.$transaksi->slug)}}" target="_blank">
            <!-- FORM NYA GK KE PAKAI -->
            <input id="id-label-udd-oddd" type="hidden" name="id" value="{{$transaksi->id}}">
            <input id="farmasi-slug-label-udd-oddd" type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">

            <input id="label-type" type="hidden" name="label_type" value="">
            <input id="items-rows" type="hidden" name="items_rows[]" value="">

            <div class="modal-content">
               <div class="block block-themed block-transparent mb-0">
                   <div class="block-header">
                       <h3 class="block-title">Cetak Label Rawat Inap</h3>
                   </div>
                   <div class="block-content">
                       <div class="row">
                            <div class="col-12">
                                <table width="100%">
                                    <tr>
                                        <td width="3%">Tanggal Resep</td>
                                        <td width="1%">:</td>
                                        <td width="20%">@if(!empty($transaksi->created_at)) {{ indonesian_date($transaksi->created_at) }} @else - @endif</td>
                                    </tr>
                                    <tr>
                                        <td width="3%">Jumlah Cetak</td>
                                        <td width="1%">:</td>
                                        <td width="20%">@if(!empty($transaksi->final_detail->resep_detail)) {{ count($transaksi->final_detail->resep_detail) }} @else - @endif</td>
                                    </tr>
                                </table>
                                <br>
                                <table width="100%" style="border: 1px solid black; border-collapse: collapse; text-align: center">
                                    <thead>
                                        <tr class="border-table">
                                            <th style="border: 1px solid black; border-collapse: collapse;">NO.</th>
                                            <th style="border: 1px solid black; border-collapse: collapse;">BARANG</th>
                                            <th style="border: 1px solid black; border-collapse: collapse;" colspan="10">ATURAN PAKAI</th>
                                        </tr>
                                        <tr class="border-table">
                                            <th style="border: 1px solid black; border-collapse: collapse;"></th>
                                            <th style="border: 1px solid black; border-collapse: collapse;">Resep</th>
                                            <th style="border: 1px solid black; border-collapse: collapse;">1 <br>(07.00)</th>
                                            <th style="border: 1px solid black; border-collapse: collapse;"></th>
                                            <th style="border: 1px solid black; border-collapse: collapse;">2 <br>(13.00)</th>
                                            <th style="border: 1px solid black; border-collapse: collapse;"></th>
                                            <th style="border: 1px solid black; border-collapse: collapse;">3 <br>(19.00)</th>
                                            <th style="border: 1px solid black; border-collapse: collapse;"></th>
                                            <th style="border: 1px solid black; border-collapse: collapse;">4 <br>(24.00)</th>
                                            <th style="border: 1px solid black; border-collapse: collapse;"></th>
                                            <th style="border: 1px solid black; border-collapse: collapse;">5 <br>(22.00)</th>
                                            <th style="border: 1px solid black; border-collapse: collapse;"></th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Pilih Semua</td>
                                            <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">
                                                <div class="form-check">
                                                    <input id="aturan-per-jam-1" class="form-check-input" type="checkbox" value="" hidden>
                                                    <label class="form-check-label" ></label>
                                                </div>
                                            </td>
                                            <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">
                                                <div class="form-check">
                                                    <input id="aturan-per-jam-2" class="form-check-input" type="checkbox" value="" hidden>
                                                    <label class="form-check-label" ></label>
                                                </div>
                                            </td>
                                            <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">
                                                <div class="form-check">
                                                    <input id="aturan-per-jam-3" class="form-check-input" type="checkbox" value="" hidden>
                                                    <label class="form-check-label" ></label>
                                                </div>
                                            </td>
                                            <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">
                                                <div class="form-check">
                                                    <input id="aturan-per-jam-4" class="form-check-input" type="checkbox" value="" hidden>
                                                    <label class="form-check-label" ></label>
                                                </div>
                                            </td>
                                            <td style="border: 1px solid black; border-collapse: collapse;"></td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">
                                                <div class="form-check">
                                                    <input id="aturan-per-jam-5" class="form-check-input" type="checkbox" value="" hidden>
                                                    <label class="form-check-label" ></label>
                                                </div>
                                            </td>
                                        </tr>
                                    </thead>
                                    
                                    <!-- isi table -->
                                    <tbody>
                                        @foreach($transaksi->final_detail->resep_detail as $i => $detail)
                                        <tr class="tr-resep-detail">
                                            <td style="border: 1px solid black; border-collapse: collapse;">{{ $loop->iteration }}</td>
                                            <td  style="border: 1px solid black; border-collapse: collapse; text-align: left">{{ $detail->nama_obat }}</td>
                                            @php
                                                $visible = true;
                                            @endphp
                                            <td style="border: 1px solid black; border-collapse: collapse;">@if(!empty($detail->aturan_per_jam_1)) 07.00 @php $visible = true; @endphp @else @php $visible = false; @endphp @endif</td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">
                                                <div class="form-check" style="@if($visible == false) display: none; @endif">
                                                    {{-- <input class="form-check-input aturan-per-jam-1" data-obat-resep-detail-id="{{ $detail->id }}" type="checkbox" value="07.00" @if($visible == false) disabled @endif> --}}
                                                    @if ($visible)
                                                    <input class="form-check-input aturan-per-jam-1" data-obat-resep-detail-id="{{ $detail->id }}" type="checkbox" value="07.00">
                                                    @endif
                                                    <label class="form-check-label" ></label>
                                                </div>
                                            </td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">@if(!empty($detail->aturan_per_jam_2)) 13.00 @php $visible = true; @endphp @else @php $visible = false; @endphp @endif</td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">
                                                <div class="form-check" style="@if($visible == false) display: none; @endif">
                                                    {{-- <input class="form-check-input aturan-per-jam-2" data-obat-resep-detail-id="{{ $detail->id }}" type="checkbox" value="13.00" @if($visible == false) disabled @endif> --}}
                                                    @if ($visible)
                                                    <input class="form-check-input aturan-per-jam-2" data-obat-resep-detail-id="{{ $detail->id }}" type="checkbox" value="13.00">
                                                    @endif
                                                    <label class="form-check-label" ></label>
                                                </div>
                                            </td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">@if(!empty($detail->aturan_per_jam_3)) 19.00 @php $visible = true; @endphp @else @php $visible = false; @endphp @endif</td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">
                                                <div class="form-check" style="@if($visible == false) display: none; @endif">
                                                    {{-- <input class="form-check-input aturan-per-jam-3" data-obat-resep-detail-id="{{ $detail->id }}" type="checkbox" value="19.00" @if($visible == false) disabled @endif> --}}
                                                    @if ($visible)
                                                    <input class="form-check-input aturan-per-jam-3" data-obat-resep-detail-id="{{ $detail->id }}" type="checkbox" value="19.00">
                                                    @endif
                                                    <label class="form-check-label" ></label>
                                                </div>
                                            </td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">@if(!empty($detail->aturan_per_jam_4)) 24.00 @php $visible = true; @endphp @else @php $visible = false; @endphp @endif</td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">
                                                <div class="form-check" style="@if($visible == false) display: none; @endif">
                                                    {{-- <input class="form-check-input aturan-per-jam-4" data-obat-resep-detail-id="{{ $detail->id }}" type="checkbox" value="24.00" @if($visible == false) disabled @endif> --}}
                                                    @if ($visible)
                                                    <input class="form-check-input aturan-per-jam-4" data-obat-resep-detail-id="{{ $detail->id }}" type="checkbox" value="24.00">
                                                    @endif
                                                    <label class="form-check-label" ></label>
                                                </div>
                                            </td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">@if(!empty($detail->aturan_per_jam_5)) 22.00 @php $visible = true; @endphp @else @php $visible = false; @endphp @endif</td>
                                            <td style="border: 1px solid black; border-collapse: collapse;">
                                                <div class="form-check" style="@if($visible == false) display: none; @endif">
                                                    {{-- <input class="form-check-input aturan-per-jam-5" data-obat-resep-detail-id="{{ $detail->id }}" type="checkbox" value="22.00" @if($visible == false) disabled @endif> --}}
                                                    @if ($visible)
                                                    <input class="form-check-input aturan-per-jam-5" data-obat-resep-detail-id="{{ $detail->id }}" type="checkbox" value="22.00">
                                                    @endif
                                                    <label class="form-check-label" ></label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <!-- end isi table -->
                                </table>
                            </div>
                       </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <span class="btn btn-primary" id="btn-print-oddd">
                       <i class="fa fa-print"></i> Print ODDD
                   </span>
                   <span class="btn btn-primary" id="btn-print-udd">
                       <i class="fa fa-print"></i> Print UDD
                   </span>
               </div>
           </div>
       </form>
   </div>
</div>
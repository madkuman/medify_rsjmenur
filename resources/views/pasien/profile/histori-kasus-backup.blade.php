<div class="card">
    <div class="card-header">
        <h4 class="card-title">Histori Kunjungan</h4>
    </div>
    <div class="card-body">
        <table class="table table-borderless table-hover table-vcenter">
            <thead>
                <tr>
                    <th style="width: 2%;"></th>
                    <th style="width: 38%;">JUDUL KASUS</th>
                    <th style="width: 15%;">TANGGAL MASUK</th>
                    <th style="width: 15%;">TANGGAL KELUAR</th>
                    <th style="width: 15%x;">PEMBAYARAN</th>
                    <th style="width: 15%;">KUNJUNGAN</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hospital as $item)
                <tr class="bd-callout bd-callout-primary" data-toggle="modal" data-id="1" data-target="#kasusModal">
                    <th class="text-center" scope="row"></th>
                    @if(!empty($item->transaksi_masuk_detail[0]))
                    @if(!empty($item->transaksi_masuk_detail[0]->transaksi_lokal_igd->kasus_id) || !empty($item->transaksi_masuk_detail[0]->transaksi_lokal_rawat_jalan->kasus_id))
                        @if($item->transaksi_masuk_detail[0]->modul_id==8)
                            <td>{{$item->transaksi_masuk_detail[0]->transaksi_lokal_igd->kasus->judul_kasus}}</td>
                        @elseif($item->transaksi_masuk_detail[0]->modul_id==2)
                            <td>{{$item->transaksi_masuk_detail[0]->transaksi_lokal_rawat_jalan->kasus->judul_kasus}}</td>
                        @endif
                    @else
                        <td>-</td>
                    @endif
                    @endif
                    <td>{{date('d F y', strtotime($item->created_at))}}</td>
                    <td>-</td>
                    @if(!empty($item->transaksi_masuk_detail[0]))
                    @if(!empty($item->transaksi_masuk_detail[0]->transaksi_lokal_igd->pasien_pembayaran) || !empty($item->transaksi_masuk_detail[0]->transaksi_lokal_rawat_jalan->pasien_pembayaran))
                        @if($item->transaksi_masuk_detail[0]->modul_id==8)
                            <td>{{$item->transaksi_masuk_detail[0]->transaksi_lokal_igd->pasien_pembayaran->perusahaan->tipe->nama}}</td>
                        @elseif($item->transaksi_masuk_detail[0]->modul_id==2)
                            <td>{{$item->transaksi_masuk_detail[0]->transaksi_lokal_rawat_jalan->pasien_pembayaran->perusahaan->tipe->nama}}</td>
                        @endif
                    @else
                        <td>-</td>
                    @endif
                    @endif
                    @if(!empty($item->transaksi_masuk_detail[0]))
                    @if($item->transaksi_masuk_detail[0]->modul_id==8)
                        <td>{{$item->transaksi_masuk_detail[0]->modul->name}} {{$item->transaksi_masuk_detail[0]->transaksi_lokal_igd->ruangan->name}}</td>
                    @elseif($item->transaksi_masuk_detail[0]->modul_id==2)
                        <td>{{$item->transaksi_masuk_detail[0]->transaksi_lokal_rawat_jalan->poliklinik->name}}</td>
                    @endif
                    @endif
                </tr>
                @endforeach
                @if(count($hospital) == 0)
                    <td class="text-center" colspan="7">
                        <h5 class="font-w400">Pasien ini belum memiliki kasus</h5>
                    </td>
                @endif
            </tbody>
        </table>
                

            {{--
            @foreach($kasus as $item)
            <div class="col-lg-4">
                <div class="bd-callout bd-callout-primary">
                    <div class=" mb-20">
                        <a class="link-effect h5" href="{{url('kasus')}}/{{$item->nomor_kasus}}">
                            {{$item->judul_kasus}}
                        </a>
                    </div>
                    <div class="">
                       
                        <i class="fa fa-stethoscope" data-toggle="tooltip" data-placement="left" title="DPJP">
                        </i> 

                        @if(!empty($item->dpjp))
                        {{$item->dpjp_detail->name}}
                        @else
                        -
                        @endif
                    </div>
                    <div class="">
                        <i class="fa fa-medkit" data-toggle="tooltip" data-placement="left" title="Layanan Terakhir"></i> 
                        {{$item->transaksi_global_detail->modul->name}}
                    </div>
                    <div class="">
                        <i class="fa fa-calendar" data-toggle="tooltip" data-placement="left" title="Tanggal Masuk"></i> 
                        {{ $item->created_at->format('d F Y') }}
                    </div>
                    <br> 

                    
                </div>
            </div>
            @endforeach

            @if(count($kasus) == 0)
                <div class="col-12">
                    <h5 class="font-w400">Pasien ini belum memiliki kasus</h5>
                </div>
            @endif
            --}}
    </div>
</div>
{{--
<div class="modal fade" id="kasusModal" tabindex="-1" role="dialog" aria-labelledby="kasusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="modal-title" id="exampleModalLabel">Transaksi #{ID}</h5>
                <hr>
                <h5>BPJS</h5>
                <table class="table table-borderless table-vcenter">
                    <thead>
                        <tr>
                            <th style="width: 2%;"></th>
                            <th style="width: 38%;">JUDUL KASUS</th>
                            <th style="width: 15%;">TANGGAL MASUK</th>
                            <th style="width: 15%;">TANGGAL KELUAR</th>
                            <th style="width: 15%;">PEMBAYARAN</th>
                            <th style="width: 15%;">KUNJUNGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bd-callout bd-callout-primary" data-toggle="modal" data-id="1" data-target="#kasusModal">
                            <th class="text-center" scope="row"></th>
                            <td>Amber Harvey</td>
                            <td>5 September 2018</td>
                            <td>10 September 2018</td>
                            <td>BPJS</td>
                            <td>IGD, Rawat Inap</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
--}}
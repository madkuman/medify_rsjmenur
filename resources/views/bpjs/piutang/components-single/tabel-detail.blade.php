<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">#{{$piutang->id}}</h3>
        <div class="block-options">
            <button type="button" class="btn btn-sm btn-alt-primary" onclick="popupwindow('{{url('')}}/keuangan/piutang/{{$piutang->id}}/print-rekap','Piutang',500,1000) " data-toggle="tooltip" title="Print Rekap Nota">
                <i class="fa fa-file"></i>
            </button>
            <button type="button" class="btn btn-sm btn-alt-primary" onclick="popupwindow('{{url('')}}/keuangan/piutang/{{$piutang->id}}/print','Piutang',500,1000) " data-toggle="tooltip" title="Print Nota">
                <i class="si si-printer"></i>
            </button>
            @if(count($piutang->pemasukan) > 0)
            <button class="btn btn-sm btn-alt-warning disabled" data-toggle="tooltip" title="Transaksi Ini Telah Terbayar. Hapus Histori Pembayaran Terlebih Dahulu">
                <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-alt-danger disabled"  data-toggle="tooltip" title="Transaksi Ini Telah Terbayar. Hapus Histori Pembayaran Terlebih Dahulu">
                <i class="fa fa-trash"></i>
            </button>
            @elseif(!empty($piutang->piutang_parent_id))
            <button class="btn btn-sm btn-alt-warning disabled" data-toggle="tooltip" title="Transaksi Ini Tidak Dapat Di Edit. Kembalikan ke Master Tagihan Terlebih Dahulu">
                <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-alt-danger disabled"  data-toggle="tooltip" title="Transaksi Ini Tidak Dapat Di Hapus. Kembalikan ke Master Tagihan Terlebih Dahulu">
                <i class="fa fa-trash"></i>
            </button>
            <a href="{{url()->current()}}/split-revoke" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Revoke Split. Kembalikan ke Master Tagihan">
                <i class="fa fa-file"></i>
            </a>
            @else
            <a href="{{url()->current()}}/edit" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">
                <i class="fa fa-edit"></i>
            </a>
            <button class="btn btn-sm btn-alt-danger remove" data-pk="{{$piutang->id}}" data-toggle="tooltip" title="Delete Transaksi">
                <i class="fa fa-trash"></i>
            </button>
            @endif
        </div>
    </div>
    <div class="block-content block-content-full">
        <!-- Invoice Info -->
        <div class="row">
            <div class="col-12 text-center">
                <p class="h4" style="margin-bottom:0">{{$piutang->judul}}</p>
            </div>
        </div>
        <hr>
        <div class="row my-20">
            <!-- Company Info -->
            <div class="col-5">
                @if(!empty($piutang->pasien_id))
                <div class="row mb-20">
                    <div class="col-12">
                        <label>Pasien</label>
                        <p class="h4" style="margin-bottom:0">{{$piutang->pasien->name ?? '-'}}</p>
                        {{$piutang->pasien->address ?? '-'}}, <br>
                        {{$piutang->pasien->alamat_kecamatan->nama ?? '-'}}, {{$piutang->pasien->alamat_kota->nama ?? '-'}}<br>
                        {{$piutang->pasien->phone ?? '-'}}<br>
                        @if(!empty($piutang->pasienPembayaran->no_asuransi))
                        <small>No Asuransi</small><br> {{$piutang->pasienPembayaran->no_asuransi}}
                        @endif
                    </div>
                </div>
                @endif
                <div class="row mb-20">
                    <div class="col-12">
                        <label>Penanggung Jawab Pembayaran</label>
                        <p class="h4 mb-5">{{$piutang->pihak_ketiga ?? '-'}}</p>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="row">
                    <div class="col-12">
                        <label>Perusahaan / Cara Pembayaran</label>
                        @if(!empty($piutang->perusahaan))
                        <p class="h4 mb-5">{{$piutang->perusahaan->nama}}</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END Company Info -->
            <div class="col-2 text-right">
                <address>
                    {{date('d F Y', strtotime($piutang->tanggal_transaksi))}}
                </address>
            </div>
        </div>
        <!-- END Invoice Info -->

        <!-- Table -->
        <div class="table-responsive push">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px;"></th>
                        <th>Layanan</th>
                        <th class="text-center" style="width: 90px;">Kelas</th>
                        <th class="text-center" style="width: 90px;">Jumlah</th>
                        <th class="text-right" style="width: 120px;">Harga</th>
                        <th class="text-right" style="width: 90px;">Diskon</th>
                        <th class="text-right" style="width: 120px;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 0 @endphp
                    @foreach($piutang_details as $tanggal => $kategori_item)
                        <tr class="table-warning">
                            <td colspan="7" class="text-center">
                            {{$tanggal}}
                            </td>
                        </tr>
                        @if(!empty($kategori_item['Tindakan']))
                        @php $temp_data['piutang_detail'] = $kategori_item['Tindakan'] @endphp
                        @php $temp_data['kategori'] = 'Tindakan' @endphp
                        @include('keuangan.piutang.components-single.tabel-detail-content',$temp_data)
                        @endif
                        
                        @if(!empty($kategori_item['Farmasi']))
                        @php $temp_data['piutang_detail'] = $kategori_item['Farmasi'] @endphp
                        @php $temp_data['kategori'] = 'Farmasi' @endphp
                        @include('keuangan.piutang.components-single.tabel-detail-content',$temp_data)
                        @endif

                        @if(!empty($kategori_item['Penunjang']))
                        @php $temp_data['piutang_detail'] = $kategori_item['Penunjang'] @endphp
                        @php $temp_data['kategori'] = 'Penunjang' @endphp
                        @include('keuangan.piutang.components-single.tabel-detail-content',$temp_data)
                        @endif

                        @if(!empty($kategori_item['Lain lain']))
                        @php $temp_data['piutang_detail'] = $kategori_item['Lain lain'] @endphp
                        @php $temp_data['kategori'] = 'Lain lain' @endphp
                        @include('keuangan.piutang.components-single.tabel-detail-content',$temp_data)
                        @endif

                    @endforeach
                    @if(count($piutang->sister))
                    <tr>
                        <td colspan="6" class="font-w600 text-right">Subtotal</td>
                        <td class="text-right">Rp {{number_format($piutang->jumlah - $piutang->diskon)}}</td>
                    </tr>
                    @endif

                    @foreach($piutang->kasusTagihanSister as $tagihan)
                    <tr>
                        <td colspan="6" class="text-right">
                            @if($tagihan->perusahaan->tunai)
                            <a href="javascript:void(0)" onclick="popupwindow('{{url('keuangan/piutang')}}/{{$tagihan->id}}','Piutang',500,1000) "> Beban Pasien </a>
                            @else
                            <a href="javascript:void(0)" onclick="popupwindow('{{url('keuangan/piutang')}}/{{$tagihan->id}}','Piutang',500,1000) "> Beban {{$tagihan->perusahaan->nama}} </a>
                            @endif
                        </td>
                        <td class="text-right" id="diskon">
                            Rp {{number_format($tagihan->total)}}
                        </td>
                    </tr>
                    @endforeach
                    <tr class="table-warning">
                        <td colspan="6" class="font-w700 text-uppercase text-right">Total</td>
                        <td class="font-w700 text-right" id="total">Rp {{number_format($piutang->total)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END Table -->
        <!-- Table -->


        {{-- <!-- MENAMPILKAN DAFTAR HISTORI PEMBAYARAN SECARA PEMASUKAN SATUAN --> --}}
        @if($piutang->total_paid > 0)
        <div class="table-responsive push">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center" colspan="8">Histori Pembayaran</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="width: 60px;">ID</th>
                        <th>Judul</th>
                        <th class="text-center" style="width: 150px;">Tanggal Bayar</th>
                        <th class="text-center" style="width: 150px;">Total</th>
                        <th class="text-center" style="width: 90px;">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @php $current_pemasukan_id = 0 @endphp 
                    @foreach($piutang->pemasukan as $pemasukan)
                    @php 
                    $print = 0;
                    if($current_pemasukan_id != $pemasukan->id)
                    {
                        $current_pemasukan = $pemasukan;
                        $current_pemasukan_id = $pemasukan->id;
                        $print = 1;
                    }
                    @endphp

                    @if($print == 1)
                    <tr>
                        <td class="text-center" style="width: 60px;">{{$current_pemasukan->id}}</td>
                        <td>{{$current_pemasukan->judul}}</td>
                        <td class="text-center" style="width: 150px;">{{$current_pemasukan->created_at->format('d F Y')}}</td>
                        <td class="text-center" style="width: 150px;">Rp {{number_format($current_pemasukan->total)}}</</td>
                        <td class="text-center" style="width: 200px;">
                            <a href="{{url('keuangan/pemasukan/')}}/{{$current_pemasukan->id}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Detail"><i class="fa fa-paper-plane"></i></a>
                            <button type="button" class="btn btn-sm btn-secondary" onclick="popupwindow('{{url('keuangan/pemasukan/')}}/{{$current_pemasukan->id}}/print-nota','Piutang',500,1000) " data-toggle="tooltip" title="Print Nota">
                                <i class="fa fa-file"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary" onclick="popupwindow('{{url('keuangan/pemasukan/')}}/{{$current_pemasukan->id}}/print-kwitansi','Piutang',500,1000) " data-toggle="tooltip" title="Print Kwitansi">
                                <i class="fa fa-ticket"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary" onclick="popupwindow('{{url('keuangan/pemasukan/')}}/{{$current_pemasukan->id}}/print-rekap','Piutang',500,1000) " data-toggle="tooltip" title="Rekap Nota">
                                <i class="fa fa-clipboard"></i>
                            </button>
                        </td>
                    </tr>
                    @endif


                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- END Table -->
        @if (($piutang->total - $piutang->total_paid)>0)
        <div class="row">
            <div class="col-md-12" style="float: right;">
                <button class="btn btn-primary btn-fill pull-right" id="submit">Bayar Piutang</button>
                @if(empty($piutang->piutang_parent_id))
                <button type="button" class="btn btn-warning pull-right mr-10" onclick="splitPiutang()" data-toggle="tooltip" title="Split Piutang">
                    <i class="fa fa-copy"></i> Split Piutang
                </button>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

@if(!empty($piutang->keterangan))
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">KETERANGAN</h3>
    </div>
    <div class="block-content block-content-full">
        {!! $piutang->keterangan !!}
    </div>
</div>
@endif
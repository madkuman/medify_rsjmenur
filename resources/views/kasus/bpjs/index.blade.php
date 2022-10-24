@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - SEP BPJS 
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            <!-- Updates -->
            <div class="col-lg-9 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        @include('kasus.tagihan.navbar')
                    </div>
                    @php $array_used = [] @endphp
                    <?php $i = sizeof($bpjs_sep_list); ?>
                    @forelse ($bpjs_sep_list as $item)
                    @php
                        if(in_array($item->id,$array_used)) continue;
                        else $array_used[] = $item->id;
                    @endphp

                    <div class="col-md-12">
                        <div class="block block-bordered {{ $i != sizeof($bpjs_sep_list) ? 'block-mode-hidden' : ''}}">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">No. SEP - {{ $item->no_sep or '-'}} @if($kasus->sep_id == $item->id) (Aktif) @endif</h3>

                                @if(session('my_role_'.$kasus->nomor_kasus))

                                <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Edit Plafon" onclick="editSEPPlafon('{{$item->no_sep}}',{{$item->total_plafon}})">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Edit SEP" onclick="editSEP('{{$item->no_sep}}')">
                                    <i class="si si-pencil"></i>
                                </button>

                                @endif

                                <a class="btn-block-option d-none" href="{{url('bpjs')}}/sep/{{$item->no_sep}}/print" target="_blank" title="print" data-toggle="tooltip" data-placement="top" title="Print">
                                    <i class="fa fa-print"></i>
                                </a>


                                <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Detail" onclick="detailSEP('{{$item->no_sep}}')">
                                    <i class="fa fa-search"></i>
                                </button>

                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                </div>
                            </div>
                            <div class="block-content " id="bpjs-item-{{$i}}">
                                @if($item->sisaPlafon <= 0)
                                <h5 class="text-danger pull-right mb-5 ml-0 p-0">Sisa Plafon : {{number_format($item->sisaPlafon)}}</h5>
                                @else
                                <h5 class="text-success pull-right mb-5 ml-0 p-0">Sisa Plafon : {{number_format($item->sisaPlafon)}}</h5>
                                @endif
                                <h5 class="mb-5 ml-0 p-0"> Total Plafon : Rp {{number_format($item->total_plafon)}} </h5>
                                <h6 class="font-w400">Dibuat Pada : {{$item->created_at_formatted}}</h6>
                                <hr>
                                <h6 class="text-uppercase">Daftar Penggunaan SEP</h6>

                                @php $i = 0 @endphp
                                @php $i = 1 @endphp
                                
                                @if($i)
                                <div class="table-responsive">
                                    <table class="table table-striped table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>Uraian</th>
                                                <th class="text-center" style="width: 20%;">Harga Satuan</th>
                                                <th class="text-center" style="width: 10%;">Jumlah</th>
                                                <th class="text-center" style="width: 20%;">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($item->tagihan_detail as $detail)
                                            <tr>
                                                <td class="font-w400">
                                                    {{$detail->lokasi->nama or '-'}} - {{$detail->creator->name or '-'}}
                                                    <h5 class="mb-5">{{$detail->desc or '-'}}</h5>
                                                    <span class="badge badge-primary mt-5">
                                                         {{date('d F y, H:i', strtotime($detail->updated_at))}}
                                                    </span>
                                                </td>
                                                <td class="h5 font-w400">Rp <span style="float:right">{{number_format($detail->unit_price,0)}}</span></td>
                                                <td class="h5 font-w400 text-center">{{$detail->qty}}</td>
                                                <td class="h5 font-w400">Rp <span style="float:right">{{number_format($detail->subtotal,0)}}</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="text-center py-50">
                                    <h4 class="font-w400 mb-5">Belum ada tagihan tersedia</h4>
                                    <p>SEP ini belum digunakan untuk transaksi apapun</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <?php $i--; ?>
                    @empty
                    <div class="col-12 text-center py-50">
                        <h4 class="font-w400 mb-5">Belum ada SEP</h4>
                        <p>Klik tombol <b>Buat SEP</b> untuk menambahkan tagihan baru</p>
                    </div>
                    @endforelse
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
</main>
<!-- END Main Container -->    

@include('kasus.bpjs.modals.edit')
@endsection

@section('js')
<script type="text/javascript">

    function editSEP(no_sep) {
        console.log(no_sep);
        popupwindow("{{url('')}}/bpjs/sep/"+no_sep+"/edit?window=true", "Ubah Data SEP", 800, 800);
    }
    function buatSEPBaru() {
        popupwindow("{{url('')}}/bpjs/sep/create?window=true", "Terbitkan SEP Baru", 800, 800);
    }
    
    function detailSEP(no_sep) {
        popupwindow("{{url('')}}/bpjs/sep/search?window=true&no_sep="+no_sep, "Detail SEP", 800, 800);
    }

    function editSEPPlafon(no_sep,plafon)
    {
        $('#editSEP').val(no_sep)
        $('#editPlafon').val(plafon)
        $('#modal-edit-item').modal('show')
    }
</script>

@endsection
@extends('farmasi.layouts.main')

@section('title')
Farmasi Detail {{session('farmasi')->jenis_detail->slug == "gudang" ? 'Penerimaan' : 'Pembelian'}}
@endsection

@section('css')
    <style type="text/css">
        .bordered {
            border-bottom: 1px solid #eaecee;
        }
        .modal-content {
            border-radius: 0;
        }
        .modal-full {
            min-width: 100%;
            margin: 0;
        }
        #modal-large {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }
        .modal-full .modal-content {
            min-height: 100vh;
        }
    </style>
@endsection

@section('content')
<div class="block">
    <div class="block-header bordered">
        <h3 class="block-title">{{session('farmasi')->jenis_detail->slug == "gudang" ? 'Penerimaan' : 'Pembelian'}} #{{$pengadaan->slug}}</h3>
        <div class="block-options">
            <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/pengadaan/delete')}}">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$pengadaan->id}}">
            </form>
            <a href="{{url('farmasi/'.session('farmasi')->slug.'/pengadaan/'.$pengadaan->slug.'/print')}}" class="btn btn-alt-warning btn-square" target="_blank">
                <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Print
            </a>
            @if(session('farmasi')->group->my_role->admin ?? 0 == 1)
            <button type="submit" class="btn btn-alt-danger btn-square confirm-del">
                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
            </button>
            <button type="submit" class="btn btn-alt-primary btn-square" id="btnEdit">
                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
            </button>
            @endif
        </div>
    </div>
    <div class="block-content">
        <div class="block block-transparent">
            <div class="row">
                <div class="col">
                    <label>PENYEDIA</label>
                    <h4 class="text-primary">{{$pengadaan->supplier_detail->nama}}</h4>
                    <label>NO FAKTUR</label>
                    <h4>{{$pengadaan->nomor_referensi ? $pengadaan->nomor_referensi : "-"}}</h4>
                    @if (session('farmasi')->jenis_detail->slug == "gudang")
                        <label>NO SURAT JALAN</label>
                        <h4>{{$pengadaan->nomor_surat_jalan ? $pengadaan->nomor_surat_jalan : "-"}}</h4>
                    @endif
                    <label>Sumber Dana</label>
                    <h4>{{$pengadaan->sumber_dana->nama ?? "-"}}</h4>
                </div>
                <div class="col">
                    <label>TANGGAL {{session('farmasi')->jenis_detail->slug == "gudang" ? 'PENERIMAAN' : 'PEMBELIAN'}}</label>
                    <h5>{{ date('d F Y', strtotime($pengadaan->tanggal)) }}</h5>
                    <label>TANGGAL FAKTUR</label>
                    <h5>{{ $pengadaan->tanggal_faktur ? date('d F Y', strtotime($pengadaan->tanggal_faktur)) : "-" }}</h5>
                    @if (session('farmasi')->jenis_detail->slug == "gudang")
                        <label>TANGGAL SURAT JALAN</label>
                        <h5>{{ $pengadaan->tanggal_surat_jalan ? date('d F Y', strtotime($pengadaan->tanggal_surat_jalan)) : "-" }}</h5>
                    @endif
                    @if($pengadaan->bukti_nota)
                        <label>BUKTI NOTA</label>
                        <h5>
                            <a href="{{asset($pengadaan->bukti_nota)}}" class="link-effect" target="_blank">Lihat Bukti Nota</a>
                        </h5>
                    @endif
                    <label>Katalog</label>
                    <h4>{{$pengadaan->katalog->nama ?? "-"}}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>KETERANGAN</label>
                    <p>{{$pengadaan->keterangan ? $pengadaan->keterangan : "-"}}</p>
                </div>
                <div class="col">
                    <label>NILAI {{session('farmasi')->jenis_detail->slug == "gudang" ? 'PENERIMAAN' : 'PEMBELIAN'}}</label>
                    <h5>Rp. {{$pengadaan->total_harga ? number_format($pengadaan->total_harga) : "-"}}</h5>
                </div>
            </div>
        </div>
        
        <table class="table table-vcenter">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Barang</th>
                    <th>Produsen</th>
                    <th>Batch</th>
                    <th>Jumlah</th>
                    <th>Diskon</th>
                    <th>PPN</th>
                    <th>Subtotal</th>
                    <th>Harga Satuan</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($pengadaan->log as $row)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
                    <td>{{$row->produsen->nama}}</td>
                    <td>{{$row->batch}}</td>
                    <td>{{$row->jumlah}} {{$row->detail_item->detail_item->item_detail->satuan}}</td>
                    <td>{{$row->diskon}} %</td>
                    <td>{{$row->ppn}} %</td>
                    <td>Rp. {{number_format($row->subtotal,2)}}</td>
                    <td>Rp. {{number_format($row->harga_saat_itu,2)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-50">
            <label>DI BUAT OLEH</label>
            <h5 class="text-primary">{{$pengadaan->created_by_detail->name}} - {{ date('d F Y, H:i', strtotime($pengadaan->created_at)) }}</h5>
        </div>
    </div>
</div>
@include('farmasi.pengadaan.components.modal-detail-gudang', ['j' => 0, 'po_selected' => null])
@endsection

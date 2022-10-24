@extends('eusulan.layouts.main')

@section('title')
    E-Usulan - Usulan - {{$usulan->nama}}
@endsection


@section('css')

    <style>
        .dataTables_processing {
            background-color: white;
        }
    </style>
@endsection
@section('content')
    <div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">Usulan #{{$usulan->id}}</h3>
            <div class="block-options">
                <form method="POST" action="{{url('e-usulan/'.$usulan->id.'/delete')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$usulan->id}}">
                </form>
                @if($admin == 1)
                    <label class="css-control css-control-sm css-control-primary css-switch mr-10">
                        <input type="checkbox" class="css-control-input" onclick="toggleEditUsulan({{$po->id}})" @if($usulan->allow_edit == 1) checked="checked" @endif>
                        <span class="css-control-indicator"></span>
                        Aktifkan Edit
                    </label>
                @endif

                <button class="btn btn-alt-warning btn-square" type="button" data-toggle="modal" data-target="#modal-print"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Print</button>
                @if($allow_limit_date && Auth::user()->id == $usulan->created_by)
                <button type="submit" class="btn btn-alt-danger btn-square confirm-del">
                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                </button>
                <a href="{{url()->current()}}/edit" class="btn btn-alt-primary btn-square">
                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp; Edit
                </a>
                @elseif($usulan->allow_edit != 1)
                    <div class="tooltip-wrapper" data-title="Dinonaktifkan oleh admin" style="display: inline-block;">
                        <button type="submit" class="btn btn-alt-danger btn-square" style="pointer-events: none" disabled>
                            <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                        </button>
                    </div>
                    <div class="tooltip-wrapper" data-title="Dinonaktifkan oleh admin" style="display: inline-block;">
                        <button type="submit" class="btn btn-alt-primary btn-square" style="pointer-events: none" disabled>
                            <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                        </button>
                    </div>
                    <div class="tooltip-wrapper" data-title="Dinonaktifkan oleh admin" style="display: inline-block;">
                        <button type="submit" class="btn btn-alt-warning btn-square" style="pointer-events: none" disabled>
                            <i class="fa fa-file-import" aria-hidden="true"></i>&nbsp;&nbsp;Import
                        </button>
                    </div>
                @elseif($usulan->allow_edit == 1 && (Auth::user()->id == $usulan->created_by || $admin == 1))
                    <button type="submit" class="btn btn-alt-danger btn-square confirm-del">
                        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                    </button>
                    <a href="{{url()->current()}}/edit" class="btn btn-alt-primary btn-square">
                        <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp; Edit
                    </a>
                    <button class="btn btn-alt-warning btn-square" type="button" data-toggle="modal" data-target="#modal-import"><i class="fa fa-file-import" aria-hidden="true"></i>&nbsp;&nbsp;Import</button>
                @else
                    <div class="tooltip-wrapper" data-title="Hanya bisa diakses kreator" style="display: inline-block;">
                        <button type="submit" class="btn btn-alt-danger btn-square" style="pointer-events: none" disabled>
                            <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                        </button>
                    </div>
                    <div class="tooltip-wrapper" data-title="Hanya bisa diakses kreator" style="display: inline-block;">
                        <button type="submit" class="btn btn-alt-primary btn-square" style="pointer-events: none" disabled>
                            <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                        </button>
                    </div>
                    <div class="tooltip-wrapper" data-title="Hanya bisa diakses kreator" style="display: inline-block;">
                        <button type="submit" class="btn btn-alt-warning btn-square" style="pointer-events: none" disabled>
                            <i class="fa fa-file-import" aria-hidden="true"></i>&nbsp;&nbsp;Import
                        </button>
                    </div>
                @endif
                @if(Auth::user()->id == $usulan->created_by)
                    <button type="button" class="btn btn-alt-success btn-square" data-toggle="modal" data-target="#modal-legalitas-atasan">
                        <i class="fa fa-pencil"></i> Legalitas Atasan
                    </button>
                    <a href="{{url()->current()}}/copy" class="btn btn-alt-warning btn-square">
                        <i class="fa fa-copy" aria-hidden="true"></i>&nbsp;&nbsp; Copy
                    </a>
                @else
                    <div class="tooltip-wrapper" data-title="Hanya bisa diakses kreator" style="display: inline-block;">
                        <button type="submit" class="btn btn-alt-primary btn-square" style="pointer-events: none" disabled>
                            <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Legalitas Atasan
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <div class="row">
                    <div class="col">
                        <label>TAHUN</label>
                        <h4>{{$usulan->tahun}}</h4>
                        <label>NAMA</label>
                        <h4>{{$usulan->nama}}</h4>
                    </div>
                    <div class="col">
                        <label>TANGGAL USULAN</label>
                        <h4>{{ date('d F Y', strtotime($usulan->tanggal_usulan)) }}</h4>
                        <label>UNIT</label>
                        <h4>{{$usulan->unit->nama ?? '-'}}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>DESKRIPSI</label>
                        <p>{{$usulan->deskripsi ?? "-"}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>INDIKATOR</label>
                        <p>{{$usulan->indikator ?? "-"}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>TARGET</label>
                        <p>{{$usulan->target ?? "-"}}</p>
                    </div>
                </div>
                @if(count($file_pendukung) > 0)
                <div class="row">
                    <div class="col">
                        <label>Legalitas Atasan</label>
                    </div>
                </div>
                @endif
                <div class="row col">
                    @foreach($file_pendukung as $item)
                        <div class="col-sm-2 border file">
                            <i class="far fa-file-alt"></i>
                            <a href="javascript:void(0)" onclick="popupwindow('{{url('').'/'.$item->path}}')">{{$item->title.'.'.$item->type}}</a>
                        </div>
                    @endforeach
                </div>

            </div>
            @if(count($usulan->detail_gagal) > 0)
            <div class="block block-transparent">
                <div class="row pull-right mr-10">
                    <button class="btn btn-alt-warning btn-square" type="button" data-toggle="modal" data-target="#modal-data-gagal">&nbsp;&nbsp;Data Gagal Import</button>
                </div>
            </div>
            @endif

            <table class="table table-vcenter">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Akun Rekening</th>
                    <th>Barang</th>
                    <th>Kegiatan</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Link</th>
                    <th>Spesifikasi</th>
                    <th>Justifikasi</th>
                    <th>File Pendukung</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i=0;
                    $total = 0;
                @endphp
                @foreach($usulan->detail as $row)
                    @php $total += ($row->harga * $row->jumlah)  @endphp
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$row->akun_rekening->nama}}</td>
                        <td>{{$row->barang->nama}}</td>
                        <td>{{$row->kegiatan}}</td>
                        <td>{{$row->jumlah}}</td>
                        <td>{{$row->satuan}}</td>
                        <td>
                            @if(!is_null($row->link)) <a href="javascript:void(0)" onclick="popupwindow('{{$row->link}}')" class="text-primary">#Link Produk 1</a><br> @endif
                            @if(!is_null($row->link2)) <a href="javascript:void(0)" onclick="popupwindow('{{$row->link2}}')" class="text-primary">#Link Produk 2</a><br> @endif
                            @if(!is_null($row->link3)) <a href="javascript:void(0)" onclick="popupwindow('{{$row->link3}}')" class="text-primary">#Link Produk 3</a><br> @endif
                        </td>
                        <td>{{$row->spesifikasi}}</td>
                        <td>{{$row->justifikasi}}</td>
                        <td>@if(!is_null($row->dokumen_id)) <a href="javascript:void(0)" onclick="popupwindow('{{url('').'/'.$row->dokumen->path}}')" class="text-primary">#Lihat File {{$i}}</a> @endif</td>
                        <td>Rp. {{number_format($row->harga,2)}}</td>
                        <td>Rp. {{number_format($row->harga * $row->jumlah,2)}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>Total</th>
                    <td>Rp. {{number_format($total,2)}}</td>
                </tr>
                </tbody>
            </table>

            <div class="mt-50">
                <div class="row">
                    <div class="col-md-6">
                        <label>DI BUAT OLEH</label>
                        <h5 class="text-primary">{{$usulan->creator->name}}
                            - {{ date('d F Y, H:i', strtotime($usulan->created_at)) }}</h5>
                    </div>
                    @if(!is_null($usulan->updated_by))
                        <div class="col-md-6 pull-right">
                            <label>DI UBAH OLEH</label>
                            <h5 class="text-primary">{{$usulan->updater->name}}
                                - {{ date('d F Y, H:i', strtotime($usulan->updated_at)) }}</h5>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="modal-print" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="GET" action="{{url('e-usulan/'.$usulan->id.'/print')}}" target="_blank">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Print Usulan </h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Jabatan 1</label>
                                        <label class="css-control css-control-primary css-checkbox pull-right">
                                            <input type="checkbox" class="css-control-input" name="jabatan_1_toogle" checked>
                                            Kiri <span class="css-control-indicator"></span>
                                        </label>
                                        <select class="js-select2 form-control" name="jabatan_1" style="width: 100%;">
                                            @foreach($jabatan as $row)
                                                <option value="{{$row->nama}}">{{$row->nama}}</option>
                                            @endforeach
                                        </select>
                                        <hr>
                                        <select class="js-select2 form-control" name="jabatan_1_nama" style="width: 100%;">
                                        @foreach($user as $row)
                                                <option value="{{$row->name}}">{{$row->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Jabatan 2</label>
                                        <label class="css-control css-control-primary css-checkbox pull-right">
                                            <input type="checkbox" class="css-control-input" name="jabatan_2_toogle" checked>
                                            Tengah <span class="css-control-indicator"></span>
                                        </label>
                                        <select class="js-select2 form-control" name="jabatan_2" style="width: 100%;">
                                            @foreach($jabatan as $row)
                                                <option value="{{$row->nama}}">{{$row->nama}}</option>
                                            @endforeach
                                        </select>
                                        <hr>
                                        <select class="js-select2 form-control" name="jabatan_2_nama" style="width: 100%;">
                                            @foreach($user as $row)
                                                <option value="{{$row->name}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Jabatan 3</label>
                                        <label class="css-control css-control-primary css-checkbox pull-right">
                                            <input type="checkbox" class="css-control-input" name="jabatan_3_toogle" checked>
                                            Kanan <span class="css-control-indicator"></span>
                                        </label>
                                        <select class="js-select2 form-control" name="jabatan_3" style="width: 100%;">
                                            @foreach($jabatan as $row)
                                                <option value="{{$row->nama}}">{{$row->nama}}</option>
                                            @endforeach
                                        </select>
                                        <hr>
                                        <select class="js-select2 form-control" name="jabatan_3_nama" style="width: 100%;">
                                            @foreach($user as $row)
                                                <option value="{{$row->name}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-alt-primary" id="btn-submit-print">
                            <i class="fa fa-check"></i> Cetak
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('eusulan.usulan.components.modal-legalitas-atasan')
    @include('eusulan.usulan.components.modal-import')
    @include('eusulan.usulan.components.modal-data-gagal')
    <form method="POST" action="{{url()->current()}}/toggle-edit" id="formToggleEdit">
        {{csrf_field()}}
        <input type="hidden" id="id_usulan" name="id">
    </form>
@endsection

@section('js')
    @include('eusulan.usulan.components.js-detail')
@endsection
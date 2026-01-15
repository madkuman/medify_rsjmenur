<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if($allow_crud)
                <button type="button" class="btn-alt btn-rounded btn-primary min-width-125 float-right btn-toggle-histori-resep" data-toggle="modal" data-target="#modal-create-resep" data-kategori_resep="default"><i class="fa fa-pencil"></i> Buat Resep</button>
                <button type="button" onclick="historiResep()" class="btn-alt btn-warning  min-width-125 float-right" ><i class="fa fa-loop"></i> Histori Resep</button>
                @if (config('app.fitur_kasus_resep_kategori'))
                    <button type="button" class="btn-alt btn-rounded btn-primary min-width-125 float-right btn-toggle-histori-resep" data-toggle="modal" data-target="#modal-create-resep" data-kategori_resep="tpn"><i class="fa fa-pencil"></i> Buat Resep TPN</button>
                    <button type="button" class="btn-alt btn-rounded btn-primary min-width-125 float-right btn-toggle-histori-resep" data-toggle="modal" data-target="#modal-create-resep" data-kategori_resep="dispensing_aseptik"><i class="fa fa-pencil"></i> Buat Resep Dispensing Aseptik</button>
                @endif
            @endif
        </div>
    </div>
    <div class="row row-deck">
        @forelse ($resep as $r)
        <div class="col-md-6">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">
                    <h4 class="block-title font-w600">
                        Resep 
                        @if(!empty($r->transaksi_farmasi)) 
                            @if($r->transaksi_farmasi->cito == 1) 
                                <small>(Cito)</small>
                            @endif
                            @if($r->transaksi_farmasi->eksekutif == 1)
                                <small>(Eksekutif)</small>
                            @endif
                        @endif
                    </h4>

                    @if($allow_crud)
                    @if($my_role_admin == 1 || $r->created_by == Auth::user()->id)
                    @if($r->transaksi_farmasi == null || ($r->transaksi_farmasi->status == 0 && empty($r->transaksi_farmasi->dikerjakan_at) && count($r->transaksi_farmasi->copy_resep) == 0 ))
                    <button type="button" class="btn-block-option " data-toggle="tooltip" data-placement="top" title="Hapus" onclick="resepDelete({{$r->id}}
                        @if(!empty($r->transaksi_farmasi->farmasi_id))
                        ,{{$r->transaksi_farmasi->farmasi_id}}
                        @endif
                        )">
                        <i class="si si-trash"></i>
                    </button>
                    
                    @if (config('app.fitur_kasus_resep_kategori'))
                        <button type="button" class="btn-block-option" data-tooltip="tooltip" data-placement="top" title="Edit" data-toggle="modal" data-target="#resepModalEdit" data-kategori_resep="{{ $r->kategori_resep ?? 'default' }}" data-id="{{ $r->id }}">
                            <i class="si si-pencil"></i>
                        </button>
                    @else
                        <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Edit" onclick="resepEdit({{$r->id}})">
                            <i class="si si-pencil"></i>
                        </button>
                    @endif
                    @else
                    <span class="badge badge-success">Sudah dilayani</span>
                    @endif

                    <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Copy-Resep" onclick="resepCopy({{$r->id}})">
                        <i class="fa fa-copy"></i>
                    </button>

                    @endif
                    @endif

                    <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Print" onclick="resepPrint({{$r->id}})">
                        <i class="si si-printer"></i>
                    </button>


                </div>

                <div class="block-content">


                    @if($r->jenis_resep == 'pulang')
                    <span class="badge badge-info">Resep Pulang</span>
                    @endif
                    @if($r->kategori_resep == 'dispensing_aseptik')
                        <span class="badge badge-primary">Dispensing Aseptik</span>
                    @elseif($r->kategori_resep == 'tpn')
                        <span class="badge badge-primary">TPN</span>
                    @endif
                        
                    @if(!empty($r->transaksi_id))
                    <h6 class="pt-10">
                        <span class="font-w400">@if(!empty($r->transaksi_farmasi->ori_detail->nomor_resep))
                            {{$r->transaksi_farmasi->ori_detail->nomor_resep}} -
                            @endif
                            @if(!empty($r->transaksi_farmasi->owner_detail->nama)) 
                            {{ $r->transaksi_farmasi->owner_detail->nama }} 
                            @else
                            -
                        @endif</span>
                    </h6>
                    @if (!empty($r->resep_iter))
                        Iter Resep: {{ $r->resep_iter }}
                    @endif
                    @endif
                    <hr>
                    
                    @foreach ( $r->resepDetail as $resepDetail )
                    <span class="text-muted font-w400"> {{ $resepDetail->type }} </span>
                    @if($resepDetail->kategori == 'racikan')
                    <h6 class="font-w600 mb-0" style="overflow:hidden; display:block;">{{ $resepDetail->racikan }} </h6>
                        @foreach($resepDetail->racikan_detail as $racikan)
                        <span>{{$racikan->nama_obat ?? '-'}}<br></span>
                        @endforeach
                    <br>
                    @else
                    <h6 class="font-w600 mb-5 mt-5"> {{ $resepDetail->obat_name }} </h6>
                    @endif
                    <span>Jumlah : {{ $resepDetail->jumlah }}</span><br>
                    <span style="overflow:hidden; display:block;">Aturan : {{ $resepDetail->aturan }}</span>
                    <hr>

                    @endforeach

                    <h6 class="pt-10">
                        <small class="text-muted">Dibuat Oleh</small><br>
                        <span class="float-right"> {{ $r->tanggal }} </span>
                        {{ $r->doctor['name'] }}
                    </h6>
                    @if(!empty($r->updated_by))
                    <h6 class="pt-10">
                        <small class="text-muted">Diupdate Oleh</small><br>
                        <span class="float-right"> {{ $r->tanggal_update }} </span>
                        {{ $r->doctor2['name'] }}
                    </h6>
                    @endif
                </div>
            </div>
        </div>
        @empty
    </div>
    <div class="row">
        <div class="col-12 text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada resep</h4><br>
            <p>Klik tombol <b>Buat Resep</b> untuk menambahkan resep baru</p>
        </div>
    </div>
    <div>
        @endforelse
    </div>
</div>

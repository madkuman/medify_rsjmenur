<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if(session('my_role_'.$kasus->nomor_kasus))
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-smear"><i class="fa fa-pencil"></i>Pemeriksaan PAP SMEAR</button>
            @endif
        </div>

        <?php $i = 1; ?>
        @forelse ($smear as $item)

        <div class="col-md-12">
            <div class="block block-transparent">
                <div class="block-content p-0">
                    <div class="row"> 
                        <div class="col-md-10">
                            @if(session('my_role_'.$kasus->nomor_kasus))
                            @if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == $lis_user || $item->created_by == Auth::user()->id || is_null($item->created_by))
                            <button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right" onclick="smearEditModal({{$item->id}})">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" onclick="smearDeleteModal({{$item->id}})">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                            @endif
                            
                            <h5 class="font-w600 text-muted mb-5 text-uppercase">PAP SMEAR {{$loop->remaining+1}}</h5>
                        </div>
                        <div class="col-md-5"> 
                            <h4>PAP SMEAR</h4>
                            <h5 class=" mb-0"><small class="font-w400">PAP SMEAR</small></h5>
                            <h5 class="mb-15"><span class="font-w400" style="white-space: pre;">{{$item->pap_smear or '-'}}</span></h5>
                        </div>
                        <div class="col-md-10">
                            <h6>
                                <small class="text-muted">Dibuat Oleh</small><br>
                                {{ $item->creator->name ?? "-"}}
                                <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{ $item->created_at_formatted }}</span>
                            </h6>
                        </div>
                        @if(!empty($item->updated_by))
                        <div class="col-md-10">
                            <h6>
                                <small class="text-muted">Diupdate Oleh</small><br>
                                {{ $item->updater->name ?? "-"}}
                                <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{ $item->updated_at_formatted }}</span>
                            </h6>
                        </div>
                        @endif
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <?php $i++; ?>
        @empty

        <div class="col-12 text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada catatan pemeriksaan PAP SMEAR</h4>
            <p>Klik tombol <b>Pemeriksaan PAP SMEAR</b> untuk menambahkan catatan baru</p>
        </div>

        @endforelse


    </div>
</div>
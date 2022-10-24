
<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if($allow_crud)
            <button data-keyboard="false" type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-tindakan-icd9"><i class="fa fa-pencil"></i> Buat Tindakan ICD 9</button>
            <button type="button" onclick="historiTindakan9()" class="btn-alt btn-warning  min-width-125 float-right" ><i class="fa fa-loop"></i> Histori Tindakan</button>
            @endif
        </div>

        <?php $i = 1; ?>
        @forelse ($tindakan_icd9 as $t)

        <div class="col-md-12">
            <div class="block block-transparent">
                <div class="block-content p-0">
                    <div class="row"> 
                        <div class="col-md-8"> 

                            @if($allow_crud)

                                @if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $t->created_by == Auth::user()->id)
                                <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" onclick="tindakanDeleteModal({{$t->id}})" data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                                @endif
                            @endif
                            <h6 class="font-w400 text-muted mb-5">
                                Tindakan ICD9
                                @if(!empty($t->icd9))
                                    @if($t->icd9->bpjs_support == 0)
                                        <span class="badge badge-danger">Tidak di Support BPJS</span>
                                    @endif
                                @endif
                            </h6>
                            <h5 class=" mb-0"><span class="font-w400">{{ $t->desc}}</span></h5>
                            <h5 class="mb-15"><small class="font-w400">Biaya : Rp {{ number_format($t->price,0) }}</small></h5>
                            <div class="row">
                                <h6 class="col-6">
                                    <small class="text-muted">Dibuat Oleh</small><br>
                                    {{ $t->creator->name }} <br>
                                    <span class="font-w400">{{ $t->tanggal }}</span>
                                </h6>
                                @if(!empty($t->subscribed_by))
                                <h6 class="col-6">
                                    <small class="text-muted">Dijadwalkan Rutin Oleh </small><br>
                                    {{ $t->subscriber->name }}
                                </h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <?php $i++; ?>
        @empty

        <div class="col-12 text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada tindakan ICD 9</h4>
            <p>Klik tombol <b>Buat Tindakan ICD 9</b> untuk menambahkan tagihan baru</p>
        </div>

        @endforelse


    </div>
</div>
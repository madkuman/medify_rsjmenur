<div class="block-content tab-content overflow-hidden px-50 pb-30">
    <div class="row">
        <div class="col-lg-12">

            @if(session('my_role_'.$kasus->nomor_kasus))
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-rencana-asuhan"><i class="fa fa-pencil"></i> Buat Rencana Asuhan</button>
            @endif
        </div>
    </div>
    @forelse ($kasus_asuhan as $item)

    @php $slug_specialty_creator = $item->creator->specialty_detail->slug ?? '-' @endphp
    @php $slug_specialty_user = Auth::user()->specialty_detail->slug ?? '-' @endphp

    @if(!empty($item->asuhan->diagnosa))
    <div class="row">
        <div class="col-md-8">

            <button type="button" class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-single-rencana-asuhan-{{$item->id}}">
                <i class="fa fa-search-plus"></i>
            </button>
            @if(session('my_role_'.$kasus->nomor_kasus) && $item->created_by == Auth::user()->id)
            <button type="button" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-edit-rencana-asuhan-{{$item->id}}">
                <i class="fa fa-pencil"></i>
            </button>
            <button href="{{url('kasus')}}/{{ $kasus->nomor_kasus }}/keperawatan/delete/{{$item->id}}" id="hapus" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right hapus">
                <i class="fa fa-trash"></i>
            </button>
            @endif
            @php $need_verifikasi_dokter = 0 @endphp

            @if($slug_specialty_creator == 'perawat-vokasi')
                @if(!empty($item->verified_ners_at) && empty($item->verified_dokter_at) && $my_role_admin == 1)
                    @php $need_verifikasi_dokter = 1 @endphp
                @endif
            @else
                @if(empty($item->verified_dokter_at) && $my_role_admin == 1)
                    @php $need_verifikasi_dokter = 1 @endphp
                @endif
            @endif

            @if($need_verifikasi_dokter)
            <a href="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/keperawatan/rencana-asuhan/verifikasi-dokter/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 float-right" data-toggle="tooltip" data-placement="top" title="Verifikasi Dokter">
                <i class="fa fa-check"></i>
            </a>
            @endif

            @if(empty($item->verified_ners_at) && $slug_specialty_creator == 'perawat-vokasi' && $slug_specialty_user == 'perawat-ners')
            <a href="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/keperawatan/rencana-asuhan/verifikasi-ners/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 float-right" data-toggle="tooltip" data-placement="top" title="Verifikasi NERS">
                <i class="fa fa-check"></i>
            </a>
            @endif
            
            <h6 class="font-w400 text-muted mb-5 text-uppercase">Rencana Asuhan Keperawatan Medikal {{$item->jenis_id_detail->nama}}</h6>
            <h5 class="mb-15 font-w400">{{$item->prefix_diagnosa}} {{$item->asuhan->diagnosa}}</h5>
            <h6>
                <small class="text-muted">Dibuat Oleh</small><br>
                {{$item->created_by_detail->name ?? '-'}}
                <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{indonesian_date($item->created_at,'d F Y H:i')}}</span>
            </h6>
            @if(!empty($item->verified_dokter_at))
            <h6>
                <small class="text-muted">Diverifikasi Oleh</small><br>
                {{$item->verifikator_dokter->name ?? '-'}}
                <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{indonesian_date($item->verified_dokter_at,'d F Y H:i')}}</span>
            </h6>
            @endif
            @if(!empty($item->verified_ners_at))
            <h6>
                <small class="text-muted">Diverifikasi Oleh</small><br>
                {{$item->verifikator_ners->name ?? '-'}}
                <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{indonesian_date($item->verified_ners_at,'d F Y H:i')}}</span>
            </h6>
            @endif
            <hr>
        </div>
    </div>
    @endif
    @empty

    <div class="text-center py-50">
        <h4 class="font-w400 mb-5">Belum ada rencana asuhan keperawatan tersedia</h4>
        <p>Klik tombol <b>Buat Rencana Asuhan</b> untuk menambahkan rencana asuhan keperawatan</p>
    </div>

    @endforelse                                
</div>
@foreach($asesmen_non_jiwa as $item)
    @if($item->creator->profesi == '1')
        @if($item->created_by == Auth::user()->id)
            <button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteAsesmenNonJiwaBtn" data-id="{{$item->id}}">
                <i class="fa fa-trash"></i>
            </button>
            <button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right editAsesmenNonJiwaBtn" data-id="{{$item->id}}" data-item="{{json_encode($item)}}" id="edit-button-{{$item->id}}">
                <i class="fa fa-pencil"></i>
            </button>
            <button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right" id="edit-loading-{{$item->id}}" style="display: none;">
                <i class="fa fa-spinner fa-spin"></i>
            </button>
        @endif
        <button  class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" data-toggle="modal" data-target="#modal-hasil-{{$item->id}}">
            <i class="fa fa-search"></i>
        </button>
        <a href="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/asesmen/asesmen-awal-dokter-non-jiwa/print/{{$item->id}}/{{$item->type}}" target="_blank" type="btn" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right">
            <i class="fa fa-print"></i>
        </a>
        @php $need_verifikasi_dokter = 0 @endphp
        @php $slug_specialty_creator = $item->creator->specialty_detail->slug ?? '-' @endphp
        @php $slug_specialty_user = Auth::user()->specialty_detail->slug ?? '-' @endphp
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
            <a href="{{url()->current()}}/verifikasi-dokter/{{$item->id}}"  class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" data-toggle="tooltip" data-placement="top" title="Verifikasi">
                <i class="fa fa-check"></i>
            </a>
        @endif
        @if($slug_specialty_creator == 'perawat-vokasi' && empty($item->verified_ners_at) && $slug_specialty_user == 'perawat-ners')
            <a href="{{url()->current()}}/verifikasi-ners/{{$item->id}}"  class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" data-toggle="tooltip" data-placement="top" title="Verifikasi">
                <i class="fa fa-check"></i>
            </a>
        @endif
        @include('kasus.datamedis.content.asesmenawal.non-jiwa.modal-hasil')
        <h5 class="mb-0">
            #Asesmen Awal 
            @if(str_contains($item->type, 'gawat'))
            Gawat Darurat - Non Jiwa
            @elseif(str_contains($item->type, 'jalan'))
            Rawat Jalan - Non Jiwa
            @elseif(str_contains($item->type, 'inap'))
            Rawat Inap - Non Jiwa
            @else
            Lain lain
            @endif
        </h5>
        <h6>({{indonesian_date(date('d F y, H:i', strtotime($item->created_at)),'d F y, H:i')}})</h6>
        <div class="row" id="fungsional-{{$item->id}}">
            <!-- //disini ngeshow data-->
        </div>
        <div class="row">
            <div class="col-4">
                <div class="creator">
                    <h6 class="pt-10">
                        <small class="text-muted">Dibuat Oleh</small><br>
                        {{$item->creator->name}}
                    </h6>
                </div>
            </div>
            @if(!empty($item->verified_dokter_by))
            <div class="col-4">
                <div class="creator">
                    <h6 class="pt-10">
                        <small class="text-muted">Verifikasi Dokter Oleh</small><br>
                        {{$item->verifikator_dokter->name ?? '-'}}<br>
                        {{indonesian_date(date('d F y, H:i', strtotime($item->created_at)))}}
                    </h6>
                </div>
            </div>
            @endif
            @if(!empty($item->verified_ners_by))
            <div class="col-4">
                <div class="creator">
                    <h6 class="pt-10">
                        <small class="text-muted">Verifikasi NERS Oleh</small><br>
                        {{$item->verifikator_ners->name ??'-'}}<br>
                        {{indonesian_date(date('d F y, H:i', strtotime($item->created_at)))}}
                    </h6>
                </div>
            </div>
            @endif
        </div>
        <hr class="my-20">
        @php $count2++; @endphp
    @endif
@endforeach

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/asesmen/asesmen-awal-dokter-non-jiwa/delete" id="formDeleteAsesmenNonJiwa">
  {{csrf_field()}}
  <input name="id" type="hidden" id="deleteAsesmenNonJiwaId">
</form>
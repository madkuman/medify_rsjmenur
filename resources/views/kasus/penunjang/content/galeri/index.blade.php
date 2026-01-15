<div class="row">
    <div class="col-lg-12 mb-10">
        @if(session('my_role_'.$kasus->nomor_kasus))
        <button type="button" class="btn btn-primary min-width-125 pull-right ml-10" data-toggle="modal" data-target="#uploadPenunjang"><i class="fa fa-pencil"></i> Tambah Penunjang</button>
        @endif
        <button onclick="historiGaleriPermintaan()" class="btn btn-warning min-width-125 float-right ml-10">Histori Galeri Penunjang</button>
        <button type="button" class="btn btn-info min-width-125 float-right ml-10 " data-toggle="modal" data-target="#modalLihatHistoriLab">Lihat Histori Lab</button>
    </div>
</div>
<div class="row" style="padding-top: 5%; padding-bottom: 5%">
    @forelse($penunjang as $item)
    <div class="col-xl-4" style="padding-bottom: 5%">
        <div class="options-container">
            <img class="img-fluid options-item" style="max-width: 100%; max-height: 100%; cursor: pointer;" src="{{asset($item->file_thumb)}}">
            <div class="options-overlay bg-black-op-75">
                <a class="btn btn-sm btn-rounded btn-secondary selector full-only btn-delete-galeri-item" data-id="{{$item->id}}" data-title="{{$item->judul}}" style="position: absolute;bottom: 5px; right: 5px">
                    <i class="fa fa-trash"></i>
                </a>
                <div class="options-overlay-content">
                    <h3 class="h4 text-white mb-10 text-uppercase">{{$item->judul}}</h3>
                    @if($item->file_type!='link')
                        <a class="btn btn-sm btn-rounded btn-alt-info selector full-only" href="{{url()->current().'/galeri/detail-img/'.$item->id}}">
                            <i class="fa fa-pencil"></i> View
                        </a>
                        @if($item->file_type == "image")
                            <a class="btn btn-sm btn-rounded btn-alt-success selector full-only" href="{{asset($item->file_primary)}}" download="">
                                <i class="fa fa-cloud-download"></i> Download
                            </a>
                        @endif
                        <a class="text-white mobile-block" href="{{asset($item->file_primary)}}" target="_blank">
                            <i class="fa fa-pencil"></i> Lihat
                        </a>
                    @else
                        <a class="btn btn-sm btn-rounded btn-alt-info selector full-only" href="{{$item->file}}" target="_blank">
                            <i class="fa fa-pencil"></i> View
                        </a>
                        <a class="text-white mobile-block" href="{{$item->file}}" target="_blank">
                            <i class="fa fa-pencil"></i> Lihat
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @empty
</div>
<div class="col-12 text-center py-50">
    <h4 class="font-w400 mb-5">Belum ada hasil penunjang tersedia</h4><br>
    <p>Klik tombol <b> Tambah Penunjang</b> untuk menambahkan penunjang baru</p>
</div>
<div>
    @endforelse

</div>

<form id="formDelete" method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/penunjang/delete">
    <input type="hidden" name="id" id="inputIDDelete">
    {{csrf_field()}}
</form>
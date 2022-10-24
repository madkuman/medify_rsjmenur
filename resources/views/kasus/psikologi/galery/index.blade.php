<div class="row">
    <div class="col-lg-12 mb-10">
        @if(session('my_role_'.$kasus->nomor_kasus))
            <button type="button" class="btn btn-primary min-width-125 pull-right ml-10" data-toggle="modal" data-target="#modal-add-galeri"><i class="fa fa-pencil"></i> Tambah Galeri</button>
        @endif
    </div>
</div>
<div class="row" style="padding-top: 5%; padding-bottom: 5%">
    @forelse($galeri as $item)
        <div class="col-xl-4" style="padding-bottom: 5%">
            <div class="options-container">
                <img class="img-fluid options-item" style="max-width: 100%; max-height: 100%; cursor: pointer;" src="@if($item->file_thumb) {{asset($item->file_thumb)}} @else{{asset('assets/img/pdf.png')}} @endif">
                <div class="options-overlay bg-black-op-75">
                    @if(session('my_role_'.$kasus->nomor_kasus))
                    <a class="btn btn-sm btn-rounded btn-secondary selector full-only btn-delete-galeri-item" data-id="{{$item->id}}" data-title="{{$item->judul}}" style="position: absolute;bottom: 5px; right: 5px">
                        <i class="fa fa-trash"></i>
                    </a>
                    @endif

                    <div class="options-overlay-content">
                        <h3 class="h4 text-white mb-10 text-uppercase">{{$item->judul}}</h3>
                            <a class="btn btn-sm btn-rounded btn-alt-info selector full-only" onclick="popupwindow('{{asset($item->file)}}')">
                                <i class="fa fa-pencil"></i> View
                            </a>
                            <a class="btn btn-sm btn-rounded btn-alt-success selector full-only" href="{{asset($item->file)}}" download="">
                                <i class="fa fa-cloud-download"></i> Download
                            </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
</div>
<div class="col-12 text-center py-50">
    <h4 class="font-w400 mb-5">Belum ada galeri psikologi</h4><br>
    <p>Klik tombol <b> Tambah Galeri</b> untuk menambahkan galeri baru</p>
</div>
<div>
    @endforelse

</div>

<form id="formDeleteGaleriItem" method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/psikologi/galeri/delete">
    <input class="input-id" type="hidden" name="id" id="inputIDDelete">
    {{csrf_field()}}
</form>
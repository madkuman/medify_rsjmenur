@extends('layouts.main2')

@section('title')
Pengaturan Grup {{$group->name}}
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    <!-- Group Banner -->
    @include('group.component.banner')
    <!-- End of Group Banner -->
    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Sidebar -->
                @include('group.component.sidebar-left')
                <!-- End of Sidebar -->
            </div>
            <div class="col-md-9">
                <div class="block block-rounded block-transparent">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="block block-content block-link-shadow col-md-12">    
                            <div class="row">
                                {{csrf_field()}}
                                <h4 class="text-uppercase col-md-12"><small class="font-black text-primary-darker">Pengaturan Grup</small></h4>
                                <hr>
                                <div class="block block-content block-link-shadow col-md-4">
                                    <label>Foto Grup</label>
                                    <div class="avatar-upload my-10">
                                        <div class="avatar-edit">
                                            <input type='file' id="avatar" name="avatar" accept=".png, .jpg, .jpeg" />
                                            <label for="avatar"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            @if(!empty($group->photo_ori))
                                            <div id="imagePreview" style="background-image: url({{asset($group->photo_ori)}});">
                                            </div>
                                            @else
                                            <div id="imagePreview" style="background-image: url({{asset('assets/img/poli/001-brain.png')}});">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-content block-link-shadow col-md-8">
                                    <label>Banner Grup</label>
                                    @if(!empty($group->banner))
                                    <div class="banner-preview mt-30" style="background-image: url('{{asset($group->banner)}}')">
                                    @else
                                    <div class="banner-preview mt-30" style="background-image: url('{{asset('assets/img/photos/photo3@2x.jpg')}}')">
                                    @endif
                                        <div class="bg-primary-dark-op">
                                            <div id="bannerShow" class="content content-full" style="min-height: 120px;"></div>
                                        </div>
                                        <div class="banner-edit">
                                            <input type='file' id="banner" name="banner" accept=".png, .jpg, .jpeg" />
                                            <label for="banner"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block-content block-link-shadow col-md-12">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="text" class="form-control" id="edit-name" name="name" value="{{$group->name}}">
                                                <label for="edit-name">Nama</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <textarea class="form-control" id="edit-desc" name="description" rows="3">@if(!empty($group->description)){{$group->description}}@endif</textarea>
                                                <label for="edit-desc">Deskripsi</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$group->id}}">
                                <button type="submit" id="btn_submit" class="btn btn-block btn-primary">Simpan</button>
                            </div>
                        </div>
                        <div class="block block-content block-link-shadow col-md-12">
                            <button type="button" id="btn_delete" class="btn btn-block btn-danger" onclick="hapusGrup({{$group->id}})">Hapus Grup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@include('group.modals.undang-anggota')

@endsection

@section('js')
<script src="assets/js/pages/be_pages_dashboard.js"></script>
<script type="text/javascript">
    function readURLAvatar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLBanner(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.banner-preview').css('background-image', 'url('+e.target.result +')');
                $('.banner-preview').hide();
                $('.banner-preview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#avatar").change(function() {
        readURLAvatar(this);
    });
    $("#banner").change(function() {
        readURLBanner(this);
    });
    function hapusGrup(id)
    {
        swal({
            title: 'Apakah anda yakin untuk menghapus Grup?',
            text: "Anda tidak dapat mengembalikan grup ini lagi",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Grup!',
            confirmButtonClass: 'btn btn-primary ml-10',
            cancelButtonClass: 'btn btn-outline-danger ',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                //window.open("{{url()->current()}}/rawatinap/pindah","Ruangan Baru Pasien", "height=200,width=200,modal=yes,alwaysRaised=yes");
                window.location = "{{url()->current()}}/delete-group/"+id;
            }
        })
    }
</script>
@endsection

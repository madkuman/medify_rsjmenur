@extends("kasus.layouts.main")

@section("title")
{{$form->nama_show}} - Form - {{$kasus->judul_kasus}} - Kasus
@endsection

@section("content")

<main id="main-container">
    @include("kasus.layouts.header")
    <div class="content" style="max-width: 1100px;">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/{{$form->slug}}" class="btn btn-secondary mb-5">Kembali ke Daftar Asesmen</a>
                <div class="block block-bordered">
                    <div class="block-content">
                        <form id="form-post" method="POST" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/{{$form->slug}}/submit-form">
                            {{csrf_field()}}
                            <h4 class="mb-0">{{$form->nama_show}}</h4>
                            <hr>
                            <div class="medify-form-container">
                                @if($action == 'edit')
                                <input type="hidden" value="{{$hasil->id ?? 0}}" name="id">
                                @endif
                                @includeIf('kasus.asesmen.'.$form->slug.'.form-template')
                            </div>
							<br>
                            @if($action == 'edit')
                            <a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/{{$form->slug}}" class="btn btn-secondary">Kembali</a>
                            @endif
                            <button id="btn-submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- END Main Container -->
@endsection
@includeIf('kasus.asesmen.'.$form->slug.'.form-js')

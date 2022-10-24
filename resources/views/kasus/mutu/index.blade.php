@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Asesmen - Kasus
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')
            
           
            <!-- Updates -->
            <div class="col-lg-9 col-xl-9">
                <div class="" id="alat-list">
                    <ul class="list row row-deck">
                        @php $url = url('kasus').'/'.$kasus->nomor_kasus.'/alat-bantu' @endphp
                        <li class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{$url}}/norton">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title">Norton Dekubitus</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-calculator fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5 title">Norton Dekubitus</h5>
                                    <p class="desc">Alat bantu hitung untuk menghitung nilai potensi dekubitus.</p>
                                </div>
                            </a>
                        </li>

                        
                        <li class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{$url}}/identifikasi-pasien">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title">Identifikasi Pasien</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-calculator fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5 title">Identifikasi Pasien</h5>
                                    <p class="desc">Cheklist Audit Pelaksanaan Identifikasi dan Verifikasi Identitas Pasien</p>
                                </div>
                            </a>
                        </li>

                        <li class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{$url}}/kejadian-jatuh">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title">Kejadian Jatuh</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-calculator fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5 title">Form Kejadian Jatuh</h5>
                                    <p class="desc">Formulir pengkajian kejadian jatuh pasien</p>
                                </div>
                            </a>
                        </li>
                        

                        <li class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{$url}}/humpty-dumpty">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title">Humpty Dumpty</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-calculator fa-4x "></i>
                                    <h5 class="mb-5 title">Humpty Dumpty</h5>
                                    <p class="desc">Alat bantu untuk penilaian risiko jatuh pada anak.</p>
                                </div>
                            </a>
                        </li>

                        <li class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{$url}}/morse">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title">Morse Fall Score</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-calculator fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5 title">Morse Fall Score</h5>
                                    <p class="desc">Morse Fall Score - Asesmen Jatuh Dewasa</p>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
</main>
<!-- END Main Container -->    
@endsection

@section('js')

<script src="{{asset('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
    var options = {
        valueNames: [ 'title', 'desc' ]
    };

    var alatList = new List('alat-list', options);

    $(".fuzzy-search").keyup(function(){
        alatList.search($(this).val());
    });

</script>
@endsection
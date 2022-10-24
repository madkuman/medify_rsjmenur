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
                            <a class="block block-link-pop block-themed" href="{{$url}}/isk">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title">Form Infeksi Saluran Kencing (ISK)</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-calculator fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5 title">ISK</h5>
                                    <p class="desc">Form pencegahan infeksi saluran kencing</p>
                                </div>
                            </a>
                        </li>

                        <li class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{$url}}/bsi">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title">Blood Stream Infection</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-calculator fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5 title">BSI</h5>
                                    <p class="desc">Form pencegahan blood stream infection atau Data Surveilans Pemakaian Alat Invasif CVC.</p>
                                </div>
                            </a>
                        </li>

                        <li class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{$url}}/monitoring-ventilator">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title">Monitoring Ventilator</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-calculator fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5 title">Monitoring dengan Ventilator</h5>
                                    <p class="desc">Form Monitoring Pasien dengan Ventilator</p>
                                </div>
                            </a>
                        </li>

                        <li class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{$url}}/surveilans">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title">Surveilans Infeksi Daerah Operasi</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-calculator fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5 title">Surveilans Infeksi Daerah Operasi</h5>
                                    <p class="desc">Formulir Pengumpulan Data Surveilans Infeksi Daerah Operasi</p>
                                </div>
                            </a>
                        </li>

                        <li class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{$url}}/hap">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title">HAP</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-calculator fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5 title">Hospital Aquired Pneumonie</h5>
                                    <p class="desc">Formulir Pengumpulan Data Surveilans Hospital Aquired Pneumonie (HAP)</p>
                                </div>
                            </a>
                        </li>
                        <li class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{$url}}/plebitis">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title">Plebitis</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-calculator fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5 title">Plebitis</h5>
                                    <p class="desc">Formulir Pengumpulan Data Surveilans Plebitis</p>
                                </div>
                            </a>
                        </li>
                        <li class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{$url}}/tanda-sepsis">
                                <div class="block-header bg-primary">
                                    <h3 class="block-title">Tanda Sepsis</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-calculator fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5 title">Tanda Sepsis</h5>
                                    <p class="desc">Alat Bantu PPI Tanda Sepsis</p>
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
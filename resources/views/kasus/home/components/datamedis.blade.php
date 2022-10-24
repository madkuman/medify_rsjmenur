<div class="col-lg-12">


    <h2 class="content-heading pt-0">Data Baru Hari Ini</h2>

    <div class="row gutters-tiny ">
        <!-- Row #1 -->
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-right" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/cppt">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                       <img src="{{url('assets/icons/32/048-doctor-5.png')}}">
                    </div>
                    <div class="font-size-h3 font-w600 " >{{$data_baru['cppt']}}</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">CPPT</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-right" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/penunjang">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <img src="{{url('assets/icons/32/065-electrocardiogram.png')}}">
                    </div>
                    <div class="font-size-h3 font-w600"><span >{{$data_baru['penunjang']}}</span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Penunjang</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-right" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/tagihan">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <img src="{{url('assets/icons/32/076-cash-register.png')}}">
                    </div>
                    <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="15">{{$data_baru['tagihan']}}</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Tagihan</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <img src="{{url('assets/icons/32/098-journal.png')}}">
                    </div>
                    <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="4252">{{$data_baru['lain']}}</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Data Lain</div>
                </div>
            </a>
        </div>
        <!-- END Row #1 -->
    </div>
</div>
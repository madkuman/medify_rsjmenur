
<div class="col-lg-4 col-xl-3">
    <div class="block block-rounded mb-0">
        <div class="non-block-content">
            <div class="list-group push mb-0">
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if(empty($sidebar_active)) active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}">
                    <img src="{{url('assets/icons/24/083-house.png')}}">
                    <span class="title">Dashboard</span>
                </a>
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'datamedis') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis">
                    <img src="{{url('assets/icons/24/013-medical-history.png')}}">
                    <span class="title">Data Pasien</span>
                </a>
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'resume') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/ringkasan-pasien-pulang">
                    <img src="{{url('assets/icons/24/048-doctor-5.png')}}">
                    <span class="title">Ringkasan Pulang</span>
                </a>
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'penunjang') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/penunjang">
                    <img src="{{url('assets/icons/24/065-electrocardiogram.png')}}">
                    <span class="title">Pemeriksaan Penunjang</span>
                </a>
                @if($kasus->kelas_id!=14)
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'keperawatan') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/keperawatan">
                    <img src="{{url('assets/icons/24/046-nurse.png')}}">
                    <span class="title">Keperawatan</span>
                </a>
                @endif

                {{-- <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'operasi') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/operasi">
                    <img src="{{url('assets/icons/24/026-scalpel.png')}}">
                    <span class="title">Operasi</span>
                </a> --}}

                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'gizi') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/gizi">
                    <img src="{{url('assets/icons/24/064-medicine-1.png')}}">
                    <span class="title">Gizi</span>
                </a>

                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'Farmasi') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/farmasi/pengobatan-pasien">
                    <img src="{{url('assets/icons/24/012-pills.png')}}">
                    <span class="title">Farmasi</span>
                </a>

                @if(isset($kasus->urikkes))
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'urikkes') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/urikkes">
                    <img src="{{url('assets/icons/24/041-weight.png')}}">
                    <span class="title">Urikkes</span>
                </a>
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'pemeriksaanlab') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/pemeriksaanlab">
                    <img src="{{url('assets/icons/24/023-flask.png')}}">
                    <span class="title">Pemeriksaan Lab</span>
                </a>
                @endif

                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'alat') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu">
                    <img src="{{url('assets/icons/24/051-heart-rate.png')}}">
                    <span class="title">Asesmen Lanjutan</span>
                </a>

                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'psikologi') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/psikologi">
                    <img src="{{url('assets/icons/24/004-brain.png')}}">
                    <span class="title">Psikologi</span>
                </a>

                {{--
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'mutu') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/mutu">
                    <img src="{{url('assets/icons/24/011-clipboard-1.png')}}">
                    <span class="title">Mutu</span>
                </a>
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'ppi') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/ppi">
                    <img src="{{url('assets/icons/24/032-vaccine.png')}}">
                    <span class="title">PPI</span>
                </a>
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'tagihan') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/tagihan">
                    <img src="{{url('assets/icons/24/076-cash-register.png')}}">
                    <span class="title">Tagihan</span>
                </a>
                --}}
                
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'tagihan') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/tagihan">
                    <img src="{{url('assets/icons/24/076-cash-register.png')}}">
                    <span class="title">Billing</span>
                </a>

                @if($kasus->my_invitation && $kasus->my_invitation->invitation == 1)
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'administrasi') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/administrasi">
                    <img src="{{url('assets/icons/24/062-doctor-6.png')}}">
                    <span class="title">Administrasi</span>
                </a>
                @endif

                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'alat-medis') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-medis">
                    <img src="{{url('assets/icons/24/057-stethoscope.png')}}">
                    <span class="title">Alat Medis</span>
                </a>
                
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'histori') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/histori">
                    <img src="{{url('assets/icons/24/014-medical-history-1.png')}}">
                    <span class="title">Histori Rekam Medis</span>
                </a>

                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'kolaborator') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/kolaborator">
                    <img src="{{url('assets/icons/24/075-networking.png')}}">
                    <span class="title">Kolaborator</span>
                </a>

                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'timeline') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/timeline">
                    <img src="{{url('assets/icons/24/047-calendar.png')}}">
                    <span class="title">Timeline</span>
                </a>

                @if($kasus->my_invitation && $kasus->my_invitation->invitation == 1)
                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg @if($sidebar_active == 'pengaturan') active @endif" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/pengaturan">
                    <img src="{{url('assets/icons/24/053-gear.png')}}">        
                    <span class="title">Pengaturan</span>
                </a>
                @endif
                
                {{-- <a class="list-group-item list-group-item-action justify-content-between align-items-center svg " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/timeline">
                    <svg class="icon sm">
                        <use xlink:href="#cardiogram" />
                    </svg>
                    <span class="title">Timeline</span>
                </a>


                <a class="list-group-item list-group-item-action justify-content-between align-items-center svg " href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/statistik">
                    <svg class="icon sm">
                        <use xlink:href="#analytics" />
                    </svg>
                    <span class="title">Statistik</span>
                </a> --}}
                
            </div>
        </div>
    </div>
</div>
<div class="mobile-block text-center">.</div>
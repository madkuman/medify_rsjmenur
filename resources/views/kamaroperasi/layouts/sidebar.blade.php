
<div class="col-lg-4 col-xl-3">
    <div class="block block-rounded">
        <div class="non-block-content">
            <div class="list-group push">
                <a class="list-group-item list-group-item-action justify-content-between align-items-center @if(empty($sidebar_active)) active @endif" href="{{url('kamaroperasi')}}">
                    <i class="si si-home"></i> Daftar Jadwal Operasi
                    <span class="badge badge-pill badge-secondary pull-right">1</span>
                </a>
                <a class="list-group-item list-group-item-action justify-content-between align-items-center @if($sidebar_active == 'pemesanan') active @endif" href="{{url('kamaroperasi/pemesanan')}}">
                    <i class="fa fa-stethoscope"></i> Pendaftaran Operasi
                    <span class="badge badge-pill badge-secondary pull-right">1</span>
                </a>
            </div>
        </div>
    </div>
</div>
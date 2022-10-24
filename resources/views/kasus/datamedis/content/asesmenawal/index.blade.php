<div class="block mb-0">
    <ul class="js-chat-head nav nav-tabs nav-tabs-alt bg-body-light mb-10" data-toggle="tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link @if(session('my_invitation_'.$kasus->nomor_kasus) && session('my_invitation_'.$kasus->nomor_kasus)->user->profesi == 1) active @endif" href="#tab-dokter">
                <span class="ml-5">DPJP</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(session('my_invitation_'.$kasus->nomor_kasus) && session('my_invitation_'.$kasus->nomor_kasus)->user->profesi != 1) active @endif" href="#tab-perawat">
                <span class="ml-5">PPJA</span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade @if((session('my_invitation_'.$kasus->nomor_kasus) && session('my_invitation_'.$kasus->nomor_kasus)->user->profesi == 1) || Auth::user()->profesi == 1 ) show active @endif" id="tab-dokter" role="tabpanel">
            @include('kasus.datamedis.content.asesmenawal.tab-dokter')        
        </div>
        <div class="tab-pane fade @if((session('my_invitation_'.$kasus->nomor_kasus) && session('my_invitation_'.$kasus->nomor_kasus)->user->profesi != 1) || Auth::user()->profesi != 1 ) show active @endif" id="tab-perawat" role="tabpanel">
            @include('kasus.datamedis.content.asesmenawal.tab-perawat')        
        </div>
    </div>
</div>
@php
$join = 0;
$invitation = 0;
@endphp

@php 
$my_invitation = session('my_invitation_'.$kasus->nomor_kasus);
@endphp
@if(empty($my_invitation))
@php $join = 1 @endphp
@elseif($my_invitation->invitation == 0)
@php $invitation = 1 @endphp
@elseif($my_invitation->invitation == -1)
@php $join = 1 @endphp
@endif


@if($invitation == 1)
@include('kasus.layouts.kolaborator-extra.invitation')
@endif
@if($join == 1)
@include('kasus.layouts.kolaborator-extra.join')
@endif


@if(!empty($my_invitation))
@if(empty($kasus->admin->id) && (Auth::user()->profesi==1 || Auth::user()->profesi==4) && $my_invitation->invitation == 1)
@include('kasus.layouts.kolaborator-extra.admin-offer')
@endif
@endif

{{--@if ($kasus->tipe_ri == 1)--}}
{{--@php--}}
{{--$d = $kasus->ranap_los;--}}
{{--@endphp--}}
{{--@if ($d > 3)   --}}
{{--@include('kasus.layouts.kolaborator-extra.rawat-inap')--}}
{{--@endif--}}
{{--@endif--}}

{{--
@if($kasus->kelas_id==14)
@if(count($kasus->resumeUrikkes) == 0)
@include('kasus.layouts.kolaborator-extra.urikkes-resume-empty')
@endif
@endif
--}}
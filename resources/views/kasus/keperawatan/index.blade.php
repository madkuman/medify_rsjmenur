@extends('kasus.layouts.main')

@section('title')
Keperawatan - {{$kasus->judul_kasus}}
@endsection


@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            <!-- Updates -->
            <div class="col-lg-4 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block rounded p-0">
                            @if(!empty($kasus->my_invitation) && $kasus->my_invitation->invitation == 1) 
                            @php $my_role = 1 @endphp
                            @else 
                            @php
                            $my_role = 0  
                            @endphp
                            @endif
                            @php $my_role_admin = 0 @endphp
                            @if($my_role == 1) 
                            @if($kasus->my_invitation && $kasus->my_invitation->admin == 1) @php $my_role_admin = 1 @endphp
                            @else @php $my_role_admin = 0 @endphp @endif
                            @endif
            
                            @include('kasus.keperawatan.components.navbar')
                            
                            @if($active_nav == 'rencana_asuhan' || empty($active_nav))
                            @include('kasus.keperawatan.content.rencana')

                            @elseif($active_nav == 'timbang_terima')
                            @include('kasus.keperawatan.content.timbang')

                            @elseif($active_nav == 'nursing-notes')
                            @include('kasus.keperawatan.content.nursing-notes')

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Updates -->
    </div>
</main>


                            
@if($active_nav == 'rencana_asuhan' || empty($active_nav))
@include('kasus.keperawatan.components.modals.rencana.create-modal')
@include('kasus.keperawatan.components.modals.rencana.create-modal-form')
@include('kasus.keperawatan.components.modals.rencana.single-modal')
@include('kasus.keperawatan.components.modals.rencana.edit-modal')

@elseif($active_nav == 'timbang_terima')
@include('kasus.keperawatan.components.modals.timbang.create-modal')
@include('kasus.keperawatan.components.modals.timbang.single-modal')

@elseif($active_nav == 'nursing-notes')
@include('kasus.keperawatan.components.modals.nursing-notes.form')
@endif

@endsection

@section('js')

<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.time').mask('00:00');
    });
</script>
@if($active_nav == 'rencana_asuhan' || empty($active_nav))
@include('kasus.keperawatan.components.js.rencana-asuhan')
@elseif($active_nav == 'timbang_terima')
@include('kasus.keperawatan.components.js.timbang-terima')
@elseif($active_nav == 'nursing-notes')
@include('kasus.keperawatan.components.js.nursing-notes')
@endif

@endsection 

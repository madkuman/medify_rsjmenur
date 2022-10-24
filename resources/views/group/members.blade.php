@extends('layouts.main2')

@section('title')
Anggota Grup {{$group->name}}
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
            <div class="col-md-9 col-md-offset 1">
                @if(!empty($group->my_role) && $group->my_role->admin == 1 && $pendings->count() > 0)
                <div class="block block-rounded block-transparent">
                    <div class="row">
                        <h4 class="text-uppercase col-md-12"><small class="font-black text-primary-darker">Pending</small></h4>
                        @foreach($pendings as $pending)
                        <div class="col-md-4 px-5">
                            <div class="block block-content block-link-shadow my-5">
                                <ul class="nav-users pull-all pt-0">
                                    <li>
                                        <div class="block-content block-content-full clearfix">
                                            <div class="row">
                                                <div class="col-3">
                                                    @if(!empty($pending->user->avatar_thumb))
                                                    <img class="img-avatar-sm" src="{{asset($pending->user->avatar_thumb)}}" alt="">
                                                    @else
                                                    <img class="img-avatar-sm" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                                                    @endif
                                                </div>
                                                <div class="col-7 pl-0">
                                                    <div class="font-w600 font-size-s text-black">
                                                        <a class="p-0" href="{{route('profil', ['id' => $pending->user->id])}}" style="min-height: 0px;"> {{$pending->user->name}}</a>
                                                    </div>
                                                    <div class="font-w400 font-size-xs text-muted">
                                                        @if(!empty($pending->user->profesi))
                                                        {{$pending->user->profesi_detail->title}}
                                                        @endif
                                                        @if(!empty($pending->user->specialty))
                                                         - {{$pending->user->specialty_detail->name}}
                                                        @endif
                                                        @if($pending->users_id == $pending->created_by)
                                                        <span id="warning-{{$pending->id}}" class="badge badge-warning">Menunggu Konfirmasi Admin</span>
                                                        @else
                                                        <span id="warning-{{$pending->id}}" class="badge badge-warning">Menunggu Konfirmasi User</span>
                                                        @endif
                                                        <span id="danger-{{$pending->id}}" class="badge badge-danger" style="display: none;">Penolakan Sukses</span>
                                                        <span id="success-{{$pending->id}}" class="badge badge-success" style="display: none;">Konfirmasi Sukses</span>
                                                        <span id="spinner-{{$pending->id}}" class="ml-5" style="display: none;"><i class="fa fa-asterisk fa-2x fa-spin text-info"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    @if($pending->users_id == $pending->created_by)
                                                    @can('delete member')
                                                    <button type="button" id="button-decline-{{$pending->id}}" class="btn btn-sm btn-circle btn-alt-danger mr-5 mb-5 float-right" onclick="declineMember({{$pending->id}})" data-toggle="tooltip" data-placement="top" title="Tolak">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    @endcan
                                                    @can('edit member')
                                                    <button type="button" id="button-accept-{{$pending->id}}" class="btn btn-sm btn-circle btn-alt-info mr-5 mb-5 float-right" onclick="acceptMember({{$pending->id}})" data-toggle="tooltip" data-placement="top" title="Terima">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    @endcan
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="block block-rounded block-transparent">
                    <div class="row">
                        <h4 class="text-uppercase col-md-6"><small class="font-black text-primary-darker">Anggota Grup</small></h4>
                        <form method="POST" class="col-md-6">
                            {{csrf_field()}}
                            @if(!empty($has_joined))
                            @if($has_joined->invitation == 0)
                            @if(Auth::user()->id == $has_joined->created_by)
                            <button type="button" class="btn btn-xs btn-primary float-right" disabled="disabled">
                                Menunggu Konfirmasi
                            </button>
                            @else
                            <button type="submit" class="btn btn-xs btn-primary float-right">
                                Bergabung
                            </button>
                            @endif
                            @elseif($has_joined->invitation == 1)
                            <button type="button" class="btn btn-xs btn-danger float-right mx-5" onclick="leaveGroup({{$has_joined->id}})">
                                Keluar Grup
                            </button>
                            @can('edit member')
                            <button type="button" class="btn btn-xs btn-default float-right" data-toggle="modal" data-target="#undang-anggota">
                                Undang Anggota
                            </button>
                            @endcan
                            @endif
                            @else
                            <span id="loader" class="float-right ml-5" style="display: none;"><i class="fa fa-asterisk fa-2x fa-spin text-info"></i></span>
                            <button type="button" id="request-button" class="btn btn-xs btn-primary float-right" onclick="joinGroup({{Auth::user()->id}})">
                                Bergabung
                            </button>
                            <button type="button" id="disabled-request-button" class="btn btn-xs btn-primary float-right" style="display: none;" disabled="disabled">
                                Menunggu Konfirmasi
                            </button>
                            @endif
                        </form>
                        @foreach($members as $member)
                        <div class="col-md-4 px-5">
                            <div class="block block-content block-link-shadow my-5">
                                <ul class="nav-users pull-all pt-0">
                                    <li>
                                        <div class="block-content block-content-full clearfix">
                                            <div class="row">
                                                <div class="col-3">
                                                    @if(!empty($member->user->avatar_thumb))
                                                    <img class="img-avatar-sm" src="{{asset($member->user->avatar_thumb)}}" alt="">
                                                    @else
                                                    <img class="img-avatar-sm" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                                                    @endif
                                                </div>
                                                <div class="col-7 pl-0">
                                                    <div class="font-w600 font-size-s text-black">
                                                        <a class="p-0" href="{{route('profil', ['id' => $member->users_id])}}" style="min-height: 0px;"> {{$member->user->name}}</a>
                                                    </div>
                                                    <div class="font-w400 font-size-xs text-muted">
                                                        @if(!empty($member->user->profesi))
                                                        {{$member->user->profesi_detail->title}}
                                                        @endif
                                                        @if(!empty($member->user->specialty))
                                                         - {{$member->user->specialty_detail->name}}
                                                        @endif
                                                        @if($member->admin)
                                                        <span class="badge badge-primary">Admin</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    @if(!empty($group->my_role))
                                                    @if($group->my_role->admin == 1)
                                                    @if($member->users_id != $group->my_role->users_id)
                                                    @can('delete member')
                                                    <button type="button" class="btn btn-sm btn-circle btn-alt-danger mr-5 mb-5 float-right" onclick="removeAnggota({{$member->id}})" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    @endcan
                                                    @endif
                                                    @if(!$member->admin && $member->invitation == 1)
                                                    @can('edit member')
                                                    <button type="button" class="btn btn-sm btn-circle btn-alt-info mr-5 mb-5 float-right" onclick="beAdmin({{$member->id}})" data-toggle="tooltip" data-placement="top" title="Jadikan Admin">
                                                        <i class="fa fa-user-md"></i>
                                                    </button>
                                                    @endcan
                                                    @endif
                                                    @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @if($group->slug == 'e-sakip' && !empty($group->my_role) && $group->my_role->admin == 1)
                                        <li>
                                            <div class="block-content block-content-full clearfix">
                                                <div class="row">
                                                    <div class="col-3">
                                                        @if($member->admin)
                                                        <button type="button" class="btn btn-rounded btn-sm ml-20 btn-alt-primary" data-toggle="tooltip" data-placement="top" title="
                                                           {{implode(',',json_decode($member->esakip_kategori))}}
                                                        ">
                                                            <i class="fa fa-info">
                                                            </i>
                                                        </button>
                                                        @endif
                                                    </div>
                                                    <div class="col-5 pl-5">
                                                        @if($member->admin)
                                                        <button type="button" class="btn btn-xs btn-primary" onclick="editEsakip({{$member->id}},this)" data-kategori="{{$member->e_sakip}}">
                                                            Admin Kontrol
                                                        </button>
                                                        @endif
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="css-control css-control-primary css-switch">
                                                            <input type="hidden" name="notification" value="0">
                                                            <input type="checkbox" class="css-control-input" name="notification" @if($member->show == 1) checked="checked" @endif value="1" onchange="beShowed({{$member->id}},this)">
                                                            <span class="css-control-indicator"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-1">
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
    {{csrf_field()}}
    <input type="hidden" id="inputDeleteUserID" name="id">
    <input type="hidden" name="remove" value="1">
</form>

<form method="POST" action="{{url()->current()}}/delete" id="formLeave">
    {{csrf_field()}}
    <input type="hidden" id="inputLeaveUserID" name="id">
    <input type="hidden" name="leave" value="1">
</form>

<form method="POST" action="{{url()->current()}}/admin" id="formAdmin">
    {{csrf_field()}}
    <input type="hidden" id="inputAdminUserID" name="id">
</form>


@include('group.modals.undang-anggota')
@include('group.modals.e-sakip')

@endsection

@section('js')
<script src="assets/js/pages/be_pages_dashboard.js"></script>
<script type="text/javascript">
    var timer = null;
    $('#inputSearch').keyup(function() {
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(function() {
            searchUser();
        }, 500);
    });

    function removeAnggota(id)
    {
        swal({
            title: 'Hapus Anggota?',
            text: "Anda akan menghapus anggota dari grup ini. Apakah anda yakin?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            confirmButtonClass: 'btn btn-primary ml-10',
            cancelButtonClass: 'btn btn-outline-danger ',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#inputDeleteUserID').val(id);
                $('#formDelete').submit();
            }
        })
    }

    function leaveGroup(id)
    {
        swal({
            title: 'Keluar Grup?',
            text: "Anda akan meninggalkan grup ini. Apakah anda yakin?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            confirmButtonClass: 'btn btn-primary ml-10',
            cancelButtonClass: 'btn btn-outline-danger ',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#inputLeaveUserID').val(id);
                $('#formLeave').submit();
            }
        })
    }

    function beAdmin(id)
    {
        swal({
            title: 'Jadikan Admin?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            confirmButtonClass: 'btn btn-primary ml-10',
            cancelButtonClass: 'btn btn-outline-danger ',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#inputAdminUserID').val(id);
                $('#formAdmin').submit();
            }
        })
    }
    
    function joinGroup(id)
    {
        $.ajax({
            type: "POST",
            url: API_URL + '/group/{{$group->slug}}/invite/create',
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                user_id : id
            },
            beforeSend: function(){
                $('#loader').css("display","block");
            },
            success: function (data) {
                $('#request-button').hide();
                $('#disabled-request-button').show();
                $('#loader').css("display","none");

            },
            error: function () {
                callSwal('error','Terjadi Kesalahan','Silahkan Coba Lagi',0);
                $('#loader').css("display","none");
            }
        });
    }

    function acceptMember(id)
    {
        $.ajax({
            type: "POST",
            url: API_URL + '/group/{{$group->slug}}/member/accept',
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                member_id : id
            },
            beforeSend: function(){
                $('#warning-'+id).hide();
                $('#spinner-'+id).css("display","block");
            },
            success: function (data) {
                $('#success-'+id).show();
                $('#spinner-'+id).css("display","none");
                $('#button-decline-'+id).hide();
                $('#button-accept-'+id).hide();
            },
            error: function () {
                callSwal('error','Terjadi Kesalahan','Silahkan Coba Lagi',0);
                $('#spinner-'+id).css("display","none");
                $('#warning-'+id).show();
            }
        });
    }

    function declineMember(id)
    {
        $.ajax({
            type: "DELETE",
            url: API_URL + '/group/{{$group->slug}}/member/decline',
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                member_id : id
            },
            beforeSend: function(){
                $('#warning-'+id).hide();
                $('#spinner-'+id).css("display","block");
            },
            success: function (data) {
                $('#danger-'+id).show();
                $('#spinner-'+id).css("display","none");
                $('#button-decline-'+id).hide();
                $('#button-accept-'+id).hide();
            },
            error: function () {
                callSwal('error','Terjadi Kesalahan','Silahkan Coba Lagi',0);
                $('#spinner-'+id).css("display","none");
                $('#warning-'+id).show();
            }
        });
    }

    function searchUser()
    {
        $('#loading-top').fadeIn();
        keyword = $('#inputSearch').val();

        $.ajax({
            url: API_URL + '/group/{{$group->slug}}/invite/user/search?keyword='+ keyword,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (!$.trim(data)) {
                    $('#daftarPengguna').empty()
                    content = '<div class="block border mb-0"><div class="block-content py-20">'
                    content+= '<div class="text-center mt-10 "><div class="font-w600 mb-5">User tidak dapat ditemukan</div></div>'
                    content+='</div></div>'
                    $('#daftarPengguna').append(content)
                }
                else {
                    console.log(data)
                    $('#daftarPengguna').empty()
                    $.each(data, function(i) {
                        content = '<div class="block border mb-0"><div class="block-content py-20">'

                        if(data[i] && data[i].invited == 0)
                        {
                            content+= '<button type="button" class="btn btn-primary mr-5 mb-5 float-right" onclick="buttonClickUser('+data[i].id+')" id="buttonInvite'+data[i].id+'">Undang Rekan</button>'
                            content+= '<button type="button" class="btn btn-info mr-5 mb-5 float-right done-undang" style="display:none" id="buttonInviteDisabled'+data[i].id+'" disabled><i class="fa fa-check"></i> Telah Diundang</button>'
                        }
                        else if(data[i])
                        {
                            content+= '<button type="button" class="btn btn-info mr-5 mb-5 float-right done-undang" id="buttonInviteDisabled'+data[i].id+'" disabled><i class="fa fa-check"></i> Telah Diundang</button>'
                            content+= '<button type="button" class="btn btn-primary mr-5 mb-5 float-right" style="display:none" onclick="buttonClickUser('+data[i].id+')" id="buttonInvite'+data[i].id+'">Undang Rekan</button>'
                        }

                        if(data[i] && data[i].profesi_detail){
                            content+= '<div class="text-left mt-10 "><div class="font-w600 mb-5">'+data[i].name+'</div><div class="font-size-sm text-muted">'+data[i].profesi_detail.title+'</div></div>'
                            content+='</div></div>'
                        }else if(data[i]){
                            content+= '<div class="text-left mt-10 "><div class="font-w600 mb-5">'+data[i].name+'</div><div class="font-size-sm text-muted">-</div></div>'
                            content+='</div></div>'
                        }

                        $('#daftarPengguna').append(content)
                    });
                }
            },
            error: function() {
                alert('error');
            },
        });
        $('#loading-top').fadeOut();
    }

    searchUser();

    function buttonClickUser(id)
    {
        $('#loading-top').fadeIn();
        $.ajax({
            type: "POST",
            url: API_URL + '/group/{{$group->slug}}/invite/create',
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                user_id : id
            },
            success: function (data) {
                $('#buttonInvite'+id).hide();
                $('#buttonInviteDisabled'+id).show();

            },
            error: function () {
                callSwal('error','Terjadi Kesalahan','Silahkan Coba Lagi',0);
            }
        });
        $('#loading-top').fadeOut();
    }

    $('#undang-anggota').on('hidden.bs.modal', function () {
        location.reload();
    })

    function beShowed(id,e)
    {
        var value = 0;
        if($(e).is(":checked")){
            value = 1;
        }
        $.ajax({
            type: "POST",
            url: API_URL + '/group/{{$group->slug}}/member/show',
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                member_id : id,
                value : value
            },
            beforeSend: function(){
                $(e).prop('disabled',true);
                $('#loading-top').fadeIn();
            },
            success: function (data) {
                $(e).prop('disabled',false);
                $('#loading-top').fadeOut();
                if(value == 1) callSwal('success','Success','Member Has been showed',0);
                else callSwal('success','Success','Member Has been unshowed',0);
            },
            error: function () {
                $(e).prop('disabled',false);
                $('#loading-top').fadeOut();
                callSwal('error','Terjadi Kesalahan','Silahkan Coba Lagi',0);

            }
        });

    }

    var kategori_esakip_all = {!! $e_sakip_kategori !!};

    function editEsakip(id,e) {
        var kategori = $(e).data('kategori');
        $('#esakip_member_id').val(id);
        if(kategori){
            for (g = 0; g < kategori.length; g++) {
                $('#' + kategori_esakip_all[kategori[g] - 1].slug).prop("checked", true);
            }
        }else {
            for (i = 0; i < kategori_esakip_all.length; i++) {
                $('#' + kategori_esakip_all[i].slug).prop("checked", false);
            }
        }
        $('#modal-esakip').modal('show');

    }

</script>
@endsection

@extends('rekammedis.layouts.main')

@section('title')
Grup Saya
@endsection


@section('content')
<main id="main-container">
    <div class="container pt-50">
        <h5 class="text-uppercase text-muted">Grup Saya</h5>
        <div class="block block-rounded block-transparent">
            <div class="row">
                @if(count($pending) > 0)
                <div class="col-md-12">
                    <h6 class="text-uppercase text-muted mt-10 mb-0 py-0">Pending</h5>
                    <hr class="mt-0 mb-10">
                </div>
                @endif
                @forelse($pending as $group)
                <div class="col-md-4" style="padding: 10px;">
                    <a href="{{url('group/'.$group->grup->slug.'/members')}}" class="block block-content block-link-shadow my-5" style="height: 100px;">
                        <ul class="nav-users pull-all pt-0">
                            <li>
                                <div class="block-content block-content-full clearfix">
                                    <div class="row">
                                        <div class="col-3">
                                            @if(!empty($group->grup->photo_ori))
                                            <img class="img-avatar-sm" src="{{asset($group->grup->photo_ori)}}" alt="">
                                            @else
                                            <img class="img-avatar-sm" src="{{asset('assets/img/group-default.png')}}" alt="">
                                            @endif
                                        </div>
                                        <div class="col-9 pl-0">
                                            <div class="font-w600 font-size-s text-black">
                                                <span class="p-0" style="min-height: 0px;">
                                                    {{$group->grup->name}}
                                                    <span> 
                                                        @if(!empty($group->grup->official))
                                                        <i class="fa fa-check-circle ml-5" style="color: #6ab1ea;"></i>
                                                        @endif
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="font-w400 font-size-xs text-muted" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; line-height: 1.2rem; max-height: 2.4rem;">
                                                @if(!empty($group->grup->description))
                                                {{$group->grup->description}}
                                                @endif
                                                @if($group->users_id == $group->created_by)
                                                <span id="warning-{{$group->id}}" class="badge badge-warning">Menunggu Konfirmasi Admin</span>
                                                @else
                                                <span id="warning-{{$group->id}}" class="badge badge-danger">Menunggu Konfirmasi User</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </a>
                </div>
                @empty
                @endforelse
                <div class="col-md-12" style="padding-top: 30px">
                    <h6 class="text-uppercase text-muted mt-10 mb-0 py-0">Anda Sebagai Admin</h5>
                    <hr class="mt-0 mb-10">
                </div>
                @forelse($group_admin as $group)
                <div class="col-md-4" style="padding: 10px;">
                    <a href="{{url('group/'.$group->grup->slug.'/members')}}"  class="block block-content block-link-shadow my-5" style="height: 100px;">
                        <ul class="nav-users pull-all pt-0">
                            <li>
                                <div class="block-content block-content-full clearfix">
                                    <div class="row">
                                        <div class="col-3">
                                            @if(!empty($group->grup->photo_ori))
                                            <img class="img-avatar-sm" src="{{asset($group->grup->photo_ori)}}" alt="">
                                            @else
                                            <img class="img-avatar-sm" src="{{asset('assets/img/poli/001-brain.png')}}" alt="">
                                            @endif
                                        </div>
                                        <div class="col-9 pl-0">
                                            <div class="font-w600 font-size-s text-black">
                                                <span class="p-0" href="{{url('group/'.$group->grup->slug.'/discussions')}}" style="min-height: 0px;">
                                                    {{$group->grup->name}}
                                                    <span> 
                                                        @if(!empty($group->grup->official))
                                                        <i class="fa fa-check-circle ml-5" style="color: #6ab1ea;"></i>
                                                        @endif
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="font-w400 font-size-xs text-muted" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; line-height: 1.2rem; max-height: 2.4rem;">
                                                @if(!empty($group->grup->description))
                                                {{$group->grup->description}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </a>
                </div>
                @empty
                @endforelse
                <div class="col-md-12" style="padding-top: 30px">
                    <h6 class="text-uppercase text-muted mt-10 mb-0 py-0">Anda Sebagai Anggota</h5>
                    <hr class="mt-0 mb-10">
                </div>
                @forelse($group_member as $group)
                <div class="col-md-4" style="padding: 10px;">
                    <a href="{{url('group/'.$group->grup->slug.'/members')}}"  class="block block-content block-link-shadow my-5" style="height: 100px;">
                        <ul class="nav-users pull-all pt-0">
                            <li>
                                <div class="block-content block-content-full clearfix">
                                    <div class="row">
                                        <div class="col-3">
                                            @if(!empty($group->grup->photo_ori))
                                            <img class="img-avatar-sm" src="{{asset($group->grup->photo_ori)}}" alt="">
                                            @else
                                            <img class="img-avatar-sm" src="{{asset('assets/img/poli/001-brain.png')}}" alt="">
                                            @endif
                                        </div>
                                        <div class="col-9 pl-0">
                                            <div class="font-w600 font-size-s text-black">
                                                <span class="p-0" href="{{url('group/'.$group->grup->slug.'/discussions')}}" style="min-height: 0px;">
                                                    {{$group->grup->name}}
                                                    <span> 
                                                        @if(!empty($group->grup->official))
                                                        <i class="fa fa-check-circle ml-5" style="color: #6ab1ea;"></i>
                                                        @endif
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="font-w400 font-size-xs text-muted" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; line-height: 1.2rem; max-height: 2.4rem;">
                                                @if(!empty($group->grup->description))
                                                {{$group->grup->description}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </a>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</main>

@endsection
@section('js')
@endsection
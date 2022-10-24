<div class="block block-rounded block-transparent">
    <div class="content-side content-side-full">
        <ul class="nav-main">
            @if(!empty($has_joined))
            @if($has_joined->invitation == 1)
            @can('read member')
            <li>
                <a href="{{route('group.discussions', ['slug' => $group->slug])}}"><i class="fa fa-comments-o"></i><span class="sidebar-mini-hide">Diskusi</span></a>
            </li>
            @if($group->official)
            <li>
                <a href="{{url('group/'.$group->slug.'/farmasi')}}"><i class="fas fa-pills"></i><span class="sidebar-mini-hide">Farmasi</span></a>
            </li>
            <li>
                <a href="{{url('group/'.$group->slug.'/laundry')}}"><i class="fas fa-tshirt"></i><span class="sidebar-mini-hide">Laundry</span></a>
            </li>
            <li>
                <a href="{{$group->slug == 'rekam-medis' ? url('rekammedis') : url('group/'.$group->slug.'/rekam-medis')}}"><i class="fas fa-notes-medical"></i><span class="sidebar-mini-hide">Rekam Medis</span></a>
            </li>
            @endif
            @endcan
            @endif
            @endif
            <li>
                <a href="{{route('group.members', ['slug' => $group->slug])}}"><i class="fa fa-group"></i><span class="sidebar-mini-hide">Anggota</span></a>
            </li>
            @if(!empty($has_joined))
            @if($has_joined->invitation == 1)
            @can('edit member')
            <li>
                <a href="{{route('group.settings', ['slug' => $group->slug])}}"><i class="fa fa-wrench"></i><span class="sidebar-mini-hide">Pengaturan</span></a>
            </li>
            @endcan
            @endif
            @endif
        </ul>
    </div>
</div>
@if(!empty($group->banner))
<div class="bg-image bg-image-bottom" style="background-image: url('{{asset($group->banner)}}')">
@else
<div class="bg-image bg-image-bottom" style="background-image: url('{{asset('assets/img/photos/photo3@2x.jpg')}}')">
@endif
    <div class="bg-primary-dark-op">
        <div class="content content-full group-banner row" style="min-height: 150px;">
            <div class="col-md-2 h-150 d-flex align-self-center">
                @if(!empty($group->photo_ori))
                <img class="avatar-preview" src="{{asset($group->photo_ori)}}" alt="Card image cap" style="width: 90px; height: 90px; background-color: white">
                @else
                <img class="avatar-preview" src="{{asset('assets/img/group-default.png')}}" alt="Card image cap" style="width: 90px; height: 90px; background-color: white">
                @endif
            </div>
            <div class="col-md-10 mb-0 h-150 d-flex align-self-center">
                <div>
                <span class="h2" style="color: white">
                    {{$group->name}}
                    @if(!empty($group->official))
                    <i class="fa fa-check-circle ml-5" style="color: #6ab1ea;"></i>
                    @endif
                </span>
                @if(!empty($group->description))
                <br><span style="font-size: 14px;" class="font-w400 mb-0 text-white">{{$group->description}}</span>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>

<a href="{{url('pasien/asesmen/general-consent')}}?pasien_id={{$id}}&layouts=pasien" class="btn btn-rounded btn-alt-primary min-width-125 float-right"><i class="fa fa-pencil"></i> General Consent </a>

<h4>General Consent</h4>
<hr>
@php $count = count($general_consent) @endphp
@forelse($general_consent as $item)
@php $data_val = json_decode($item->val); @endphp
@if($item->created_by == Auth::user()->id)
    <button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
        <i class="fa fa-trash"></i>
    </button>
    <a href="{{ url('') }}/pasien/asesmen/general-consent/form/edit?pasien_id={{$id}}&id={{$item->id}}" class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
        <i class="fa fa-pencil"></i>
    </a>
    @if(empty($data_val->img_ttd))					
    <button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right btn-add-ttd" data-toggle="modal" data-id="{{$item->id}}" data-pasien_id="{{$id}}" data-url="{{ url('') }}/pasien/asesmen/general-consent/add-ttd">
        <i class="fa fa-signature"></i>
    </button>
    @endif
@endif
<a type="btn" href="{{ url('') }}/pasien/asesmen/general-consent/print?pasien_id={{$id}}&id={{$item->id}}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
    <i class="fa fa-print"></i>
</a>
<a href="{{ url('') }}/pasien/asesmen/general-consent/single?pasien_id={{$id}}&id={{$item->id}}" class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
    <i class="fa fa-search"></i>
</a>

<h5 class="mb-5 pl-5">#General Consent {{$count}}</h5>

@if(!empty($item->creator->avatar_thumb))
<div class="float-left mr-10">
    <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
</div>
@else
<div class="float-left mr-10">
    <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url("assets/img/placeholder.jpg")}}" alt="">
</div>
@endif
<div class="creator">
    <h6 class="pt-10">
        <small class="text-muted">Dibuat Oleh</small><br>
        {{$item->creator->name}}<br>
        {{date("d F y, H:i", strtotime($item->created_at))}}
    </h6>
</div>

<hr class="my-20">
@php $count-- @endphp
@empty

<div class="text-center py-50">
    <h4 class="font-w400 mb-5">Belum ada asesmen General Consent tersedia</h4>
    <p>Klik tombol <b>General Consent Baru</b> untuk melakukan asesmen General Consent</p>
</div>

@endforelse
<form method="POST" action="{{ url('pasien') }}/asesmen/general-consent/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
</form>
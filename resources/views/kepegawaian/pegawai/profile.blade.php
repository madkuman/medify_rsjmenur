@extends('kepegawaian.layouts.main-profile')

@section('title')
  {{$htmlheader_title}}
@endsection

@section('subtitle')
  {{$contentheader_title}}
@endsection

@section('main-content')
<div class="card">
  <div class="card-body px-20" data-id="{{$item->id}}">
    <div class="col-12 my-20">
      <div class="row">
        <div class="col-12 text-right float-right">
          <a href="{{route('profile-print', ['id' => $item->id, '_' => microtime(true)])}}" target="_blank" class="btn btn-alt-warning pull-right"><i class="fa fa-print mr-5 mb-10"></i>Print</a>
          <a href="{{url('/kepegawaian/pegawai/edit/')}}/{{$item->id}}" class="btn btn-alt-primary pull-right"><i class="fa fa-pencil-square-o mr-5 mb-10"></i>Edit</a>
        </div>
      </div>
      <div class="row">
          <div class="col-lg-6 col-12 mb-20">
            @include('kepegawaian.pegawai.profile-content.umum')
            @include('kepegawaian.pegawai.profile-content.personel')
            {{-- @include('kepegawaian.pegawai.profile-content.staf-medis') --}}
          </div>
          <div class="col-lg-6 col-12 mb-20">
            @include('kepegawaian.pegawai.profile-content.domisili')
            @include('kepegawaian.pegawai.profile-content.pernikahan')
            @include('kepegawaian.pegawai.profile-content.kesehatan')
            @include('kepegawaian.pegawai.profile-content.tugas')
          </div>
        </div>
        {{-- <div class="row justify-content-center">
          {!! Form::open(['url' => route('pegawai-delete'), 'id' => 'mainform', 'class' => 'form-delete-employee']) !!}
            {{ Form::hidden('ids[]', $item->id) }}
            {{ Form::hidden('bulk-action', 'delete') }}
            {{ Form::button('Hapus Data', ['class' => 'btn btn-alt-danger pull-right mb-20 delete-employee-button']) }}
          {!! Form::close() !!}
        </div> --}}
        {{-- <form action="{{url('/kepegawaian/pegawais/delete/')}}/{{$item->id}}"> --}}
          <button type="button" data-target="#deletemodal" data-toggle="modal" data-name="{{$item->name}}" data-url="{{url('/kepegawaian/pegawais/delete/')}}/{{$item->id}}" class="btn btn-alt-danger pull-right mb-20 delete-employee-button hapus-pegawai">Hapus Data</button>
        {{-- </form> --}}
    </div>
  </div>
</div>
@endsection
@include('kepegawaian/master/subkualifikasi/modal-delete')
@push('footer-script')
<script>
  // onReady closure-scope
  $(document).on("click",".hapus-pegawai", function () {
			var url = $(this).data('url');
			var nama = $(this).data('name');
			$(".selected").removeClass("selected");
			$(this).parent().parent().addClass("selected");
			$('#form_delete').attr('action',url);
			$("#show-name").html('Anda yakin ingin menghapus data Pegawai ' + nama + '?')

		})
</script>
@endpush
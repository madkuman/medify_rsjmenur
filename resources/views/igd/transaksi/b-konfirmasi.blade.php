@extends('rawatjalan.layouts.main')

@section('title')
Konfirmasi - IGD - Medify
@endsection

@section('subtitle')
Konfirmasi
@endsection

@section('content')

<div class="row page-title-container">  
   <div class="icon">  
       <i class="fa fa-exchange"></i>  
   </div>  
   <div class="title">  
       Antri Baru Pasien<br><small>Konfirmasi Ulang Pemesanan Antrian</small>
   </div>  
</div>

<div class="row">
  <div class="col-md-3"></div>  
  <div class="col-md-3">
    <div class="card">
      <div class="card-header">
        <div class="image small text-center">
          <img height="100px" src="{{asset($pasien->photo_thumb)}}" onerror="imgError(this);">
        </div>
      </div>
      <div class="card-body text-center" >
        <h4>{{$pasien->name}}</h4>
        {{$pasien->ktp}}
        <br />{{$pasien->address}}
        <br />{{$pasien->date_of_birth}}
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card">
      <div class="card-header  text-center">
        <h4>{{$ruangan->name}}</h4>
      </div>
      <div class="card-body text-center" >
        Kapasitas Ruangan yang Tersedia
        @if(!empty($ruangan->kapasitas))
        <h2 class="title" style="margin-bottom: 35px">
        {{$ruangan->kapasitas-$ruangan->count}}</h2>
        @else <h2 class="title" style="margin-bottom: 35px">0</h2>
        @endif
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 text-center">
    <form method="POST" action="{{url('igd/ruangan/baru/submit')}}">
      {{csrf_field()}}
      <input type="hidden" value="{{$ruangan->id}}" name="ruangan_id">
      <input type="hidden" value="{{$pasien->id}}" name="pasien_id">
      <input type="hidden" value="{{$kasus_id}}" name="kasus_id">
      <button type="button" class="btn btn-danger btn-fill" id="batal-antri">
        <i class="fa fa-trash-o" aria-hidden="true"></i> Batal
      </button>
      <button class="btn btn-primary" type="submit">Daftar</button>
    </form>
  </div>
</div>

@endsection

@section('css')
	<style type="text/css">
		.form-group {
            margin-bottom: 5px;
        }

        .card label {
            font-size: 11px;
            margin-bottom: 0;
            text-transform: none;
        }

        .small {
          padding: 10px;
        }
        /*.form-control {
            background-color: #FFFFFF;
            border: 1px solid #E3E3E3;
            border-radius: 4px;
            font-size: 12px;
            color: #565656;
            padding: 8px 12px;
            height: 30px;
            -webkit-box-shadow: none;
            box-shadow: none;
        }*/

        .btn {
            /*border-width: 2px;*/
            /*background-color: transparent;*/
            font-weight: 400;
            padding: 8px 16px;
            /*border: 1px solid #888888;*/
            /*color: #FFFFFF;*/
            /*background-color: #888888;*/
            cursor: pointer;
            /*margin-bottom: 5px;*/
            font-size: 1em;
            line-height: 1.42857143;
        }

        .btn-size {
            /*border-width: 2px;*/
            /*background-color: transparent;*/
            font-weight: 400;
            padding: 8px 16px;
            /*border: 1px solid #888888;*/
            /*color: #FFFFFF;*/
            /*background-color: #888888;*/
            cursor: pointer;
            /*margin-bottom: 5px;*/
            font-size: 0.875rem;
            line-height: 1.42857143;
        }

        .card .card-body .control-label {
            text-align: left;
            padding-top: 18px;
        }

        #loader-4 span{
          display: inline-block;
          width: 20px;
          height: 20px;
          border-radius: 100%;
          background-color: #3498db;
          margin: 35px 5px;
          opacity: 0;
        }

        #loader-4 span:nth-child(1){
          animation: opacitychange 1s ease-in-out infinite;
        }

        #loader-4 span:nth-child(2){
          animation: opacitychange 1s ease-in-out 0.33s infinite;
        }

        #loader-4 span:nth-child(3){
          animation: opacitychange 1s ease-in-out 0.66s infinite;
        }

        @keyframes opacitychange{
          0%, 100%{
            opacity: 0;
          }

          60%{
            opacity: 1;
          }
        }

        div.dataTables_wrapper div.dataTables_length label {
            font-weight: normal;
            text-align: left;
            white-space: nowrap;
        }

        .card label {
            font-size: 0.75rem;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .input-group-sm>.input-group-btn>select.btn:not([size]):not([multiple]), .input-group-sm>select.form-control:not([size]):not([multiple]), .input-group-sm>select.input-group-addon:not([size]):not([multiple]), select.form-control-sm:not([size]):not([multiple]) {
            height: calc(1.9999rem + 2px);
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 75px;
            display: inline-block;
        }

        .btn.disabled, .btn:disabled {
            cursor: not-allowed;
            opacity: .40;
        }

        .btn-default.disabled, .btn-default:disabled {
            background-color: #888888 !important;
            border-color: #888888 !important;
        }
	</style>
@endsection

@section('js')
  <script type="text/javascript">
      $('document').ready(function() {
        $('#batal-antri').on('click', function() {
            var deleteSupp = $(this).parent().find('form');
            swal({
                title: "Apa anda yakin ?",
                text: "Pasien tidak akan didaftarkan pada ruangan.",
                type: "warning",
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-default',
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                closeOnConfirm: false,
                closeOnCancel: false,
                allowOutsideClick: false
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location = "{{url('/igd/ruangan/baru')}}";
                    swal("Konfirmasi Dibatalkan", "Ruangan tidak dikonfirmasi. Pasien belum terdaftar pada ruangan.", "error");
                } else {
                    swal("Konfirmasi Ulang", "Lakukan konfirmasi pada ruangan.", "error");
                }
            });
        })
    });
  </script>
@endsection

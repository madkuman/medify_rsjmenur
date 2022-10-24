@extends('layouts.main')

@section('title')
	Ruangan - Kamar Operasi - Medify
@endsection

@section('sidebarcomponent')
    @include('kamaroperasi.components.sidebar')
@endsection

@section('content')
<div class="row page-title-container">  
   <div class="icon">  
       <i class="fa fa-exchange"></i>  
   </div>  
   <div class="title">  
       Ruangan <br><small>Daftar Pengguna Kamar Operasi</small>
   </div>  
</div>  


<div class="card main-content transaction-index">

    <div class="card-header "> 
        <h4 class="card-title">Ruangan {{$ruangan->name}}</h4>
        <p class="card-category">Daftar penggunaan ruang yang terdaftar pada {{$ruangan->name}}</p>
    </div>

    <div class="card-body table-full-width inventory">
        <table class="table">
            <thead>
                <tr class="header">
                    <th>#</th>
                    <th>Nama Dokter</th>
                    <th>Nama Pasien</th>
                    <th>Nomor Ronde</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $index => $trans)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$trans->dokter->name}}</td>
                    <td>{{$trans->pasien_detail->name}}</td>
                    <td>{{$trans->nomor_ronde}}</td>
                    @if($trans->status==0)
                    <td>Operasi belum dilaksanakan</td>
                    <td>
                        <form method="POST" action="{{url('kamaroperasi/pindah')}}">
                          {{csrf_field()}}
                          <input type="hidden" value="{{$trans->id}}" name="transaksi_id">
                          <button class="btn btn-warning" type="submit"><i class="fa fa-pencil"></i></button>
                        </form>
                        <a href="#" class="btn btn-primary" type="submit">Proses</a>
                    </td>
                    @else
                    <td>Operasi telah dilaksanakan</td>
                    <td>
                        <a href="#" class="btn btn-success" type="submit">Lihat Rekap</a>
                    </td>
                    @endif
                </tr>
                @empty
                <tr style="text-align: center;">
                    <td></td>
                    <td colspan="6">Tidak ada pemesanan ruangan pada hari ini.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
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

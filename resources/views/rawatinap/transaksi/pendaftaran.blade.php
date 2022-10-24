@extends('rawatinap.layouts.main')

@section('title')
Permintaan Inap - Rawat Inap - Medify
@endsection

@section('subtitle')
Permintaan Inap
@endsection

@section('content')
<main id="main-container">
    @include('rawatinap.layouts.navbar')
    <div class="container" id="block-list">
        <h4>Daftar Permintaan Rawat Inap</h4>
        <div class="row mb-20">
            <div class="col-12">
                <input type="text" class="form-control fuzzy-search" placeholder="Cari Pasien, No RM">
            </div>
        </div>
        <div class="list">
            @php $count = 0; @endphp
            @forelse($transaksi as $item)

            <div class="block">
                <div class="block-content pb-20 ">
                    <div class="row p-0 m-0">
                        <div class="col-md-1 text-center h-100 d-flex align-self-center">
                            <h3 class="mb-0">{{++$count}}</h3>
                        </div>
                        <div class="col-md-1 p-0 ">
                            <img class="img-avatar full-only" src="{{asset('')}}/{{$item->pasien->photo_thumb}}">
                        </div>
                        <div class="col-md-3 h-100 d-flex align-self-center">
                            <h5 class="mb-0">
                                <span class=" item-name"> 
                                    {{$item->pasien->name}}
                                </span>
                                <br>
                                <small class="font-w400">
                                    @if($item->pasien->gender == 1) Laki laki
                                    @else Perempuan
                                    @endif
                                    , {{$item->pasien->age}}

                                </small>
                                <br>
                                <small class="font-w400 item-rm">
                                    {{$item->pasien->no_rm}}
                                </small>
                            </h5>
                        </div>
                        <div class="col-md-3 h-100 d-flex align-self-center">
                            <h5 class="mb-0"><small class="font-w400">Judul Kasus</small><br>
                             @if($item->kasus_id!=0) 
                             <a href="{{url('')}}/kasus/{{$item->kasus->nomor_kasus}}/datamedis" class="item-judul-kasus"> {{$item->kasus->judul_kasus}}
                             </a>
                             @else
                             -
                             @endif
                         </h5>
                     </div>
                     <div class="col-md-3 h-100 d-flex align-self-center">
                        <h5 class="mb-0">
                            <small class="font-w400">Keterangan</small><br>
                            @if(isset($item->keterangan))
                            <label style="font-size: 13px;">{{$item->keterangan}}</label>
                            @endif
                        </h5>
                    </div>
                    <div class="col-12"><hr></div>
                    <div class="col-md-6">
                        Permintaan Oleh : 
                        <span class="font-w600 ml-5"> {{$item->creator->name}}</span><br>
                        <span class="text-white">Permintaan Oleh :</span>
                        <span class="font-w600 ml-5"> {{date('d F y, H:i', strtotime($item->created_at))}}</span>
                    </div>
                    <div class="col-md-6">
                        <a href="{{url('rawatinap/transaksi/pendaftaran/ruangan')}}?transaksi_id={{$item->id}}" class="btn btn-primary pull-right">Daftarkan</a>
                        <button class="btn btn-outline-danger pull-right mr-10" onclick="tolakTransaksi({{$item->id}})">Tolak</button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada permintaan rawat inap tersedia</h4>
        </div>
        @endforelse
    </div>
</div>
</main>
<form method="POST" action="{{url()->current()}}/tolak" id="formTolak">
    {{csrf_field()}}
    <input type="hidden" id="tolakId" name="transaksi_id">
    <input type="hidden" id="tolakKeterangan" name="keterangan">
</form>


@endsection

@section('js')
<script type="text/javascript">
    function tolakTransaksi(id){
        swal({
            title: 'Apa anda yakin?',
            input: 'text',
            text: "Mengapa anda menolak permintaan ini?",
            type: 'warning',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-danger',
            showCancelButton: true,
            confirmButtonText: 'Tolak Transaksi',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
            return !value && 'Masukan Alasan Penolakan!'
            }
        }).then((result) => {
            if (result.value) {
                console.log(result.value);
                $('#tolakKeterangan').val(result.value)            
                $('#tolakId').val(id)
                $('#formTolak').submit()
            }
        })



    }
</script>

<script src="{{asset('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
    var options = {
        valueNames: [ 'item-name','item-rm','item-judul-kasus' ]
    };

    var groupList = new List('block-list', options);
</script>
@endsection
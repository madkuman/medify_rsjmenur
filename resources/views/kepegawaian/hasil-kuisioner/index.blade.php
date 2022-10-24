@extends('kepegawaian.layouts.main')

@section('title')
{{$htmlheader_title}}
@endsection

@section('subtitle')
{{$contentheader_title}}
@endsection

@section('content')

@if (empty($kuisioner))
<div class="content">
    <div class="block p-10">
        <div class="block block-content block-transparent">
            <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
            </button>
            <div class="d-none" id="filter-data">
                <form method="POST" action="{{url('kepegawaian/hasil-kuisioner')}}" id="formFilter">
                    {!!csrf_field()!!}
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="control-label">Nama Kuisioner</label>
                                <input type="text" name="namafilter" list="kuisioner-list" class="form-control"
                                autocomplete="off">
                                <datalist id="kuisioner-list">
                                @foreach ($kuisionerlist as $item)
                                    <option value='{{$item->nama}}'>
                                @endforeach 
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Tutup</button>
                            <button type="submit" class="btn btn-primary btn-square">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="block-content">
            <div class="col-12">
                <div class="row">
                    <table class="table table-bordered table-striped" style="width: 100%">
                            <tr class="text-center">
                                <td><h4>Belum terdapat Kuisioner Aktif / Nama Kuisioner tidak ditemukan.</h4></td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Hasil Kuisioner 
            </h3>
            <div class="block-options">
                <form method="POST" action="{{url('kepegawaian/print-kuisioner/belum')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="kuisionerid" value="{{$id}}">
                    <input type="submit" class="btn btn-alt-primary min-width-125" value="Laporan User yang Belum Mengisi"> 
                </form>
            </div>
        </div>
        <div class="block block-content block-transparent">
            <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
            </button>
            <div class="d-none" id="filter-data">
                <form method="POST" action="{{url('kepegawaian/hasil-kuisioner')}}" id="formFilter">
                    {!!csrf_field()!!}
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="control-label">Nama Kuisioner</label>
                                <input type="text" name="namafilter" list="kuisioner-list" class="form-control"
								autocomplete="off">
								<datalist id="kuisioner-list">
                                @foreach ($kuisionerlist as $item)
                                    <option value='{{$item->nama}}' style="text-transform: capitalize">
                                @endforeach 
								</datalist>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Tutup</button>
                            <button type="submit" class="btn btn-primary btn-square">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
		<div class="block-content">
            <div class="col-12">
                <div class="row">
                    <table class="table table-bordered table-striped" style="width: 100%">
                        <thead>
                            <tr class="text-center">
                                <th>Persentase Kepuasan</th>
                                <th>Persentase Ketidak Puasan</th>
                                <th>Jumlah Kepuasan</th>
                                <th>Jumlah Ketidak Puasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td><h1>{{$persen_puas}} %</h1></td>
                                <td><h1>{{$persen_tidak}} %</h1></td>
                                <td><h1>{{$hasil_puas}}</h1></td>
                                <td><h1>{{$hasil_tidak}}</h1></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-center">Total Partisipan = <b>{{$total}}</b> Orang</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
</div>
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Hasil Kepuasan
			</h3>
        </div>
		<div class="block-content">
            <div class="col-12">
                <div class="row">
                    <table class="table table-bordered table-striped" style="width: 100%">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Jumlah Kepuasan</th>
                                <th>Jumlah Ketidak Puasan</th>
                                <th>Persen Kepuasan</th>
                                <th>Persen Ketidak Puasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @if (!empty($kepuasan))
                                @foreach ($kepuasan as $item)
                                    <tr class="text-center">
                                        <td style="vertical-align: middle">{{$no}}</td>
                                        <td>{{$item[0]}}</td>
                                        <td style="vertical-align: middle"><h1>{{$item[1]}}</h1></td>
                                        <td style="vertical-align: middle"><h1>{{$item[2]}}</h1></td>
                                        <td style="vertical-align: middle"><h1>{{$item[3]}} %</h1></td>
                                        <td style="vertical-align: middle"><h1>{{$item[4]}} %</h1></td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Data Sampling Kuisioner Kosong</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
</div>
@endif

@endsection

@section('js')
<script type="text/javascript">
    $('#btnFilter').on('click', function(){
        $(this).addClass('d-none');
        $(this).parents('.block-content').find('#transaksi_farmasi_wrapper').addClass('mt-50');
        $('#filter-data').removeClass('d-none');
    });

    $('#btnCancel').on('click', function(){
        $(this).parents('#filter-data').addClass('d-none');
        $(this).parents('.block-content').find('#transaksi_farmasi_wrapper').removeClass('mt-50');
        $('#btnFilter').removeClass('d-none'); 
    });

    // $('#btnReset').on('click', function(e) {
    //     $('#status_selesai').prop('checked', true);
    //     $('#reset').val(1).trigger('change');
    //     document.getElementById("formFilter").submit();
    // });
    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false
    });
</script>
@endsection
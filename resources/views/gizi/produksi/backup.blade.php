@extends('gizi.layouts.index')

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="{{url('gizi/produksi/baru')}}" class="pull-right"><i class="fa fa-plus-circle"></i> Buat Produksi</a></small> 
				<small><a href="{{url('gizi/produksi/histori')}}" class="pull-right mr-15"><i class="fal fa-clock"></i> Histori Produksi</a></small> 

				Produksi Makanan <small>24 September Sore - 25 September Siang</small>
			</h3>
		</div>
		<div class="block-content pt-0">
			<hr>
			<h6 class="mb-0">Buat Laporan Produksi Berdasarkan Rekap</h6>
			<p class="mb-5">Dengan ini anda tidak perlu memasukkan rekap resep ulang untuk membuat daftar belanja</p>
			<a href="{{url('gizi/produksi/baru')}}" class="btn btn-primary">Buat Laporan Produksi</a>
			<hr>
		</div>
		<div class="block-content">
			<table class="table table-bordered  table-hover table-striped table-center">
				<tbody>
					<tr>
						<th rowspan="2" style="width: 13%;">RESEP</th>
						<th class="text-center" colspan="6">PAGI</th>
						<th class="text-center" colspan="6">SIANG</th>
						<th class="text-center" colspan="6">SORE</th>
						<th rowspan="2" class="text-center">TOTAL</th>
					</tr>
					<tr>
						<th class="text-center" >VIP</th>
						<th class="text-center">I Utama</th>
						<th class="text-center">I</th>
						<th class="text-center">II</th>
						<th class="text-center">III</th>
						<th class="text-center">TOTAL</th>
						<th class="text-center" >VIP</th>
						<th class="text-center">I Utama</th>
						<th class="text-center">I</th>
						<th class="text-center">II</th>
						<th class="text-center">III</th>
						<th class="text-center">TOTAL</th>
						<th class="text-center" >VIP</th>
						<th class="text-center">I Utama</th>
						<th class="text-center">I</th>
						<th class="text-center">II</th>
						<th class="text-center">III</th>
						<th class="text-center">TOTAL</th>
					</tr>
					<tr></tr>
					<tr>
						<td>Ayam Goreng Rica Rica</td>
						<td>23</td>
						<td>67</td>
						<td>120</td>
						<td>175</td>
						<td>75</td>
						<td>575</td>
						<td>23</td>
						<td>67</td>
						<td>120</td>
						<td>175</td>
						<td>75</td>
						<td>575</td>
						<td>23</td>
						<td>67</td>
						<td>120</td>
						<td>175</td>
						<td>75</td>
						<td>575</td>
						<td>1072</td>
					</tr>
					<tr>
						<td><i>Ayam Goreng Bola Bola</i></td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>6</td>
					</tr>
					<tr>
						<td>Nasi</td>
						<td>23</td>
						<td>67</td>
						<td>120</td>
						<td>175</td>
						<td>75</td>
						<td>575</td>
						<td>23</td>
						<td>67</td>
						<td>120</td>
						<td>175</td>
						<td>75</td>
						<td>575</td>
						<td>23</td>
						<td>67</td>
						<td>120</td>
						<td>175</td>
						<td>75</td>
						<td>575</td>
						<td>1072</td>
					</tr>
					<tr>
						<td><i>Nasi Tim</i></td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>6</td>
					</tr>
					<tr>
						<td>Nasi Lunak</td>
						<td>23</td>
						<td>67</td>
						<td>120</td>
						<td>175</td>
						<td>75</td>
						<td>575</td>
						<td>23</td>
						<td>67</td>
						<td>120</td>
						<td>175</td>
						<td>75</td>
						<td>575</td>
						<td>23</td>
						<td>67</td>
						<td>120</td>
						<td>175</td>
						<td>75</td>
						<td>575</td>
						<td>1072</td>
					</tr>
					<tr>
						<td><i>Lontong</i></td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>0</td>
						<td>0</td>
						<td>2</td>
						<td>6</td>
					</tr>
				</tr>

			</tbody>
		</table>
	</div>
</div>
</div>
@endsection

@section('js')
@endsection
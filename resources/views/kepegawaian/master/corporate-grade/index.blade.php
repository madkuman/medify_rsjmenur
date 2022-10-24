@extends('kepegawaian.layouts.main')

@section('title')
Master Corporate Grade
@endsection

@section('subtitle')
Master Corporate Grade
@endsection

@section('css')

@endsection

@section('content')

<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<div class="btn-group pull-right" role="group">
					<button type="button" class="btn btn-primary dropdown-toggle" id="btnGroupDrop1" data-toggle="dropdown">
						<i class="fa fa-cog"></i> Pengaturan
					</button>
					<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
						<a class="dropdown-item" href="{{url()->current()}}/level">
							<i class="fa fa-fw fa-line-chart mr-5"></i>Pengaturan Level
						</a>
						<a class="dropdown-item" href="{{url()->current()}}/profesi">
							<i class="fa fa-fw fa-user-md mr-5"></i>Pengaturan Profesi
						</a>
						<a class="dropdown-item" href="{{url()->current()}}/grade">
							<i class="si fa-fw si-badge mr-5"></i>Pengaturan Grade
						</a>
					</div>
				</div>
				Corporate Grade
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-vcenter">
				<tbody>
					<tr>
						<th class="text-center">6</th>
						<td class="text-center bg-primary">
							<a href="{{url()->current()}}/grade/baru">
								<div style="height: 100%; width: 100%" class="text-light">
									D1
								</div>
							</a>
						</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<th class="text-center">5</th>
						<td></td>
						<td class="text-center bg-primary">
							<a href="{{url()->current()}}/grade/baru">
								<div style="height: 100%; width: 100%" class="text-light">
									P2
								</div>
							</a>
						</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<th class="text-center">4</th>
						<td></td>
						<td class="text-center bg-primary">
							<a href="{{url()->current()}}/grade/baru">
								<div style="height: 100%; width: 100%" class="text-light">
									P1
								</div>
							</a>
						</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<th class="text-center">3</th>
						<td></td>
						<td></td>
						<td class="text-center bg-primary">
							<a href="{{url()->current()}}/grade/baru">
								<div style="height: 100%; width: 100%" class="text-light">
									B1
								</div>
							</a>
						</td>
						<td></td>
					</tr>
					<tr>
						<th class="text-center">2</th>
						<td></td>
						<td></td>
						<td></td>
						<td class="text-center bg-primary">
							<a href="{{url()->current()}}/grade/baru">
								<div style="height: 100%; width: 100%" class="text-light">
									A2
								</div>
							</a>
						</td>
					</tr>
					<tr>
						<th class="text-center">1</th>
						<td></td>
						<td></td>
						<td></td>
						<td class="text-center bg-primary">
							<a href="{{url()->current()}}/grade/baru">
								<div style="height: 100%; width: 100%" class="text-light">
									A1
								</div>
							</a>
						</td>
					</tr>
				</tbody>
				<tfoot style="border-top: 3px solid gainsboro">
					<tr>
						<th class="text-center" style="width: 50px;">Lv</th>
						<th class="text-center">Dokter</th>
						<th class="text-center">Perawat</th>
						<th class="text-center">Bidan</th>
						<th class="text-center">Apoteker</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
@endsection

@section('js')


@endsection
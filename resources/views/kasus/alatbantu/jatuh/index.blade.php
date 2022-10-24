@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Resiko Jatuh - Kasus
@endsection

@section('css')
<style type="text/css">
    .humpty-dumpty-item {
        font-weight: 500;
        width: 100%;
    }
    .humpty-dumpty-item > input{ /* HIDE RADIO */
        visibility: hidden; /* Makes input not-clickable */
        position: absolute; /* Remove input from document flow */
    }

    .humpty-dumpty-item div
    {
        padding:8px 8px;
    }

    .humpty-dumpty-item > input + div{ /* DIV STYLES */
        cursor:pointer;
        border:2px solid transparent;
    }
    .humpty-dumpty-item > input:checked + div{ /* (RADIO CHECKED) DIV STYLES */
        background: #dcdcdc;
    }

    .table.humpty-dumpty td, .table.humpty-dumpty th
    {
        text-align: center;
    }
</style>
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
	@include('kasus.layouts.header')

	<div class="content">
		<div class="row">
			@include('kasus.layouts.sidebar')

			<!-- Updates -->
			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">

						
						<h4>Resiko Jatuh</h4>
						<hr>


						<ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" href="#tab_humpty">Humpty Dumpty</a>
							</li>
							<li class="nav-item">
								<a class="nav-link " href="#tab_morse">Morse Fall Score</a>
							</li>
						</ul>
						<div class="block-content tab-content">
							<div class="tab-pane active" id="tab_humpty" role="tabpanel">
								@if(session('my_role_'.$kasus->nomor_kasus))
								<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal1"><i class="fa fa-plus"></i> Skor Humpty Dumpty Baru</button>
								@endif
								<h5 class="mb-5 pl-5">#Resiko Jatuh  - Humpty Dumpty</h5>
								<br><hr>
								@include('kasus.alatbantu.jatuh.humpty.index')
							</div>
							<div class="tab-pane " id="tab_morse" role="tabpanel">
								@if(session('my_role_'.$kasus->nomor_kasus))
								<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal2"><i class="fa fa-plus"></i> Skor Morse Fall Baru</button>
								@endif
								<h5 class="mb-5 pl-5">#Resiko Jatuh - Morse Fall Score</h5>
								<br><hr>
								@include('kasus.alatbantu.jatuh.morse.index')
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>
<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/jatuh/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
</form>
@include('kasus.alatbantu.jatuh.humpty.add')
@include('kasus.alatbantu.jatuh.morse.add')
@include('kasus.alatbantu.jatuh.humpty.tatalaksana')
@include('kasus.alatbantu.jatuh.morse.tatalaksana')

@endsection

@section('js')
@include('kasus.alatbantu.jatuh.humpty.js')
@include('kasus.alatbantu.jatuh.morse.js')
@endsection
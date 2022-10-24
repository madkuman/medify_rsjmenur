@extends('layouts.main2')

@section('title')
Dashboard - Kamar Operasi - Medify
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('kamaroperasi.components.navbar')
		<div class="row">
			<div class="col-12">
				<div class="block block-rounded">
            <div class="block-header">
              <h3 class="block-title">Dashboard</h3>
            </div>
            <div class="block-content" style="padding: 0px">
            </div>
          </div>
        </div>
			</div>
		</div>
	</main>
	@endsection

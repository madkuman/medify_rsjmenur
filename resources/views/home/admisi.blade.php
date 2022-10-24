@extends('layouts.main-dashboard')
@section('content')

@include('layouts.components2.navbar')
<!-- Main Container -->
<main id="main-container">
	<div class="content">
		<div class="row">
			<div class="col-lg-3">
				<a class="block block-transparent mb-10" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix  p-0 pl-10">
                        <div class="float-left mr-10">
                            <i class="fa fa-h-square fa-2x"></i>
                        </div>
                        <div class="float-left text-left" style="margin-top: 3px;">
                            <h5 class="font-w600 mb-5">Medify Hospital </h5>
                        </div>
                    </div>
                </a>


                <div class="block block-rounded block-transparent">
                    <div class="content-side content-side-full">
                        <ul class="nav-main">
                            <li>
                                <a href="{{url('')}}"><i><img src="{{asset('/icons/001-ambulance.png')}}" ></i><span class="sidebar-mini-hide">Dashboard</span></a>
                            </li>
                            <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Menu Utama</span></li>
                            <li>
                                <a href="{{url('pasien')}}"><i><img src="{{asset('/icons/004-brain.png')}}" ></i><span class="sidebar-mini-hide">Pasien</span></a>
                            </li>
                            <li>
                                <a href="{{url('igd')}}"><i class="fal fa-ambulance"></i><span class="sidebar-mini-hide">IGD</span></a>
                            </li>
                            <li>
                                <a href="{{url('rawatinap')}}"><i class="fal fa-bed"></i><span class="sidebar-mini-hide">Rawat Inap</span></a>
                            </li>
                            <li>
                                <a href="{{url('rawatjalan')}}"><i class="fal fa-wheelchair"></i><span class="sidebar-mini-hide">Rawat Jalan</span></a>
                            </li>
                            <li>
                                <a href="{{url('kamarjenazah')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Kamar Jenazah</span></a>
                            </li>
                            <!-- <li>
                                <a href="{{url('')}}"><i class="fa fa-angle-double-down"></i><span class="sidebar-mini-hide">Menu Lainnya</span></a>
                            </li>
                            <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Arsip</span></li> -->
                            <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span></li>
                            <li>
                                <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Arsip Kasus</span></a>
                            </li>
                            <li>
                                <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Profil</span></a>
                            </li>
                            <li>
                                <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Informasi Kepegawaian</span></a>
                            </li>
                            <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Grup</span></li>
                            @foreach($grup as $group)
                            <li>
                                <a href="{{url('')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">{{ $group->grup->name }}</span></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
			</div>
			
			<div class="col-9">
				<div class="block rounded main-content transaction-index"  ng-controller="PasienController">
					<div class="block-header">
						<h3 class="block-title">Daftar Pasien</h3>
					</div>
					<div class="block-content">
						<div class="row mb-20">
							<div class="col-sm-12"> 
								<form style="margin-top: 10px" id="pasienSearchForm">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Cari Pasien" id="pasienSearch">
										<div class="input-group-append">
											<button type="submit" class="btn btn-secondary">Cari</button>
										</div>
									</div>
								</form>
							</div> 
						</div>
					</div>

					<div id="noResult" style="display: none">
						<div class="text-center py-50">
							Pasien tidak ditemukan. Silahkan coba dengan kata kunci lainnya <br>
							Atau anda bisa membuat pasien baru<br><br>
							<a href="{{url('pasien/baru')}}" class="btn btn-outline-primary">+ Pasien Baru</a>
						</div>
					</div>

					<div class="table-full-width spinner-container" id="pasienResult"> 
						<div class="spinner-back">
							<table class="table table-striped table-hover table-pointer "> 
								<thead>
									<tr class="header" ng-click="getCurrentPage()">
										<th style="width:5%">No RM </th>
										<th style="width:20%">Nama</th>
										<th style="width:20%">Alamat</th>
										<th style="width:10%">No KTP</th>
										<th style="width:10%">Jenis Pasien</th>
									</tr>
								</thead>
								<tbody class="spinner-back-placeholder">
									@for ($i = 0; $i < 10; $i++)
									<tr class="clickable-row"> 
										<td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
										<td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
										<td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
										<td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
										<td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
									</tr>
									@endfor
								</tbody>
								<tbody id="renderPasien"></tbody>
							</table> 
						</div>

						<div class="spinner">
							<td colspan="6"><i class="fa fa-4x fa-asterisk fa-spin text-info"></i></td>
						</div>

						<div class="flex-center" style="">
							<ul id="pagination" class="pagination"></ul>
						</div>
					</div>
				</div>
			</div>

			{{--
				<div class="col-lg-4 col-xl-6">
					<div class="row">
						<div class="col-lg-12">
							<div class="block block-rounded">
								<div class="block-header">
									<h3 class="block-title">
										Daftar Pasien
									</h3>
									<button class="float-right btn btn-primary">+ Pasien Baru</button>
								</div>
								<div class="block-content pt-0 mb-20">
									<form style="margin-top: 10px" id="pasienSearchForm">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Cari Pasien" id="pasienSearch">
											<div class="input-group-append">
												<button type="submit" class="btn btn-secondary">Cari</button>
											</div>
										</div>
									</form>
								</div>
								<div class="block-content overflow-hidden">
									@include('home.dummy.pasien')
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-xl-3">
					<div class="block block-rounded">
						<div class="block-header">
							<h3 class="block-title">
								Tagihan <small>Belum Terbayar</small>
							</h3>
						</div>
						<div class="block-content block-content-full">
							@include('home.dummy.tagihan')
						</div>
					</div>
					<div class="block block-rounded">
						<div class="block-header">
							<h3 class="block-title">
								Pasien <small>Bulan ini</small>
							</h3>
						</div>
						<div class="block-content block-content-full">
							<div class="pull-all">
								<canvas class="js-chartjs-dashboard-lines"></canvas>
							</div>
						</div>
						<div class="block-content">
							<div class="row items-push">
								<div class="col-6 text-center">
									<div class="font-size-sm font-w600 text-uppercase text-muted">Pasien Baru <br>Bulan Ini</div>
									<div class="font-size-h4 font-w600">720</div>
									<div class="font-w600 text-success">
										<i class="fa fa-caret-up"></i> +16%
									</div>
								</div>
								<div class="col-6 text-center">
									<div class="font-size-sm font-w600 text-uppercase text-muted">Rata Rata <br>Setiap Bulan</div>
									<div class="font-size-h4 font-w600">24.3</div>
									<div class="font-w600 text-success">
										<i class="fa fa-caret-up"></i> +9%
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				--}}
			</div>
		</div>
	</main>
@endsection

@section('js')
<script src="assets/js/pages/be_pages_dashboard.js"></script>

<script type="text/javascript">
	var total_pages = 1;
	var visible_pages = 5;
	var keyword = '';
	var items_show = 10;
	var firstLoadPagination = false;

    loadData();

    function loadPagination(currentPage = 1)
    {
        console.log(total_pages);

        $('#pagination').twbsPagination('destroy');
        $('#pagination').twbsPagination({
            totalPages: total_pages,
            startPage: currentPage,
            visiblePages: visible_pages,
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
                loadData(page,keyword);
            }
        });
        firstLoadPagination = true;
    }
    function reloadPagination(currentPage)
    {
        var defaultOpts = {
            totalPages: 20
        };
        console.log('reload');
        console.log(total_pages);
        $('#pagination').twbsPagination($.extend({}, defaultOpts, {
            startPage: currentPage,
            totalPages: total_pages
        }));
    }


    function loadData(currentPage=1,keyword='')
    {
        $('.spinner').fadeIn();
        $('#noResult').hide();
        $('#pasienResult').show();
        $('#renderPasien').hide();
        $('.spinner-back-placeholder').show();
        $.ajax({
            url: API_URL + '/pasien/get?page='+ currentPage + '&keyword=' + keyword,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if(data.total>0)
                {
                    $('#noResult').hide();
                    $('#pasienResult').show();
                    total_pages = Math.ceil(data.total/items_show);
                    var template = $('#template-pasienlist').html();
                    loadMustache(template);
                    var rendered = Mustache.render(template, data);
                    $('.spinner').fadeOut();
                    $('#renderPasien').show();
                    $('#renderPasien').html(rendered);
                    $('.spinner-back-placeholder').hide();
                    loadPagination(currentPage);
                }
                else
                {
                    $('.spinner').fadeOut();
                    $('#noResult').fadeIn();
                    $('#pasienResult').hide();
                    $('.spinner-back-placeholder').hide();
                }
            },
            error: function() {
                alert('error');
            },
        });
    }

    function loadMustache(template) {
        Mustache.parse(template, customTags);
        Mustache.tags = customTags;
    }

    $('#pasienSearchForm').submit(function( event ) {
        event.preventDefault();

        keyword = $('#pasienSearch').val();
        console.log(keyword);
        loadData(1,keyword);
    });
</script>


<script id="template-pasienlist" type="x-tmpl-mustache">
    @{{#data}}
    <tr class="clickable-row" onclick='goToHref("{{url('pasien')}}/@{{id}}")'> 
        <td>@{{id}}</td>
        <td>
            <div class="pull-left">
                <img src="{{url('')}}/@{{photo_thumb}}" class="img-avatar-sm">
            </div>
            <div class="pull-left ml-10">
                @{{name}}<br>
                @{{jenis_kelamin}}, @{{age}}
            </div>
        </td>
        <td>@{{address}}<br>
        @{{alamat_kecamatan}},@{{alamat_kota}}
        </td>
        <td>@{{ktp}}</td>
        <td>@{{types}}</td>
    </tr>
    @{{/data}}
</script>


	@endsection
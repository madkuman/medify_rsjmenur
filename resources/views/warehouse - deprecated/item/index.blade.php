@extends('layouts.main',['app' => "warehouse"])

@section('title')
	Item - Pergudangan - Medify
@endsection

@section('sidebarcomponent')
    @include('warehouse.components.sidebar')
@endsection

@section('content')

<div class="row page-title-container">
	<div class="icon">
		<i class="fa fa-cubes"></i>
	</div>
	<div class="title">
		Barang<br>
		<small>
			Daftar Semua Barang
		</small>
	</div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row">
	<div class="col-md-3" id="filter-data">
		<form>
			<div class="card ">
	            <div class="card-header ">
	                <h4 class="card-title">Filter Data</h4>
	            </div>
	            <div class="card-body ">
	                <div class="form-group has-label">
	                    <label class="control-label"><strong>Cari Barang</strong></label>
	                    <input type="text" class="form-control" id="searchBar" placeholder="Cari" name="key">
	                </div>
	                <div class="form-group has-label">
	                    <label class="control-label"><strong>Jumlah</strong></label>
	                    <input name="qty_min" type="number" placeholder="Minimal" class="form-control" id="minQty">
			          	<input name="qty_max" type="number" placeholder="Maksimal" class="form-control" id="maxQty" style="margin-top:5px">
	                </div>
	                <div class="form-group has-label">
	                    <label class="control-label"><strong>Harga</strong></label>
	                    <input type="text" placeholder="Minimal" class="form-control" id="minimal-price">
	                    <input type="hidden" id="minPrice">
	                    <input type="text" placeholder="Maksimal" class="form-control" id="maximal-price" style="margin-top:5px">
  						        <input type="hidden" id="maxPrice">
	                </div>
                  <div class="form-group has-label" id="kategori-checkbox">
                      <label class="control-label"><strong>Kategori</strong></label>
                      @foreach($categories as $category)
                      <div class="form-check">
                        <label class="form-check-label">
                          <input name="kategori" class="form-check-input" id="checkbox" type="checkbox" value="{{$category->name}}">
                          <span class="form-check-sign"></span>
                          <strong>{{$category->name}}</strong>
                        </label>
                      </div>
                      @endforeach
                  </div>
	            </div>
	            <div class="card-footer">
	            	<div class="pull-right">
	            		<button class="btn btn-default" type="reset" onclick="riset(1)">
      							<i class="fa fa-refresh" aria-hidden="true"></i> Reset
      						</button>	
						<span>&nbsp;</span>
						<button class="btn btn-primary pull-right" onclick="riset(0); filterData(0)">
							<i class="fa fa-filter" aria-hidden="true"></i> Filter
						</button>
	            	</div>
	            </div>
	        </div>
        </form>
		<br><br>
		
	</div>

    <div class="col-md-9 col-sm-7">
    	<div class="card main-content transaction-index">
	        <div class="card-header">
	        	<div class="row">
                    <div class="col-md-8">
                        <div class="card-category" id="jumlahData">
                            Menampilkan 1-9 dari {{$count}} Barang
                        </div>
                    </div>
                </div>
	        </div>
	        <div class="card-body">
	        	<div class="row" id="hasilSearch">
		            @foreach($items as $item)
			            <div class="col-md-4">
			                <div class="card border">
			                	<div class="card-header">
			                		<div class="image small">
				                        <img width="100%" height="200" src="{{asset($item->image_thumb)}}" onerror="imgError(this);">
				                    </div>
			                	</div>
			                	<div class="card-body">
			                		<div>
				                        <a href="{{url('warehouse/item/'.$item->slug)}}">
				                            <h5 class="title">{{$item->name}}<br>
				                                @if($item->type == 1)
				                                <small>Obat</small>
				                                @else
				                                <small>Alat</small>
				                                @endif
                                        @if($item->supplier_detail != null)
                                        <small>- {{$item->supplier_detail->nama}}</small>
                                        @endif
				                            </h5>
                                    @forelse($item->items_category as $category)
                                      <span class="label label-info">{{$category->name}}</span>
                                    @empty -
                                    @endforelse
				                        </a>
				                    </div>
				                    <hr>
				                    <span class="price">
			                            <i class="fa fa-cube text-muted"></i> {{$item->qty_ready}}
			                            <br>
			                            <i class="fa fa-usd text-muted"></i> Rp. {{number_format($item->price)}}
			                        </span>
			                	</div>
			                </div>
			            </div>
		            @endforeach
		        </div>
	        </div>
          <div class="card-footer">
              <div class="row" style="margin-top: 30px;">
                  <div class="col-md-4">
                      <div class="pull-right">
                          <button class="btn btn-default btn-page" id="buttonFirst" onclick="firstPage()" title="Awal">
                              <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                          </button>
                          <button class="btn btn-default btn-page" id="buttonPrev" onclick="previousPage()" title="Sebelumnya">
                              <i class="fa fa-angle-left" aria-hidden="true"></i>
                          </button>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="row">
                          <div class="col-md-12">
                              <center>
                              <div class="dataTables_wrapper container-fluid dt-bootstrap4">
                                  <div class="dataTables_length">
                                      <label>Halaman 
                                          <select name="labeling" aria-controls="datatables" class="form-control form-control-sm" id="labeling" onchange="changePage()">
                                              @php
                                                  $x = 1;
                                                  for($x = 1; $x <= ceil($count/9); $x++)
                                                  {
                                                      echo "<option value='".$x."'>".$x."</option>";
                                                  }
                                              @endphp
                                          </select> Dari <span id="jumlahHalaman">{{ceil($count/9)}}</span>
                                      </label>
                                  </div>
                              </div> 
                              </center>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="pull-left">
                          <button class="btn btn-default btn-page" id="buttonNext" onclick="nextPage()" title="Selanjutnya">
                              <i class="fa fa-angle-right" aria-hidden="true"></i>
                          </button>
                          <button class="btn btn-default btn-page" id="buttonLast" onclick="lastPage()" title="Akhir">
                              <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                          </button>
                      </div>
                  </div>
              </div>
          </div>
	    </div>
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
            font-size: 12px;
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
  	<script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
  	<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    <script type="text/javascript">
        $(window).on('load',function(jqXHR, textStatus, errorThrown){
            $('#myModal').modal('show');
        });
    </script>
    <script type="text/javascript">
		$(document).ready(function(jqXHR, textStatus, errorThrown) {
			/*var $input = $('#searchBar');
			$input.keyup(function() {
			index.search("", {
			"hitsPerPage": "10",
			"page": "0",
			"attributesToRetrieve": "*",
			"facets": "[]",
			"numericFilters": "[\"price<1000\"]",
			}, searchCallback);
			}).focus();*/

			//formatMoney();
			console.log("ini jqXHR", textStatus);
			@if(session('status')) {
                swal('Berhasil', '{{(session('status'))}}', 'success');
            }
            @endif

		    $('#buttonFirst').attr('disabled', true);
		    $('#buttonPrev').attr('disabled', true);
		    $('#buttonLast').attr('disabled', false);
		    $('#buttonNext').attr('disabled', false);
		});

	    $(".btn-page").on("click", function() {
	        $("html, body").scrollTop(0);
	    });

	 function imgError(image) {
			image.onerror = "";
			image.src = "https://cdn.browshot.com/static/images/not-found.png";
      // https://vignette.wikia.nocookie.net/simpsons/images/6/60/No_Image_Available.png/revision/latest?cb=20170219125728
			return true;
		}

		$('#minimal-price').inputmask("numeric", {
            radixPoint: ",",
            groupSeparator: ",",
            //digits: 2,
            autoGroup: true,
            //prefix: 'Rp. ', //No Space, this will truncate the first character
            rightAlign: false,
            //oncleared: function () { self.Value(''); }
        });

        $("#minimal-price").keyup(function() {
            var price = document.getElementById("minimal-price").value;
            var priceReplace = price.split('.').join('');
            document.getElementById("minPrice").value = priceReplace;
            //console.log(priceReplace);
        });

        $('#maximal-price').inputmask("numeric", {
            radixPoint: ",",
            groupSeparator: ",",
            //digits: 2,
            autoGroup: true,
            //prefix: 'Rp. ', //No Space, this will truncate the first character
            rightAlign: false,
            //oncleared: function () { self.Value(''); }
        });

        $("#maximal-price").keyup(function() {
            var price = document.getElementById("maximal-price").value;
            var priceReplace = price.split('.').join('');
            document.getElementById("maxPrice").value = priceReplace;
            //console.log(priceReplace);
        });

        var currentPage = 0;
        var mode = 0;
        var jumlahData = "{{$count}}";
        var dataperPage = 9;
        var jumlahHalaman = Math.ceil(jumlahData/dataperPage);

        function searchCallback() {
          	mode = 1;
          	var client = algoliasearch('8LCMXALPI5', '391c0c6f8b3678baeb79bf72be77090b');
          	var index = client.initIndex('warehouse_item');

          	var name = $('#searchBar').val();
          	var obat = $('#checkbox1');
          	var alat = $('#checkbox2');

          	var min_qty = $('#minQty').val() ? $('#minQty').val() : 0;
          	var max_qty = $('#maxQty').val() ? $('#maxQty').val() : 999999999;
          	var min_price = $('#minPrice').val() ? $('#minPrice').val() : 0;
          	var max_price = $('#maxPrice').val() ? $('#maxPrice').val() : 999999999;
          	console.log(max_price);

          	var str = "";

          	index.search(name, {
              	"hitsPerPage": dataperPage,
              	"page": currentPage,
              	"analytics": "false",
              	"attributesToRetrieve": "*",
              	"facets": "[]",
              	"numericFilters": "[\"price<="+max_price+"\",\"price>="+min_price+"\",\"qty_ready>="+min_qty+"\",\"qty_ready<="+max_qty+"\"]"
            }, function(err, content){
                if (err) {
                    console.error(err);
                    return;
                }

                console.log(content);
                content.hits.forEach(function(item) {
                	console.log(item);
                  	str += 
                  	`<div class="col-md-4">
                      	<div class="card border">
                      		<div class="card-header">
	                          	<div class="image small">
	                              	<img width="100%" height="200" src="`+item.image_thumb+`" onerror="imgError(this);">
	                          	</div>
                          	</div>
                          	<div class="card-body">
                          		<div>
	                              	<a href="{{url("warehouse/item/`+item.slug+`")}}">
	                                  	<h5 class="title">`+item.name+`<br>`;
					                  	if(item.type == 1) str += `<small>Obat</small>`;
					                  	else str += `<small>Alat</small>`;
                              if(item.supplier_detail!=null) str += `<small> - `+item.supplier_detail.nama+`</small>`;
					                          	str +=  `</h5>
	                              	</a>
                              	</div>
                              	<hr>
                              	<span class="price">
                                  	<i class="fa fa-cube text-muted"></i>`+item.qty_ready+`
                                  	<br>
                                  	<i class="fa fa-usd text-muted"></i>Rp `+item.price+`
                              	</span>
                          	</div>
                      	</div>
                  	</div>`;  
                })
                navigate(currentPage,content.nbHits);
                document.getElementById("hasilSearch").innerHTML = str;
          });

        };

        function filterData(page) {
        	var str = "";
        	mode = 1;

        	var name = $('#searchBar').val();

          	var min_qty = $('#minQty').val();
          	var max_qty = $('#maxQty').val();
          	var min_price = $('#minPrice').val();
          	var max_price = $('#maxPrice').val();
            var categories = [];
            $('#kategori-checkbox input:checked').each(function() {
                categories.push($(this).val());
            });
            if(!categories.length) categories = null;
            console.log(categories);

          	$.ajaxSetup({
            	headers: {
                	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            	}
          	});

        	$.ajax({
        		type:'POST',
        		url:'{{url("warehouse/item/search")}}/' + page,
        		data: {name:name, min_price:min_price, max_price:max_price, min_qty:min_qty, max_qty:max_qty, categories:categories},
        		dataType: 'json',
        		beforeSend: function() {
                    console.log("loading...");
                    var loadingScreen = 
                        '<div class="loader center" id="loader-4" style="margin: 0 auto;">' +
                            '<span></span>' +
                            '<span></span>' +
                            '<span></span>' +
                        '</div>';
                    $('#hasilSearch').html(loadingScreen);
                },
        		success:function(data){
        			data.data.forEach(function(item) {

        			//console.log(item);
	              	str+= `<div class="col-md-4">
	                        	<div class="card border">
	                        		<div class="card-header">
	  	                          	<div class="image small">
	  	                              	<img width="100%" height="220" src="{{asset('`+item.image_thumb+`')}}" onerror="imgError(this);">
	  	                          	</div>
	                            	</div>
	                            	<div class="card-body">
	                            		<div>
	  	                              	<a href="{{url("warehouse/item/`+item.slug+`")}}">
	  	                                  	<h5 class="title">`+item.name+`<br>`;
	  					                  	if(item.type == 1) str += `<small>Obat</small>`;
	  					                  	else str += `<small>Alat</small>`;
                                  if(item.supplier_detail!=null) str += `<small> - `+item.supplier_detail.nama+`</small>`;
	  					                          	str +=  `</h5>`;
                                          if(item.items_category!=null) item.items_category.forEach(function(category) {
                                            str +=  `<span class="label label-info">`+category.name+`</span>`;
                                          });
                                          else str += `-`;
	  	                              	str += `</a>
	                                	</div>
	                                	<hr>
	                                	<span class="price">
	                                    	<i class="fa fa-cube text-muted"></i> `+item.qty_ready+`
	                                    	<br>
	                                    	<i class="fa fa-usd text-muted"></i> Rp. `;
	                                    	if(item.price != null) str += formatMoney(item.price);
	                                    	else str += "0";
	                                	str += `</span>
	                            	</div>
	                        	</div>
	                    	</div>`;
	        			//console.log(str)
        			});
        			document.getElementById("hasilSearch").innerHTML = str;
        			navigate(page, data.total);
        		},
        		error:function(data){
        		  console.log(data);
        		}
        	});
        }

		function loadPage(page) {
			var str = "";

			$.ajax({
				type:'GET',
				url:'{{url("warehouse/item/page")}}/' + page,
				dataType: 'json',
				beforeSend: function() {
                    console.log("loading...");
                    var loadingScreen = 
                        '<div class="loader center" id="loader-4" style="margin: 0 auto;">' +
                            '<span></span>' +
                            '<span></span>' +
                            '<span></span>' +
                        '</div>';
                    $('#hasilSearch').html(loadingScreen);
                },
				success:function(data){
					data.data.forEach(function(item) {

						//console.log(item);
						str += 
		                  	`<div class="col-md-4">
		                      	<div class="card border">
		                      		<div class="card-header">
			                          	<div class="image small">
			                              	<img width="100%" height="220" src="{{asset('`+item.image_thumb+`')}}" onerror="imgError(this);">
			                          	</div>
		                          	</div>
		                          	<div class="card-body">
		                          		<div>
			                              	<a href="{{url("warehouse/item/`+item.slug+`")}}">
			                                  	<h5 class="title">`+item.name+`<br>`;
							                  	if(item.type == 1) str += `<small>Obat</small>`;
							                  	else str += `<small>Alat</small>`;
                                  if(item.supplier_detail!=null) str += `<small> - `+item.supplier_detail.nama+`</small>`;
							                          	str +=  `</h5>`;
                                          if(item.items_category!=null) item.items_category.forEach(function(category) {
                                            str +=  `<span class="label label-info">`+category.name+`</span>`;
                                          });
                                          else str += `-`;
			                              	str += `</a>
		                              	</div>
		                              	<hr>
		                              	<span class="price">
		                                  	<i class="fa fa-cube text-muted"></i> `+item.qty_ready+`
		                                  	<br>
		                                  	<i class="fa fa-usd text-muted"></i> Rp. `;
		                                  	if(item.price != null) str += formatMoney(item.price);
                                    		else str += "0";
		                              	str += `</span>
		                          	</div>
		                      	</div>
		                  	</div>`;
						//console.log(str)
					});
					document.getElementById("hasilSearch").innerHTML = str;
				},
				error:function(data){
				console.log(data);
				}
			});

			navigate(page, jumlahData);
		}

		function previousPage() {
          	if(currentPage>0) currentPage--;
          
          	if(mode) {
            	filterData(currentPage);
          	}
          	else {
            	loadPage(currentPage);
          	}
        };

        function nextPage() {
          	if(currentPage < jumlahHalaman-1)currentPage++;

          	if(mode) {
            	filterData(currentPage);
          	}
          	else {
            	loadPage(currentPage);
          	}
        };

        function lastPage() {
            currentPage = jumlahHalaman-1;

            if(mode) {
                filterData(currentPage);
            }
            else {
                loadPage(currentPage);
            }

            //console.log(currentPage);
            //searchCallback();
        };

        function firstPage() {
            currentPage = 0;

            if(mode) {
                filterData(currentPage);
            }
            else {
                loadPage(currentPage);
            }

            //console.log(currentPage);
            //searchCallback();
        };

        function changePage() {
            currentPage = $('#labeling').find(":selected").val()-1;
            //console.log(currentPage);
            if(mode) {
                filterData(currentPage);
            }
            else {
                loadPage(currentPage);
            }
        };

        function navigate(page, count) {
          	jumlahData = count;
            var newJumlah = Math.ceil(count/dataperPage)
            if(jumlahHalaman != newJumlah){
                jumlahHalaman = newJumlah;
                $('#labeling').empty();
                var select = document.getElementById("labeling");

                for(var i = 1; i <= jumlahHalaman; i++) {
                    select.options.add(new Option(i, i));
                }
                document.getElementById("jumlahHalaman").innerHTML = jumlahHalaman;
            } 

          	var head = page*dataperPage+1;
          	var tail = (page+1)*dataperPage < count ? (page+1)*dataperPage : count;
          	if(count) var str = "Menampilkan "+head+"-"+tail+" dari "+count+" Barang";
          	else var str = "Tidak ditemukan barang yang sesuai";
          	document.getElementById("jumlahData").innerHTML = str;

          	//document.getElementById("jumlahHalaman").innerHTML = "<center>Halaman "+(page+1)+" dari "+jumlahHalaman+"</center>";
            $('#labeling').val(page+1);
            if(!page) {
                $('#buttonFirst').attr('disabled', true);
                $('#buttonPrev').attr('disabled', true);
                $('#buttonLast').attr('disabled', false);
                $('#buttonNext').attr('disabled', false);
            }
            else if(page+1 == jumlahHalaman) {
                $('#buttonFirst').attr('disabled', false);
                $('#buttonPrev').attr('disabled', false);
                $('#buttonLast').attr('disabled', true);
                $('#buttonNext').attr('disabled', true);
            }
            else {
                $('#buttonFirst').attr('disabled', false);
                $('#buttonPrev').attr('disabled', false);
                $('#buttonLast').attr('disabled', false);
                $('#buttonNext').attr('disabled', false);
            }
        };

        function riset(reset) {
          	currentPage = 0;
          	mode = 0;
          	console.log(reset);
          	if(reset) loadPage(currentPage);
        };
    </script>
@endsection
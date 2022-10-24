<!doctype html>
<html lang="en" class="no-focus" ng-app="medifyApp">
<head>
    @include('layouts.components2.header')
</head>
<body>
    <div style="position: fixed; top:100px; left: 48%; z-index: 2000; display: none" id="loading-top">
        <i class="fa fa-4x fa-asterisk fa-spin text-info"></i>
    </div>
    
    <div id="page-container" class="page-header-fixed main-content-boxed">  
        <div id="page-overlay" onclick="closeNav()"></div>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="text-align: center; font-weight: bold;">Review Stok Opname #{{$stokopname->slug}}</h3>
                <br>
            </div>
            <h4 class="block-title" style="text-align: center;">Dibuat Oleh {{$stokopname->created_by_detail->name}}
            </h4>
            <div class="block-content">
                <hr class="my-5">
                <div class="col-12 ajax-container" style="padding-top: 10px;" id="itemsContainer">
                    <h5 style="margin-bottom: 15px;" id="judulBarang">NAMA BARANG</h5>
                    <!-- class="search" automagically makes an input a search field. -->
                    <input class="form-control" placeholder="Cari disini..." type="text" id="searchField" onkeyup="filterBarang(this)">
                    <!-- class="sort" automagically makes an element a sort buttons. The date-sort value decides what to sort by. -->
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="penyedia">Barang </label>
                        </div>
                        <div class="col-md-2">
                            <label for="penyedia">Kadaluarsa </label>
                        </div>
                        <div class="col-md-2">
                            <label for="penyedia">Jumlah Tercatat </label>
                        </div>
                        <div class="col-md-2">
                            <label for="penyedia">Jumlah Sebenarnya </label>
                        </div>
                        <div class="col-md-2">
                            <label for="penyedia">Perbedaan </label>
                        </div>
                    </div>
                    <div class="form-items block-content" id="itemsDiv" data-toggle="slimscroll" data-always-visible="true" data-size="8px" data-height="250px">
                        @php $i=0 @endphp
                        @forelse($barang as $row)
                        <div class="row item-wrapper">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h6 class="nama-item">{{$row['nama']}}</h6>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h6>{{date('d F Y', strtotime($row['kadaluarsa']))}}</h6>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h6 id="stok-{{++$i}}">{{$row['tercatat']}}</h6>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h6 id="stok-{{++$i}}">{{$row['sebenarnya']}}</h6>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h6 id="perbedaan-{{$i}}">{{$row['beda']}}</h6>
                                </div>
                            </div>
                        </div>
                        @empty
                            Belum ada barang
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.components2.js')
    @yield('additionaljs')
</body>
<script type="text/javascript">
    function filterBarang(e)
    {
        if(e.value.length < 2) {
            $('.item-wrapper').css('display', '');
            return;
        }

        let filter, container, rows, i, textValue;
        filter = e.value.toLowerCase();

        container = document.getElementById('itemsDiv');
        rows = container.getElementsByClassName('item-wrapper');

        for(i = 0; i < rows.length; i++)
        {
            textValue = rows[i].getElementsByClassName('nama-item')[0].innerText.toLowerCase();
            if(textValue.indexOf(filter) > -1 ) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>
</html>

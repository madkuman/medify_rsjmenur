<!doctype html>
<html lang="en" class="no-focus" ng-app="medifyApp">
<head>
    @include('layouts.components2.header')
</head>
<body>
<div id="page-container" class="main-content-boxed">
    <main id="main-container">
        <div class="row">
            <table width="100%">
                <tr>
                    <td width="5%">
                    <td width="70%" style="text-align:center"><h3>Kelengkapan Konsultasi</h3></td>
                    <td rowspan="2" width="25%">
                        <form action="{{ url()->previous()}}">
                            <button type="submit" class="btn btn-primary btn-square">
                                <i></i> Lewati
                            </button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align:center">(mohon diisi untuk mempermudah diagnosa dokter)</td>
                </tr>
            </table>
            
        </div>
        <div class="content pt-25">

            <div class="row">
                <div class="col-md-12 col-xl-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</div>

@include('layouts.components2.footer')
@include('layouts.components2.js')
</body>
</html>

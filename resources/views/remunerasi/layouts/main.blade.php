<!doctype html>
<html lang="en" class="no-focus" ng-app="medifyApp">
<head>
    @include('layouts.components2.header')
</head>
<body>
    <!-- @include('layouts.components2.svg') -->
    <div id="page-container" class="page-header-fixed main-content-boxed">  
        @include('layouts.components2.navbar')
        <main id="main-container">
            <div class="content pt-20">
                <div class="row">
                    <div class="col-12">
                        @include('remunerasi.layouts.components.sidebar')
                        <div class="mg-t-20">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    @include('layouts.components2.footer')

    {{-- Load scripts --}}
    @include('layouts.components2.js')
    {{-- Custom scripts --}}
    <script src="{{ asset('assets/js/combodate.js') }}"></script>
    <script src="{{ asset('js/kepegawaian/combodateSelect2v1.1.js') }}"></script>
    <script src="{{ asset('js/kepegawaian/rupiahFormatting.js') }}"></script>
    <script src="{{ asset('js/kepegawaian/alert.js') }}"></script>
    {{-- <script>
          // script for prevent submitting using enter 
           // $(document).ready(function(){
          // $("form").bind("keypress", function (e) {
          // 	if (e.keyCode == 13) {
          // 	return false;
          // 	}
          // });
          
          // // responsive pagination
          // $(".pagination").rPage();
          // }); 
          
          window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
      ])!!};
  
      window.App = {
              base: '{{ url('/') }}'
            },
            BASE_URL = (App.base ? App.base : '{{ url('/') }}'),
            AJAX_URL = BASE_URL+'/kepegawaian/ajax'
      ;
    </script> --}}
  
    @yield('script')
    @stack('footer-script')
  
    @include('sweet::alert')
</body>
</html>

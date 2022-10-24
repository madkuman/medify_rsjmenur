<!DOCTYPE html>
<html lang="en" class="no-focus">
<head>
  {{-- Load stylesheets --}}
  @include('layouts.components2.header')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/kepegawaian/custom.css') }}">
  @stack('css')
  {{-- Load stylesheets end --}}
</head>
<body>
  <div id="page-container" class="page-header-fixed main-content-boxed">
    @include('layouts.components2.navbar')
    <main id="main-container">
      @include('kepegawaian.layouts.partials.navbar')
      @yield('content')
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
  <script>
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
  </script>

  @yield('script')
  @stack('footer-script')

  @include('sweet::alert')
  {{-- Load scripts end --}}
</body>
</html>
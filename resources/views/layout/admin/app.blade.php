<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <link rel="stylesheet" href="{{asset('css/plugins/fontawesome-free/css/all.min.css')}}" />
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}" />
  <link rel="stylesheet" href="{{asset('css/plugins/toastr/toastr.css')}}">
  <script src="{{asset('css/plugins/toastr/toastr.min.js')}}"></script>
  <style>
    .popup {
      align-items: center;
      display: none;
      position: fixed;
      height: 100%;
      width: 100%;
      top: 0px;
      left: 0px;
      background: transparent;
      z-index: 1000;
      opacity: 2;
    }

    .popup>.card {
      padding: 20px;
      opacity: 1 !important;
      margin: auto;
      width: 450px;
      border-radius: 10px;
      max-height: 600px;
    }

    .popin {
      width: 400px;
      margin-left: auto;
      height: 100px;
      margin-right: auto;
      margin-top: 100px;
    }

    .imgdiv {
      justify-content: center;
      text-align: center;
    }

    .btn1 {
      width: 140px;
      -webkit-border-radius: 7;
      -moz-border-radius: 7;
      border-radius: 7px;
      font-family: "Courier New";
      color: #000000;
      font-size: 16px;
      background: #ffffff;
      padding: 5px 20px 5px 20px;
      border: solid #000000 1px;
      text-decoration: none;
      margin-top: 17px;
      cursor: pointer;
    }

    .dialog {
      text-align: center;
    }

    .flex {
      display: flex;
    }

    .btn1:hover {
      text-decoration: none;
    }
  </style>
  <style>
/* ==========================================================================           
 *
 *    PRELOADER
 *
 * ========================================================================== */
 #preloader {
  background-color: rgba(255, 255, 255, 0.7);
  height: 100%;
  width: 100%;
  position: fixed;
  margin-top: 0;
  top: 0;
  left: 0;
  bottom: 0;
  overflow: hidden !important;
  right: 0;
  z-index: 999999;
}
#preloader img {
  text-align: center;
  left: 0;
  position: absolute;
  right: 0;
  top: 40%;
  z-index: 99;
  margin: 0 auto;
}

  </style>
  @stack('styles')
</head>

<body class="hold-transition sidebar-mini">
  <div id="preloader">
		<img src="{{asset('uploads/loader.svg')}}" alt="loader">
	</div>
  <div class="wrapper">
    @if(Session::has('success'))
    <script>
      toastr.success("{{Session::get('success')}}", 'Success', {timeOut: 5000, "closeButton": true, "progressBar": true});
    </script>
    @endif
    @if(Session::has('error'))
    <script>
      toastr.error("{{Session::get('error')}}", 'Error', {timeOut: 5000, "closeButton": true, "progressBar": true});
    </script>
    @endif
    @if($errors->any())
    @foreach ($errors->all() as $error)
    <script>
      toastr.error("{{$error}}", 'Error', {timeOut: 5000, "closeButton": true, "progressBar": true});
    </script>
    @endforeach
    @endif
    @include('layout.admin.header')
    @include('layout.admin.sidebar')
    @yield('content')
    @include('layout.admin.footer')
  </div>
  <script src="{{asset('css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('js/adminlte.js')}}"></script>
  <script src="{{asset('js/pages/dashboard3.js')}}"></script>
  @stack('scripts')
  <script>
   
	/*===========================================================================
      *
      *  PAGE LOADING EFFECT
      *
      *============================================================================*/
	$(window).on("load", function(e) {
		$("#preloader").delay(0).fadeOut("slow");
	})

  </script>
</body>

</html>
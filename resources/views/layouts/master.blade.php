<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title> @yield('title') </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="A4jOO51GyICQFeNQPAja1odiObQKpby9ZhVChbFgvsI" />

    @yield('meta')

    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" as="font" crossorigin>
    <link rel="stylesheet" href="https://unpkg.com/@icon/themify-icons/themify-icons.css" crossorigin>
    <link href="{{ mix('css/vendor.bundle.css') }}" rel="stylesheet" async >
    <link href="{{ mix('css/styles.bundle.css') }}" rel="stylesheet" async >

</head>
<body>
<div id="app">
    @yield('content')
</div>
@guest()
<script kis-src="{{ mix('js/scripts.bundle.js') }}"></script>
  <script >var cssloaded=!1;function ready(e){document.addEventListener("DOMContentLoaded",function(){kis_callback(e)})}kis_callback=function(e){"complete"!==document.readyState?setTimeout(function(){kis_callback(e)},500):e()},ready(function(){let e=function(){if(!cssloaded){cssloaded=!0;var e=document.querySelectorAll("[kis-src]");for(let t=0;t<e.length;t++)e[t].setAttribute("src",e[t].getAttribute("kis-src"))}};window.addEventListener("mouseup",e),window.addEventListener("keyup",e),window.addEventListener("scroll",e),window.addEventListener("mouseover",e),window.addEventListener("focus",e),window.addEventListener("touchstart",e)});</script>
@else
    <script src="{{ mix('js/scripts.bundle.js') }}"></script>
    @include('sweetalert::alert')
@endguest
@stack('scripts')
@if(\Illuminate\Support\Facades\App::environment() != "local")
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5MW4XKJ');</script>
<!-- End Google Tag Manager -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5MW4XKJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
   
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60c8bedb65b7290ac6361623/1f882j316';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
   
@endif
</body>
</html>

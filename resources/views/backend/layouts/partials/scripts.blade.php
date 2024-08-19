{{-- <!-- jquery latest version -->
<script src="{{ asset('backend/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
<!-- bootstrap 4 js -->
<script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery.slicknav.min.js') }}"></script>

<!-- start chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<!-- start highcharts js -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- start zingchart js -->
<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
<script>
zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
</script>
<!-- all line chart activation -->
<script src="{{ asset('backend/assets/js/line-chart.js') }}"></script>
<!-- all pie chart -->
<script src="{{ asset('backend/assets/js/pie-chart.js') }}"></script>
<!-- others plugins -->
<script src="{{ asset('backend/assets/js/plugins.js') }}"></script>
<script src="{{ asset('backend/assets/js/scripts.js') }}"></script> --}}

<script type="text/javascript" src="{{ asset('backend/files/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/popper.js/dist/umd/popper.min.js') }}">
</script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/bootstrap/dist/js/bootstrap.min.js') }}">
</script>
<script type="text/javascript"
    src="{{ asset('backend/files/bower_components/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/modernizr/modernizr.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('backend/files/bower_components/modernizr/feature-detects/css-scrollbars.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/i18next/i18next.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('backend/files/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('backend/files/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js') }}">
</script>
<script type="text/javascript"
    src="{{ asset('backend/files/bower_components/jquery-i18next/jquery-i18next.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/assets/js/common-pages.js') }}"></script>

<!-- DASHBOARD-->
<script type="text/javascript" src="{{ asset('backend/files/bower_components/chart.js/dist/Chart.js') }}"></script>
<script src="{{ asset('backend/files/assets/pages/widget/amchart/amcharts.js') }}"></script>
<script src="{{ asset('backend/files/assets/pages/widget/amchart/serial.js') }}"></script>
<script src="{{ asset('backend/files/assets/pages/widget/amchart/light.js') }}"></script>


<!-- CUSTOMIZE-->
<script src="{{ asset('backend/files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('backend/files/assets/js/SmoothScroll.js') }}"></script> --}}
<script src="{{ asset('backend/files/assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('backend/files/assets/js/vartical-layout.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/assets/pages/dashboard/custom-dashboard.js') }}"></script>
<script src="{{ asset('backend/files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/assets/js/script.min.js') }}"></script>

@include('sweetalert::alert')
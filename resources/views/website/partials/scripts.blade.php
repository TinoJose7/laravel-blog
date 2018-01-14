<script src=/website/assets/lib/components-modernizr/modernizr.js></script>
<script src=/website/assets/lib/jquery/dist/jquery.js></script>
<script src=/website/assets/lib/bootstrap/dist/js/bootstrap.js></script>

<script src=/website/assets/lib/imagesloaded/imagesloaded.pkgd.min.js></script>
<script src=/website/assets/lib/isotope/dist/isotope.pkgd.min.js></script>
<script src=/website/assets/lib/owlcarousel/owl-carousel/owl.carousel.js></script>
<script src=/website/assets/lib/waypoints/lib/jquery.waypoints.min.js></script>
<script src=/website/assets/lib/waypoints/lib/shortcuts/inview.min.js></script>
<script src=/website/assets/lib/FlexSlider/jquery.flexslider.js></script>
<script src=/website/assets/lib/simple-text-rotator/jquery.simple-text-rotator.js></script>
<script src=/website/assets/lib/jquery.mb.YTPlayer/dist/jquery.mb.YTPlayer.min.js></script>
<script src=/website/assets/lib/magnific-popup/dist/jquery.magnific-popup.js></script>
<script src=/website/assets/js/main.js></script>
<!-- datepicker -->
<script src="/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Sweet Alert-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
$(function () {
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false
    // });
  });
</script>
<!--[if lt IE 10]>
<script>
$('input, textarea').placeholder();
</script>
<![endif]-->
@stack('scripts')

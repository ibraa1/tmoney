
<script>
    var userId = <?php echo json_encode(Auth::user()->id); ?>;
    var userPays = <?php echo json_encode(Auth::user()->pays->nom); ?>;
</script>








<script src="{{ asset('assets/vendor/masonry-layout/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/flatpickr/plugins/monthSelect/index.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor/wnumb/wNumb.min.js') }}"></script>
<script src="{{ asset('assets/vendor/nouisliderribute/nouislider.min.js') }}"></script>
<script src="{{ asset('assets/vendor/blueimp-file-upload/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('assets/vendor/blueimp-load-image/js/load-image.all.min.js') }}"></script>

<script src="{{ asset('assets/vendor/blueimp-file-upload/js/jquery.fileupload-validate.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('assets/javascript/pages/colorpicker-demo.js') }}"></script>
<script src="{{ asset('assets/javascript/pages/uploader-demo.js') }}"></script>
<script src="{{ asset('assets/javascript/pages/slider-demo.js') }}"></script>

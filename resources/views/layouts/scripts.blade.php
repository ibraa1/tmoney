
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/stacked-menu/js/stacked-menu.min.js') }}"></script>
<script src="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/vendor/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/vendor/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>


{{-- <script src="{{ asset('assets/javascript/pages/dashboard-demo.js') }}"></script> --}}


<script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/javascript/theme.min.js') }}"></script>
<script src="{{ asset('assets/javascript/pages/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/javascript/pages/datatables-demo.js') }}"></script>



<script src="{{ asset('assets/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

<script src="{{ asset('assets/vendor/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bs-stepper/js/bs-stepper.min.js') }}"></script>
<script src="{{ asset('assets/javascript/pages/steps-demo.js') }}"></script>




<script>
    var userId = <?php echo json_encode(Auth::user()->id); ?>;
    var userPays = <?php echo json_encode(Auth::user()->pays->nom); ?>;
</script>

<script src="{{ asset('assets/vendor/sortablejs/Sortable.min.js') }}"></script>

<script src="{{ asset('assets/javascript/tmoney.js') }}"></script>


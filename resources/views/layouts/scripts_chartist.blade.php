<!--  Chartist Plugin  -->
<script src="{{ asset('assets/js/plugins/chartist.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
        demo.initVectorMap();

    });
</script>
<script>
    const chartPDCData = <?php echo json_encode($dataPDC); ?>;
    const chartCData = <?php echo json_encode($dataC); ?>;
</script>

<?php include("_header.php") ?>
<script>
    $(document).ready(function() {
        $.post("<?php echo site_url('dashboard/getDays') ?>", { startDate: "<?php echo $startDate->format('Y-m-d') ?>", endDate: "<?php echo $endDate->format('Y-m-d') ?>" },
            function(data){
              $('#days_area').html(data);
            }, "html");
    });
</script>
<div id="days_area"></div>

<?php include("_footer.php") ?>
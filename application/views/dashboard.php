<?php include("_header.php") ?>
<script>
    $(document).ready(function() {
        $.post("<?php echo site_url('dashboard/getDays') ?>", { startDate: "2012-01-01", endDate: "2012-01-07" },
            function(data){
              $('#days_area').html(data);
            }, "html");
    });
</script>
<div id="days_area"></div>

<?php include("_footer.php") ?>
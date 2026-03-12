<?php
    $pluginImagePath  = trailingslashit(plugins_url());
    $id=$_GET['id'];
    global $wpdb;
    $table_name = $wpdb->prefix . 'critters_form_details';
    $rows = $wpdb->get_results("SELECT * from $table_name where id=$id");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo  $pluginImagePath."critters_plugin/css/style.css"; ?>">
<style>
    .pdf_main_section{
        width:100%;
    }
</style>
    <?php foreach ($rows as $row) { ?>
    <div class="pdf_main_section">
        <iframe src="<?php echo $pluginImagePath."critters_plugin/src/pdf1/".$row->pdf_name; ?>" width="90%" height="500px">
    </div>
    <?php } ?>
    
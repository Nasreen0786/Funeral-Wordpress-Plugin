<?php



    $pluginImagePath  = trailingslashit(plugins_url());



    $id=$_GET['id'];



    global $wpdb;



    $table_name = $wpdb->prefix . 'critters_form_response';



    $rows = $wpdb->get_results("SELECT * from $table_name where critters_form_detail_id	=$id");



    $fun_table_name = $wpdb->prefix . 'critters_form_details';



    $fun_det = $wpdb->get_results("SELECT * from $fun_table_name where id=$id");

    $url = home_url()."/wp-admin/admin.php?page=critter_details";

?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="<?php echo  $pluginImagePath."critters_plugin/css/style.css"; ?>">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


<div class="pdf_section" id="contentToPrint">

   <?php foreach ($fun_det as $data) { ?>
    <?php $name = $data->name;?>
<div class="main_section_pdf">
    <div class="pdf_section_content">
    <?php if($data->file_name){ ?>
      <img src="<?php echo $pluginImagePath."critters_plugin/src/image1/". $data->file_name; ?>" width="300" height="300">
      <?php }else{ ?><img src="<?php echo $pluginImagePath."critters_plugin/src/image1/candle/Candle.jpg"; ?>" width="300" height="300">
        <?php } ?>
      <!-- <img class="person_img" src="<?php //echo $pluginImagePath."critters_plugin/src/image1/". $data->file_name; ?>" width="300" ><br><br> <br><br> -->

    <h1 class="critter_detail">ROUWREGISTER</h1><br>
    <h1 class="critter_detail1"><?php echo $data->name;?></h1>
    </div>

  

   <?php } ?> 
   <?php
   $get_logo = esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] );
   
   
   ?>
<div class="pdf_section_logo">
    
<img class ="site_logo" src="<?php echo $get_logo;  ?>" width="100%" ><br><br>
</div>
</div><br><br><br><br><br><br><br><br>
   <form class="form">  

 
    <?php foreach ($rows as $row) { ?>
    <div class="main_res_message_section">
        <div class="quation_section">
            <!-- <i class="fa fa-quote-left" aria-hidden="true"></i> -->
            <img src="<?php echo $pluginImagePath."critters_plugin/src/image1/candle/fff.png"; ?>" width="20" height="20">
        </div>
        <div class="res_message_section">
        <?php
            $data_name = $row->name;;
            $data_name = ucfirst(strtolower($data_name));
            // echo $data_name;
            ?>
            <p><?php echo ($data_name); ?></p>
            <hr>
            <p><?php echo $row->email; ?></p>
            <p><?php echo $row->site; ?></p>
            <?php
                // $datetime = $row->Current_date;
                // $getOnlyDate = date('Y-m-d',strtotime($datetime));
                $datum=date("d F Y", strtotime($row->Current_date));
                $lang = array();
                $lang['en'] = ['january','february','march','april','may','june','july','august','september','october','november','december'];
                $lang['nl'] = ['januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december'];
                $lan_dutch= ucfirst(str_replace($lang['en'], $lang['nl'], strtolower($datum)));
                // echo $getOnlyDate;
            ?>
            <p><?php echo $lan_dutch;?></p>
            <?php
            $data = $row->response;;
            $data = ucfirst(strtolower($data));
            // echo $data;
            ?>
            <p><?php echo $data; ?></p>
        </div>
    </div><br>
    <?php } ?>

<!-- <input type="button" id="create_pdf" value="Save">   -->



    </form>  
    <button id="myButton" onclick="Convert_HTML_To_PDF();">Convert HTML to PDF</button>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
window.jsPDF = window.jspdf.jsPDF;
function Convert_HTML_To_PDF() {
    var doc = new jsPDF();
    var elementHTML = document.querySelector("#contentToPrint");
    doc.html(elementHTML, {
        callback: function(doc) {
            doc.save('<?php echo $name; ?>.pdf');
        },
        margin: [19.2, 15, 20.2, 13],
        autoPaging: 'text',
        x: 0,
        y: 3,
        width: 190,
        windowWidth: 675
    });
}
window.onload = function() {
  var myButton = document.getElementById("myButton");
  myButton.click();
  setTimeout(function() {
    window.location.href = "<?php echo $url; ?>";
  }, 2000); 
}

</script>
<style type="text/css">
    .pdf_section{
        background-color: #fff !important;
    }
</style>
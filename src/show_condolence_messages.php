<?php



    $pluginImagePath  = trailingslashit(plugins_url());



    $id=$_GET['id'];



    global $wpdb;



    $table_name = $wpdb->prefix . 'critters_form_response';



    $rows = $wpdb->get_results("SELECT * from $table_name where critters_form_detail_id	=$id");



    $fun_table_name = $wpdb->prefix . 'critters_form_details';



    $fun_det = $wpdb->get_results("SELECT * from $fun_table_name where id=$id");

    $url = home_url()."/rouwberichten-condoleren";

?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="<?php echo  $pluginImagePath."critters_plugin/css/style.css"; ?>">



<div class="pdf_section">

   <?php foreach ($fun_det as $data) { ?>
<div class="main_section_pdf">
    <div class="pdf_section_content"> 
      <img class="person_img" src="<?php echo $pluginImagePath."critters_plugin/src/image1/". $data->file_name; ?>" width="300" ><br><br> <br><br>
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
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
   <form class="form">  

 
    <?php foreach ($rows as $row) { ?>
    <div class="main_res_message_section">
        <div class="quation_section">
            <i class="fa fa-quote-left" aria-hidden="true"></i>
        </div>
        <div class="res_message_section">
            <h1><?php echo $row->name; ?></h1>

            <?php
                $datetime = $row->Current_date;
                $getOnlyDate = date('Y-m-d',strtotime($datetime));

                // echo $getOnlyDate;
            ?>
            <p><?php echo $getOnlyDate;?><br></p>
            <p class="response"><?php echo $row->response; ?></p>
        </div>
    </div><br>
    <?php } ?>

<input type="button" id="create_pdf" value="Save">  



    </form>  

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://parall.ax/parallax/js/jspdf.js"></script>



<script>


$(document).ready(function () {  


     setTimeout(function(){



        $('#create_pdf').trigger('click');



      }, 700);

              setTimeout(function(){

        window.location.href = "<?php echo $url; ?>";

        }, 1500);



    var form = $('.pdf_section'),  



    cache_width = form.width(),  



    a4 = [595.28, 841.89]; // for a4 size paper width and height  



    

    





    $('#create_pdf').on('click', function () {  



        $('body').scrollTop(0);  



        createPDF();  



    });  



    

//create pdf
   function createPDF() {
     getCanvas().then(function(canvas) {
       var imgWidth = 200;
       var pageHeight = 290;
       var imgHeight = canvas.height * imgWidth / canvas.width;
       var heightLeft = imgHeight;
       var doc = new jsPDF('p', 'mm');
       var position = 0;

       var img = canvas.toDataURL("image/jpeg");




 doc.addImage(img, 'JPEG', 0, position, imgWidth, imgHeight);
   heightLeft -= pageHeight;



   while (heightLeft >= 0) {
     position = heightLeft - imgHeight;
     doc.addPage();
     doc.addImage(img, 'JPEG', 0, position, imgWidth, imgHeight);
     heightLeft -= pageHeight;
   }


   doc.save('Report.pdf');
   form.width(cache_width);
  });
 }


 // create canvas object
   function getCanvas() {
     form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');
     return html2canvas(form, {
       imageTimeout: 2000,
       removeContainer: false
     });
   }

});
</script>
<style type="text/css">
    .pdf_section{
        background-color: #fff !important;
    }
</style>
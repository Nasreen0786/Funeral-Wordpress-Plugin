<?php
global $wpdb;
unset ($_SESSION["submit_status"]);
$url = home_url()."/rouwberichten-condoleren";
$url_detail = home_url()."/critters-detail-page";
$captcha_table_name = $wpdb->prefix . 'critters_form_api_secret_key';
$captcha_result = $wpdb->get_results("SELECT * FROM $captcha_table_name ORDER BY id DESC LIMIT 1");
foreach ($captcha_result as $captcha_row) {
    $api_key=$captcha_row->api_key;
    $secret_site_key=$captcha_row->secret_key;
    $site_key = trim($api_key, "'\"");
    $secret_key = trim($secret_site_key, "'\"");
}
echo "<br>";
    if(isset($_POST['submit'])){
        
        $secret = $secret_key;
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=".$_POST["g-recaptcha-response"];
        $verify = json_decode(file_get_contents($url));
        if (!$verify->success) { $error = "Invalid captcha"; }
        $plugin_path  = trailingslashit( plugin_dir_path( __FILE__ ) ); 
        $target_dir = $plugin_path.'/image1';
        $pdf_path = $plugin_path.'/pdf1';
        $files = $_FILES['fun_image']['name'];
        $pdf_name = $_FILES['pdf_file']['name'];
        $target_file = $target_dir . date("dmYhis") . basename($_FILES["fun_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($files,PATHINFO_EXTENSION);
    $data = $plugin_path.'/image1'.'/'.$files;
        if($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg" || $imageFileType != "gif") {
            if (move_uploaded_file($_FILES["fun_image"]["tmp_name"], $target_dir.'/'.$files) || move_uploaded_file($_FILES["pdf_file"]["tmp_name"], $pdf_path.'/'.$pdf_name)) {
                $data = array(
                    'title' => $_POST['title'],
                    'name' => $_POST['fun_name'],
                    'geboren_stad' => $_POST['fun_geboren_stad'],
                    'overleden_stad' => $_POST['fun_overleden_stad'],
                    'gender' => $_POST['fun_gender'],
                    'status' => $_POST['fun_status'],
                    'status_cat' => $_POST['fun_status_cat'],
                    'other_status' => $_POST['fun_other_status'],
                    'other_status_val' => $_POST['fun_other_status_val'],
                    'date_of_birth' => $_POST['fun_date_of_birth'],
                    'date_of_burial' => $_POST['fun_date_of_burial'],
                    'dead_in' => $_POST['fun_dead_in'],
                    'critter_info' => $_POST['fun_critter_info'],
                    'file_name' => $files,
                    'pdf_name' => $pdf_name
                );
                $table_name = $wpdb->prefix . "critters_form_details";
                $wpdb->insert($table_name,$data);
                     echo $url = home_url()."/rouwberichten-condoleren";
                    wp_redirect($url);
            } else {
                //echo "<a href='$url_detail'>Upload een bestand.... Klik hier !</a>";
                $data = array(
                    'title' => $_POST['title'],
                    'name' => $_POST['fun_name'],
                    'geboren_stad' => $_POST['fun_geboren_stad'],
                    'overleden_stad' => $_POST['fun_overleden_stad'],
                    'gender' => $_POST['fun_gender'],
                    'status' => $_POST['fun_status'],
                    'status_cat' => $_POST['fun_status_cat'],
                    'other_status' => $_POST['fun_other_status'],
                    'other_status_val' => $_POST['fun_other_status_val'],
                    'date_of_birth' => $_POST['fun_date_of_birth'],
                    'date_of_burial' => $_POST['fun_date_of_burial'],
                    'dead_in' => $_POST['fun_dead_in'],
                    'critter_info' => $_POST['fun_critter_info']
                ); 
                $table_name = $wpdb->prefix . "critters_form_details";
                $wpdb->insert($table_name,$data);
                     echo $url = home_url()."/rouwberichten-condoleren";
                    wp_redirect($url);
            }
        }else {
            echo "File Not Supported";
            exit;
        }
    }
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <?php
        global $wpdb;
        $table_name = $wpdb->prefix . 'change_color';
        $result = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC LIMIT 1");
    ?>
    <style>
        #redirect_page{
            <?php foreach ($result as $row) { ?>
                border-color:<?php echo $row->color; ?> !important;
                background : <?php echo $row->color; ?> !important;
            <?php } ?>
        }
        #redirect_form > div > form > input.Condolences{
            <?php foreach ($result as $row) { ?>
                border-color:<?php echo $row->color; ?> !important;
                background : <?php echo $row->color; ?> !important;
            <?php } ?>
        }
    </style>
    <div class="container">
        <form method="post" action="<?php the_permalink(); ?>" enctype="multipart/form-data">
             <span class="rsvp_success_msg"><?php echo (isset($_SESSION['submit_status']))? $_SESSION['submit_status']:''; ?></span>
              <h1 class="critters_heading">Informatie over begrafenissen</h1>
              <div class="form_inner_data">
               <label class="inner_content">Naam</label>
              <select class="inner_name_select" name="title"><option value="">Selecteer er een</option><option value="de heer">de heer</option><option value="mevrouw">mevrouw</option></select>&nbsp;&nbsp;<input type="text" name="fun_name" class="inner_output_name" placeholder="Naam">
                   <br>
                   <label class="inner_content">Geslacht</label>
                   <input type="radio" name="fun_gender" value="Mannelijk">   Mannelijk
                   &nbsp;&nbsp;&nbsp;
                   <input type="radio" name="fun_gender" value="Vrouw">   Vrouw
                   <br>
                   
                   <label class="inner_content">Burgerlijke Staat</label>
                   <select name="fun_status" id="choose" class="inner_output">
                    <option value="">Selecteer er een</option>
                   <option value="Partner van">Partner van</option>
                   <option value="Levensgezellin van" class="born">Levensgezellin van</option>
                   <option value="Zoon van">Zoon van</option>
                   <option value="Dochter van">Dochter van</option>
                   <!-- <option value="Weduwnaar van">Weduwnaar van</option> -->
                   <option value="weduwe van">weduwe van</option>
                   <option value="weduwnaar van">weduwnaar van</option>
                   <option value="echtgenoot van">echtgenoot van</option>
                   <option value="echtgenote van">echtgenote van</option>
                   <!-- <option value="Alleenstaande">Alleenstaande</option> -->
                   </select>
                   <br>
                   <input type="text" id="input_field" class="inner_output_fun" name="fun_status_cat" placeholder="Voer de status in">
                   <br>
                   <label class="inner_content">Andere status</label>
                   <select name="fun_other_status" id="choose_status" class="inner_output">
                   <option value="">Selecteer er een</option>
                   <option value="Mama van">Mama van</option>
                   <option value="Papa van" class="born">Papa van</option>
                   <option value="Moeke van">Moeke van</option>
                   <option value="Vake van">Vake van</option>
                   <option value="Zoon van">Zoon van</option>
                   <option value="Dochter van">Dochter van</option>
                   </select><br>
                   <input type="text" id="input_status" class="inner_output_fun" name="fun_other_status_val" placeholder="Voer een andere status in">
                   <br>
                   <label class="inner_content">Geboortedatum</label>
                   <input type="date" name="fun_date_of_birth" class="inner_output" placeholder="Geboortedatum">
                   <br>
                    <label class="inner_content">Geboorteplaats</label>
                   <input type="text" name="fun_geboren_stad" class="inner_output" placeholder="Geboorteplaats">
                   <br>
                   <label class="inner_content">overleden op</label>
                   <input type="date" name="fun_dead_in" class="inner_output" placeholder="overleden op">
                   <br>
                   <label class="inner_content">Overlijdensplaats</label>
                   <input type="text" name="fun_overleden_stad" class="inner_output" placeholder="Overlijdensplaats">
                   <br>
                   <label class="inner_content">Datum begrafenis</label>
                   <input type="date" name="fun_date_of_burial" class="inner_output"  placeholder="Datum begrafenis">
                   <br>
                   <label class="inner_content critter_text">Begrafenis informatie</label>
                   <textarea class="inner_output_textarea" name="fun_critter_info" placeholder="Begrafenis informatie"></textarea>
                   <br>
                   <div class="choose_file">
                   <label class="inner_content critters_text">Selecteer afbeelding</label>
                   <input type="file" name="fun_image" class="img_display file_pos"  id="file"  onchange="readURL(this);" multiple>
                   <img id="show_img" src="" alt=""></div><br>
                   <label class="inner_content critters_text">Gelieve pdf te uploaden</label>
                   <input type="file" name="pdf_file" class="file_pos form-control" accept=".pdf" title="Upload PDF"/>
                   <center><div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div></center><br>
                   <div class="save_form"><input type='submit' id="redirect_page" name='submit' value='Indienen' class="btn btn-primary"></div>
        </form>
  </div>
  <script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#show_img')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
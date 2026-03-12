<?php
global $wpdb;
    $pluginImagePath  = trailingslashit(plugins_url());
    $id=$_GET['id'];
    $url = home_url()."/wp-admin/admin.php?page=critter_details";
    $table_name = $wpdb->prefix . 'critters_form_details';
    $rows = $wpdb->get_results("SELECT * from $table_name where id=$id");
    if(isset($_POST['submit'])){
		$files = $_FILES['fun_image']['name'];
        $pdf_name = $_FILES['pdf_file']['name'];
        if ($_FILES['fun_image']['error']==4){
            $files =  $_POST['hiddenname']; 
        }
        else{
        $files = $_FILES['fun_image']['name'];
        }
        if ($_FILES['pdf_file']['error']==4){
            $pdf_name =  $_POST['pdfhiddenname']; 
            }
            else{
                $pdf_name = $_FILES['pdf_file']['name'];
        }
        $check_pdf = move_uploaded_file($_FILES["pdf_file"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"].'/wp-content/plugins/critters_plugin/src/pdf1/'.$pdf_name);
        $check = move_uploaded_file($_FILES["fun_image"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"].'/wp-content/plugins/critters_plugin/src/image1/'.$files);
        if($check == true){
            $wpdb->update( 
                $table_name, 
                array( 
                'title' => $_POST['title'],
                'name' => $_POST['fun_name'],
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
                ), 
                array( 'ID' => $id )
            );
            wp_redirect($url);
        }elseif($check_pdf == true){
            $wpdb->update( 
                $table_name, 
                array( 
                'title' => $_POST['title'],
                'name' => $_POST['fun_name'],
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
                ), 
                array( 'ID' => $id )
            );
            wp_redirect($url);
        }else{
            $wpdb->update( 
                $table_name, 
                array( 
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
                ), 
                array( 'ID' => $id )
            );
            wp_redirect($url);
        }
    }
?>
   <link rel="stylesheet" type="text/css" href="<?php echo  $pluginImagePath."critters_plugin/css/style.css"; ?>">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="container">
        <form method="post" action="<?php the_permalink(); ?>" enctype="multipart/form-data">
            <a href="<?php echo home_url().'/wp-admin/admin.php?page=critter_details'?>">Terug naar de detailpagina</a>
             <span class="rsvp_success_msg"><?php echo (isset($_SESSION['submit_status']))? $_SESSION['submit_status']:''; ?></span>
            <h1 class="critter_detail">Begrafenisinformatie bewerken - Hier bewerken:</h1>
            <?php foreach ($rows as $row) { ?>
            <div class="form_inner_data">
            <label class="inner_content">Naam</label>
            <select class="inner_name_select" name="title" value="<?php echo $row->title;?>"><option value="">Selecteer er een</option><option value="de heer">de heer</option><option value="mevrouw">mevrouw</option></select>&nbsp;&nbsp;<input type="text" name="fun_name" value="<?php echo $row->name; ?>" class="inner_output_name_update" placeholder="Naam">
            <br>
            <label class="inner_content">Geslacht</label>
            <?php ?>
            <?php  
            $tset = $row->gender;
             if($tset == 'Mannelijk' ){ ?>
                <input type="radio" name="fun_gender" value="Mannelijk" checked>Mannelijk&nbsp;&nbsp;&nbsp;
                <input type="radio" name="fun_gender" value="Vrouw">Vrouw
            <?php 
             }else{ ?>
                <input type="radio" name="fun_gender" value="Mannelijk" >Mannelijk&nbsp;&nbsp;&nbsp;
                <input type="radio" name="fun_gender" value="Vrouw" checked>Vrouw
            <?php
             } ?>
            <br>
            <label class="inner_content">burgelijkestand</label>
            <select name="fun_status" id="choose" class="inner_output">
                <?php if(!empty($row->status)) {?>
                    <option value='<?php echo $row->status;?>'><?php echo $row->status;?></option>
                <?php } ?>
                <option value=''>Selecteer er een</option>
                <option value="Weduwe van">Weduwe van</option>
                <option value="Echtgenoot van" class="born">Echtgenoot van</option>
                <option value="Levensgezel van">Levensgezel van</option>
                <option value="Echtgenote van">Echtgenote van</option>
                <option value="Weduwnaar van">Weduwnaar van</option>
                <option value="Alleenstaande">Alleenstaande</option>
            </select><br>
                <input type="text" id="input_field" value="<?php echo $row->status_cat; ?>" class="inner_output_fun_update" name="fun_status_cat">
            <br>
            <label class="inner_content">Andere status</label>
            <select name="fun_other_status" id="choose_status" class="inner_output">
                <?php if(!empty($row->other_status)) {?>
                    <option value='<?php echo $row->other_status;?>'><?php echo $row->other_status;?></option>
                <?php } ?>
                <option value=''>Selecteer er een</option>
                <option value="Partner van">Partner van</option>
                <option value="Lieve partner van" class="born">Lieve partner van</option>
                <option value="Engelbewaarder">Engelbewaarder</option>
                <option value="Vader van">Vader van</option>
                <option value="Moeder van">Moeder van</option>
            </select><br>
                <input type="text" id="input_status" class="inner_output_fun_update2" value="<?php echo $row->other_status_val; ?>" name="fun_other_status_val">
            <br>
            <?php
                $datum=date("d-F-Y", strtotime($row->date_of_birth));
                $datum1=date("d-F-Y", strtotime($row->date_of_burial));
                $datum2=date("d-F-Y", strtotime($row->dead_in));
                $lang = array();
                $lang['en'] = ['january','february','march','april','may','june','july','august','september','october','november','december'];
                $lang['nl'] = ['januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december'];
                $lan_dutch= ucfirst(str_replace($lang['en'], $lang['nl'], strtolower($datum)));
                $lan_dutch1= ucfirst(str_replace($lang['en'], $lang['nl'], strtolower($datum1)));
                $lan_dutch2= ucfirst(str_replace($lang['en'], $lang['nl'], strtolower($datum2)));
                //echo $lan_dutch;
            ?>
            <label class="inner_content">Geboortedatum </label>
            <input type="date" name="fun_date_of_birth" class="inner_output" value="<?php echo $row->date_of_birth; ?>" placeholder="Geboortedatum">
            <br>
            <label class="inner_content">Geboorteplaats </label>
            <input type="text" name="fun_geboren_stad" class="inner_output" value="<?php echo $row->geboren_stad; ?>" placeholder="Geboorteplaats">
            <br>
            <label class="inner_content">Datum begrafenis</label>
            <input type="date" name="fun_date_of_burial" class="inner_output" value="<?php echo $row->date_of_burial; ?>" placeholder="Datum begrafenis">
            <br>
            <label class="inner_content">Overleden op</label>
            <input type="date" name="fun_dead_in" class="inner_output" value="<?php echo $row->dead_in; ?>" placeholder="Overleden op">
            <br>
            <label class="inner_content">Overlijdensplaats</label>
            <input type="text" name="fun_overleden_stad" class="inner_output" value="<?php echo $row->overleden_stad; ?>" placeholder="Overlijdensplaats">
            <br>
            <label class="inner_content critter_text">Begrafenis informatie</label>
            <textarea class="inner_output_textarea" name="fun_critter_info" placeholder="Begrafenis informatie"><?php echo $row->critter_info;; ?></textarea>
            <br>
            <div class="choose_file">
            <!-- <img name="show_img1" src="<?php //echo $pluginImagePath.'critters_plugin/src/image1/'. $row->file_name; ?>" alt=""> -->
            <!-- <p><?php //echo $row->file_name; ?></p> -->
            <input type="text" name="hiddenname" class="inner_output" value="<?php echo $row->file_name; ?>" hidden>
            <label class="inner_content critters_text">Selecteer afbeelding</label>
            <input type="file" name="fun_image" value="<?php echo $pluginImagePath.'critters_plugin/src/image1/'. $row->file_name; ?>" class="img_display file_pos" id="file" onchange="readURL(this);" multiple>
            <img id="show_img" src="" alt=""></div><br>
            <input type="text" name="pdfhiddenname" class="inner_output" value="<?php echo $row->pdf_name; ?>" hidden>
            <label class="inner_content critters_text">Gelieve pdf te uploaden</label>
            <input type="file" name="pdf_file" value="<?php echo $pluginImagePath.'critters_plugin/src/pdf1/'. $row->pdf_name; ?>" class="img_display file_pos" id="file" class="form-control" accept=".pdf" title="Upload PDF"/>
            <div class="save_form"><a href="" ></a><input type='submit' id="redirect_page" name='submit' value='Update hier'></div>
            <?php } ?>
        </form>
    </div>
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
    
    // $(document).ready(function(){
    //     $("#redirect_page").click(function(){
    //         setTimeout(function(){
    //             window.location.href = "<?php echo $url; ?>";
    //         }, 1000);
    //     });
    // });
</script>
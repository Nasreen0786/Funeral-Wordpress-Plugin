<?php   
    $pluginImagePath  = trailingslashit(plugins_url());
    $id=$_GET['id'];
    global $wpdb;
    $captcha_table_name = $wpdb->prefix . 'critters_form_api_secret_key';
    $captcha_result = $wpdb->get_results("SELECT * FROM $captcha_table_name ORDER BY id DESC LIMIT 1");
    foreach ($captcha_result as $captcha_row) {
        $api_key=$captcha_row->api_key;
        $secret_site_key=$captcha_row->secret_key;
        $site_key = trim($api_key, "'\"");
        $secret_key = trim($secret_site_key, "'\"");
    }
unset ($_SESSION["submit_status"]);
echo "<br>";
            // Insert REsponse form data
    if(isset($_POST['submit'])){
 $secret =  $secret_key;
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=".$_POST["g-recaptcha-response"];
        $verify = json_decode(file_get_contents($url));
        if (!$verify->success) { $error = "Invalid captcha"; }
        $data = array(
            'name' => $_POST['res_name'],
            'email' => $_POST['res_email'],
            'site' => $_POST['res_site'],
            'response' => $_POST['res_response'],
            'critters_form_detail_id' => $_POST['hidden_id']
        );
        $table_name = $wpdb->prefix . "critters_form_response";
        $result = $wpdb->insert($table_name,$data);
        if($result){
            $_SESSION['submit_status'] = "Bedankt voor uw bericht. Wij waarderen uw reactie..";
        }else{
            $_SESSION['submit_status'] = "Sorry, een fout. Vul het formulier opnieuw in."; 
        }
    }
    $table_name = $wpdb->prefix . 'critters_form_details';
    $rows = $wpdb->get_results("SELECT * from $table_name where id=$id");
?>
    <?php
    global $wpdb;
    $table_name = $wpdb->prefix . 'change_color';
    $result = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC LIMIT 1");
?>
<style>
    .show_response {
        <?php foreach ($result as $row) { ?>
            background : <?php echo $row->color; ?>;
        <?php } ?>
    }
    .mourning_letter{
        <?php foreach ($result as $row) { ?>
            background : <?php echo $row->color; ?>;
        <?php } ?>
    }
    .btn {
        <?php foreach ($result as $row) { ?>
        background : <?php echo $row->color; ?>;
        <?php } ?>
    }
    #redirect_form > div > form > input.Condolences{
        margin-right: 104px;
        <?php foreach ($result as $row) { ?>
        background : <?php echo $row->color; ?>;
        /*border-color:<?php echo $row->color; ?> !important;*/
        <?php } ?>
    }
    #redirect_form > div > form > font > font > input{
        <?php foreach ($result as $row) { ?>
        background : <?php echo $row->color; ?>;
        /*border-color:<?php echo $row->color; ?> !important;*/
        <?php } ?>
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>

   <ol id='list'>



    <?php foreach ($rows as $row) { ?>



        <li class="critter" style="list-style:none;"> 



            <div class="container">



                <div class="main_content">



                      <span class="rsvp_success_msg"><?php echo (isset($_SESSION['submit_status']))? $_SESSION['submit_status']:''; ?></span>



                    <div class="left_section">



                        <!-- <img src="<?php //echo $plugin_path."image1/". $row->file_name;?>" class="deceased_img" width="200" height="200"> -->



                        <?php if($row->file_name){ ?><img src="<?php echo $pluginImagePath."critters_plugin/src/image1/". $row->file_name; ?>" width="300" height="300"><?php }else{ ?><img src="<?php echo $pluginImagePath."critters_plugin/src/image1/candle/Candle.jpg"; ?>" width="300" height="300"><?php } ?>



                    </div>



                    <div class="right_section">



                        <ol class="show_data">



                            <li>



                                <h3 class="deceased_title"><a href="<?php echo admin_url('show-critter-details?id=' . $row->id); ?>"><?php echo $row->name; ?></a></h3>



                            </li>

                            <?php if(!empty($row->status)){?>
                            
                            <li class="list_bottom"><span class="deceased_header"><?php echo $row->status; ?></span><span class="deceased_boady"><?php echo $row->status_cat; ?></span>



                            </li>
                            <?php } ?>
                            <?php if(!empty($row->other_status)){?>

                            <li class="list_bottom"><span class="deceased_header"><?php echo $row->other_status; ?></span><span class="deceased_boady"><?php echo $row->other_status_val; ?></span></li>
                            <?php } ?>
                            <!-- <li class="list_bottom"><span class="deceased_header">Geboren te: </span>  <span class="deceased_boady"><?php //echo $row->geboren_stad; ?></span>  <span class="deceased_boady"><?php //echo $row->stad; ?></span>  <span class="deceased_boady"><?php //echo date("d-F-Y", strtotime($row->date_of_birh)); ?></span></li> -->
                            <?php
                                $datum=date("d F Y", strtotime($row->date_of_birth));
                                $datum1=date("d F Y", strtotime($row->date_of_burial));
                                $datum2=date("d F Y", strtotime($row->dead_in));
                                $lang = array();
                                $lang['en'] = ['january','february','march','april','may','june','july','august','september','october','november','december'];
                                $lang['nl'] = ['januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december'];
                                $lan_dutch= ucfirst(str_replace($lang['en'], $lang['nl'], strtolower($datum)));
                                $lan_dutch1= ucfirst(str_replace($lang['en'], $lang['nl'], strtolower($datum1)));
                                $lan_dutch2= ucfirst(str_replace($lang['en'], $lang['nl'], strtolower($datum2)));
                                //echo $lan_dutch;
                            ?>
                            <?php if(!empty($row->date_of_birth)){?>
                            <li class="list_bottom"><span class="deceased_header">Geboren te: </span> <?php if(!empty($row->geboren_stad)){?><span class="deceased_boady"><?php echo $row->geboren_stad.' '.'op'; ?></span><?php } ?><span class="deceased_boady"><?php  echo $lan_dutch; ?></span></li>
                                <?php } ?>
                                <?php if(!empty($row->dead_in)){?>
                            <li class="list_bottom"><span class="deceased_header">Overleden te: </span> <?php if(!empty($row->overleden_stad)){?><span class="deceased_boady"><?php echo $row->overleden_stad.' '.'op'; ?></span> <?php } ?> <span class="deceased_boady"><?php echo $lan_dutch2; ?></span></li>
                                    <?php } ?>

                                    <?php if(!empty($row->date_of_burial)){?>
                            <li class="list_bottom"><span class="deceased_header">Datum begrafenis: </span> <span class="deceased_boady"><?php echo $lan_dutch1; ?></span> </li>


                            <?php  } ?>
                            <?php if(!empty($row->critter_info)){?>
                            <li class="list_bottom"><span class="deceased_header">Begrafenis informatie:</span> <span class="deceased_boady"><?php echo $row->critter_info; ?></span></li>&nbsp;

                            <?php } ?>

                            <li class="list_bottom"><button class="show_response"><a href="<?php echo admin_url('show-critter-details?id=' . $row->id); ?>">Rouwbetuiging</a></button>&nbsp;&nbsp;&nbsp;&nbsp;<?php if($row->pdf_name){ ?><button class="mourning_letter"><a href="<?php echo $pluginImagePath."critters_plugin/src/pdf1/".$row->pdf_name; ?>" target="_blank">Rouwbrief</a><?php //}else{ echo "Geen PDF-bestand";?></button> <?php } ?></li>



                        </ol>



                    </div>



                </div>



            </div>



        </li><br>



            <?php } ?>



    </ol>



        <!-- Response form -->

    <section id="redirect_form">

        <div class="container response_section">



        <form method="post" action="<?php the_permalink(); ?>">



            <input type="hidden" name="hidden_id" value="<?php echo $row->id; ?>">



            <h2>Laat een rouwbetuiging achter voor de familie</h2><br>



            <h4 style="text-align:center;">Dit bericht is enkel zichtbaar voor de familie</h4>



            <h4 style="text-align:center;">Het e-mailadres wordt niet gepubliceerd. Vereiste velden zijn gemarkeerd met *



            </h4>



            <span class="rsvp_success_msg"><?php echo (isset($_SESSION['submit_status']))? $_SESSION['submit_status']:''; ?></span>



            <h5>Reactie </h5>



            <textarea class="res_response" name="res_response" style="height: 140px;width: 1130px;"></textarea><br><br>



            <input type="text(vereist)" size="39" placeholder="Naam (vereist)" class="res_name" name="res_name" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input



                type="email" name="res_email" size="39" class="res_email" placeholder="E-mail(vereist)" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input



                type="number" name="res_site" size="39" class="res_site" placeholder="Telefoonnummer(vereist)" required><br><br>



            <div class="res_save_status">



                <input name="res_save_status" type="checkbox"><p class="content_msg">Mijn naam, e-mail en site bewaren in deze browser voor de volgende keer wanneer ik een reactie plaats.</p><br><br>



            </div>

 <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div><br>
            <input class="Condolences" name="submit" type="submit" value="Rouwbetuiging">



        </form>



    </div>

    </section>



<script src="https://www.google.com/recaptcha/api.js"></script>

<script>



    $(document).ready(function () {

            $(".response_section").show();

    });



    function search_critters() {



	let input = document.getElementById('searchbar').value



	input=input.toLowerCase();



	let x = document.getElementsByClassName('critter');



	



	for (i = 0; i < x.length; i++) {



		if (!x[i].innerHTML.toLowerCase().includes(input)) {



			x[i].style.display="none";



		}



		else {



			x[i].style.display="list-item";				



		}



	}



}


$(document).ready(function() {
    $(document).on('submit', '#my-form', function() {
      return false;
     });
});
3. This form 
</script>
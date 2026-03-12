<?php



    global $wpdb;



    $pluginImagePath  = trailingslashit(plugins_url());


    unset ($_SESSION["submit_status"]);



    // Insert REsponse form data



    if(isset($_POST['submit'])){



        $data = array(



        'name' => $_POST['res_name'],



        'email' => $_POST['res_email'],



        'site' => $_POST['res_site'],



        'response' => $_POST['res_response']



    );



         $table_name = $wpdb->prefix . "critters_form_response";







            $result = $wpdb->insert($table_name,$data);



            if($result){



                $_SESSION['submit_status'] = "Form Submit Successfully."; 



            }else{



                $_SESSION['submit_status'] = "Sorry Some Error. Please Fill Form Again."; 



            }



    }



    $table_name = $wpdb->prefix . "critters_form_details";



    if(isset($_GET['pg']))



    {



        $page = $_GET['pg'];



    }



    else



    {



        $page = 1;



    }







    $num_per_page = 6;



    $start_from = ($page-1)*$num_per_page;



    $rows = $wpdb->get_results("SELECT * FROM $table_name  ORDER BY id DESC  limit $start_from,$num_per_page");







?>
    <?php
    global $wpdb;
    $table_name = $wpdb->prefix . 'change_color';
    $result = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC LIMIT 1");
    // print_r($result);
  
    // $test = $result['color'];
    // print_r($test);
// $color = '#af1212';
?>

<style>
    .show_response {
        <?php foreach ($result as $row) { ?>
            background : <?php echo $row->color; ?> !important;
        <?php } ?>
    }
    .mourning_letter{
        <?php foreach ($result as $row) { ?>
            background : <?php echo $row->color; ?> !important;
        <?php } ?>
    }
    .btn {
        <?php foreach ($result as $row) { ?>
        background : <?php echo $row->color; ?> !important;
        <?php } ?>
    }
</style>




    <div class="container">



        <div class="set_title">



            <h2 class="heading_title">ROUWBERICHTEN & CONDOLEREN</h2><br>



                <input id="searchbar" class="input_search" type="text" name="search" placeholder="Zoeken">



                <button class="btn" onclick="search_critters()">Zoeken</button>



        </div>



        <div class="pagination">



            <?php 



                $table_name = $wpdb->prefix . "critters_form_details";



                $wpdb->get_results("select * from $table_name");
                $total = $wpdb->num_rows;
                $url = $_SERVER['REQUEST_URI'];
                $my_var = 'rouwberichten-condoleren';

                $url = str_replace("rouwberichten-condoleren/", $my_var, $url );
                    // echo $url ;

                $total_page = ceil($total/$num_per_page);



                    if($page>1)



                    {



                        echo "<a class='pagin1' href='rouwberichten-condoleren?pg=".($page-1)."'><</a>";



                    }



                    for($i=1;$i<$total_page;$i++)

                       
                    {

                        echo "<a class='pagin2' href='rouwberichten-condoleren?pg=".$i."'>$i</a>";
                        //echo admin_url('show-critter-details?id=' . $row->id); 
                    }



                    if($i>$page)



                    {



                        echo "<a class='pagin3' href='rouwberichten-condoleren?pg=".($page+1)."'>></a>";



                    }

            ?>



        </div>



    </div>



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



                                <h2 class="deceased_title"><a href="<?php echo admin_url('show-critter-details?id=' . $row->id); ?>"><?php echo $row->name; ?></a></h2>



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

                            <!-- <li class="list_bottom"><button class="show_response"><a href="<?php //echo admin_url('show-critter-details?id=' . $row->id); ?>">Rouwbetuiging</a></button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="mourning_letter"><a href="<?php //echo admin_url('show-condolences-details?id=' . $row->id); ?>">Rouwbetuiging berichten</a></button></li> -->

                        </ol>



                    </div>



                </div>



            </div>



		</li><br>



        <?php } ?>



	</ol>



<script>



    $(document).ready(function () {



        $(".response_section").hide();



        $(".show_response").click(function () {



            $(".response_section").show();



        });



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
</script>
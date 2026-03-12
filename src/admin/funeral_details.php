<?php
    global $wpdb;
    $pluginImagePath  = trailingslashit(plugins_url());
    $table_name = $wpdb->prefix . "critters_form_details";
    $rows = $wpdb->get_results("SELECT * FROM $table_name");
    $table_name_res = $wpdb->prefix . 'critters_form_response';
    $query_data = $wpdb->get_results("SELECT critters_form_detail_id FROM $table_name_res WHERE EXISTS (SELECT id FROM $table_name WHERE $table_name.id = $table_name_res.critters_form_detail_id)");
    if(isset($_GET['id']))
    {
        $rid=intval($_GET['id']);
        $wpdb->delete( $table_name,  array( 'ID' => $rid ) );
        $url = home_url()."/wp-admin/admin.php?page=critter_details";
?>
        <script type="text/javascript">
            setTimeout(function(){
                     window.location.href="<?php echo $url; ?>";
                    }, 1000);
                 </script>
<?php
     }
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
     $rows = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC limit $start_from,$num_per_page");
?>
    <link rel="stylesheet" type="text/css" href="<?php echo  $pluginImagePath."critters_plugin/css/style.css"; ?>">
    <link href="https://expandly.com/wp-content/themes/expandly/assets/fontawesome/css/all.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="container">
    <h1 class="critter_detail">Volledige uitvaartdetails</h1>
    <div class="pagination">
            <?php 
                $table_name = $wpdb->prefix . "critters_form_details";
                $wpdb->get_results("select * from $table_name");
                $total = $wpdb->num_rows;
                $url=admin_url('admin.php?page=critter_details');
                $total_page = ceil($total/$num_per_page);
                    if($page>1)
                    {
                        echo "<a class='pagin1' href=".$url."&pg=".($page-1)."><</a>";
                    }
                    for($i=1;$i<$total_page;$i++)
                    {
                        echo "<a class='pagin2' href=".$url."&pg=".$i.">$i</a>";
                    }
                    if($i>$page)
                    {
                        echo "<a class='pagin3' href=".$url."&pg=".($page+1).">></a>";
                    }
            ?>
        </div>
    <table class="table">
    <tr class="table_heading">
        <th>Afbeelding</th>
        <th>Naam</th>
        <th>burgelijkestand</th>
        <th>Begrafenisstatus</th>
        <th>Andere status</th>
        <th>Begrafenis andere status</th>
        <th>Geboortedatum</th>
        <th>Geboorteplaats</th>
        <th>Overleden op</th>
        <th>Overlijdensplaats</th>
        <th>Datum begrafenis</th>
        <th>Begrafenis informatie</th>
        <th>Begrafenisinformatie bewerken</th>
        <th>Condoleance berichten</th>
        <th>Rouwbrief</th>
        <th>Verwijder alstublieft</th>
    </tr>
    <?php foreach ($rows as $row) { ?>
        <?php $get_del_id = $row->id;?>
    <tr class="table_rows">
        <!-- <td><img src="<?php //echo $pluginImagePath."critters_plugin/src/image1/". $row->file_name; ?>" width="50" height="50"></td> -->
        <td> <?php if($row->file_name){ ?><img src="<?php echo $pluginImagePath."critters_plugin/src/image1/". $row->file_name; ?>" width="300" height="300"><?php }else{ ?><img src="<?php echo $pluginImagePath."critters_plugin/src/image1/candle/Candle.jpg"; ?>" width="300" height="300"><?php } ?>
</td>
        <td><?php if($row->title){ ?> <?php echo $row->title; ?><?php } ?>&nbsp;&nbsp;<?php echo $row->name; ?></td>
        <td><?php echo $row->status; ?></td>
        <td><?php echo $row->status_cat; ?></td>
        <td><?php echo $row->other_status; ?></td>
        <td><?php echo $row->other_status_val; ?></td>
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
        ?>
        <td><?php if(!empty($row->date_of_birth)){?><?php  echo $lan_dutch; ?><?php } ?></td>
        <td><?php if(!empty($row->geboren_stad)){?><?php echo $row->geboren_stad; ?><?php } ?></td>
        <td><?php if(!empty($row->dead_in)){?><?php echo $lan_dutch2; ?><?php } ?></td>
        <td><?php if(!empty($row->overleden_stad)){?><?php echo $row->overleden_stad; ?><?php } ?></td>
        <td><?php if(!empty($row->date_of_burial)){?><?php echo $lan_dutch1; ?><?php  } ?></td>
        <td><?php echo $row->critter_info; ?></td>
        <td><a href="<?php echo admin_url('admin.php?page=Update_critter&id=' . $row->id);?>">Hier bewerken</a></td>
        <td><?php foreach($query_data as $data){ 
            $test_data = $data->critters_form_detail_id;
        
            if($test_data == $get_del_id) { ?>
                <a href="<?php echo admin_url('admin.php?page=condolence_messages&id=' . $row->id);?>">Rouwbetuiging berichten</a>
            <?php }else{ echo ""; }
        }
        
        ?></td>
    <!-- <td><a href="<?php //echo admin_url('admin.php?page=mourning_letter&id=' . $row->id);?>">Rouwbrief</a></td> -->
        <td><?php if($row->pdf_name){ ?> <a href="<?php echo admin_url('admin.php?page=mourning_letter&id=' . $row->id);?>">Rouwbrief</a><?php }else{ echo "";?>  <?php } ?></td>
        <td><a href="<?php echo admin_url('admin.php?page=critter_details&id=' . $row->id);?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
    </tr>
    <?php } ?>
    </table>
</div>
<script>
$(document).ready(function(){
	var found = {};
      $('a').each(function(){
    var $this = $(this);
    if(found[$this.attr('href')]){
      $this.remove();
    }else{
      found[$this.attr('href')] = true;
    }
  });
});
</script>
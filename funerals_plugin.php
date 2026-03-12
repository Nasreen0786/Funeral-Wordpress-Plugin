<?php
/**
* Plugin Name: critters
* Plugin URI: https://www.example.com/
* Description: A WordPress plugin to manage memorial entries, condolence messages, and tribute pages with customizable settings.
* Version: 1.1
* Author: Nasreen Shah
**/


define( 'ARFC_BASEPATH', plugin_dir_path( __FILE__ ) ); //plugin path



define( 'ARFC_BASEURL', plugin_dir_url( __FILE__ ) ); 







/* Include css and js files for frontend */



function critters_load_css_js() {



    wp_enqueue_style( 'main-css', plugins_url('/css/style.css', __FILE__));



    wp_enqueue_script( 'rsvpmain-js', plugins_url('/js/custom.js',__FILE__), array('jquery'));



}







add_action( 'wp_enqueue_scripts', 'critters_load_css_js' );



/* Create admin page  */



function critters_admin_pages(){



global $team_page;



add_menu_page(



__('critters'),  //page title



__('critters'), //menu title



'edit_posts', //capability



'critters', //menu slug/handle this is what you need!!!



'critters_services', //callback function



'dashicons-image-rotate', //icon_url,



 40 );











add_submenu_page(



'critters',



'Update critters', //page title



null, //menu title



'edit_posts', //capability,



'Update_critter',//menu slug



'Update_critter' //callback function



);



add_submenu_page(



  'critters',



  'critter Details', //page title



  'critter Details', //menu title



  'edit_posts', //capability,



  'critter_details',//menu slug



  'critter_details' //callback function



  );



  add_submenu_page(



    'critters',



    'Change Color Setting', //page title



    'Change Color Settings', //menu title



    'edit_posts', //capability,



    'Colour_change_settings',//menu slug



    'Colour_change_settings' //callback function



    );
    add_submenu_page(
      'critters',
      'Change Captcha Setting', //page title
      'Change Captcha Settings', //menu title
      'edit_posts', //capability,
      'Captcha_change_settings',//menu slug
      'Captcha_change_settings' //callback function
    );


add_submenu_page(



    'critters',



    'Condolence Messages', //page title



    null, //menu title



    'edit_posts', //capability,



    'condolence_messages',//menu slug



    'condolence_messages' //callback function



    ); 



add_submenu_page(



      'critters',



      'mourning Letter', //page title



      null, //menu title



      'edit_posts', //capability,



      'mourning_letter',//menu slug



      'mourning_letter' //callback function



      );







      







}







function critters_services(){



	require ARFC_BASEPATH.'src/admin/critters_services.php';



}







function Update_critter(){



	require ARFC_BASEPATH.'src/admin/Update_critter.php';



}







function critter_details(){



	require ARFC_BASEPATH.'src/admin/critter_details.php';







}



function condolence_messages(){



  require ARFC_BASEPATH.'src/admin/condolence_messages.php';



}







function mourning_letter(){



  require ARFC_BASEPATH.'src/admin/mourning_letter.php';



}



function Colour_change_settings(){



  require ARFC_BASEPATH.'src/admin/Colour_change_settings.php';



}

function Captcha_change_settings(){



  require ARFC_BASEPATH.'src/admin/captcha_file.php';



}

add_action('admin_menu', 'critters_admin_pages');



require ARFC_BASEPATH.'src/functions.php';







function critters_detail() {



        //creation of first table



        global $wpdb, $wnm_db_version;



        $charset_collate = $wpdb->get_charset_collate();



        $sql = array();



        $critters_form_details = $wpdb->prefix . "critters_form_details"; 



            if( $wpdb->get_var("show tables like '". $critters_form_details . "'") != $critters_form_details ) { 



              $sql[] ="CREATE TABLE " .$critters_form_details. "(`id` int(11) NOT NULL AUTO_INCREMENT,`title` varchar(255) NOT NULL,`name` varchar(255) NOT NULL,`geboren_stad` varchar(255) NOT NULL, `overleden_stad` varchar(255) NOT NULL, `gender` varchar(255) NULL, `status` varchar(255) DEFAULT NULL,`status_cat` varchar(255) NULL,`other_status` varchar(255) NULL,`other_status_val` varchar(255) NULL,`date_of_birth` varchar(255) NULL, `date_of_burial` varchar(255) NOT NULL,`dead_in` varchar(255) NULL, `critter_info` varchar(255) NOT NULL,`file_name` varchar(255) NOT NULL,`pdf_name` varchar(255) NULL, PRIMARY KEY (`id`)) $charset_collate;";



    }



      if ( !empty($sql)) {



        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');



        dbDelta($sql);



        add_option("wnm_db_version", $wnm_db_version);



        }











        $sql1 = array();



        $change_color = $wpdb->prefix . "change_color"; 



            if( $wpdb->get_var("show tables like '". $change_color . "'") != $change_color ) { 



              $sql1[] ="CREATE TABLE " .$change_color. "(`id` int(11) NOT NULL AUTO_INCREMENT,`color` varchar(255) NOT NULL, PRIMARY KEY (`id`)) $charset_collate;";



    }



      if ( !empty($sql1)) {



        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');



        dbDelta($sql1);



        add_option("wnm_db_version", $wnm_db_version);



        }



      }



















function critters_response() {
                //creation of 2nd table
                global $wpdb, $wnm_db_version;
                $charset_collate = $wpdb->get_charset_collate();
                $sql = array();
                $critters_form_response = $wpdb->prefix . "critters_form_response"; 
                    if( $wpdb->get_var("show tables like '". $critters_form_response . "'") != $critters_form_response ) { 
                         $sql[] ="CREATE TABLE " .$critters_form_response. "(`id` int(11) NOT NULL AUTO_INCREMENT, `critters_form_detail_id` varchar(255) NOT NULL,`name` varchar(255) NOT NULL,
                         `email` varchar(255) NOT NULL, `site` varchar(255) DEFAULT NULL,`save_status` varchar(255) NOT NULL,`response` text NOT NULL,`Current_date` datetime default now(), PRIMARY KEY (`id`)) $charset_collate;";
            }
                      if ( !empty($sql)) {
                        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                        dbDelta($sql);
                        add_option("wnm_db_version", $wnm_db_version);
                      }
                    }
            register_activation_hook(__FILE__,'critters_detail');   
            register_activation_hook(__FILE__,'critters_response');


            function critters_api_secret_key() {
              //creation of 3rd table
              global $wpdb, $wnm_db_version;
              $charset_collate = $wpdb->get_charset_collate();
              $sql = array();
              $critters_form_api_secret_key = $wpdb->prefix . "critters_form_api_secret_key"; 
                  if( $wpdb->get_var("show tables like '". $critters_form_api_secret_key . "'") != $critters_form_api_secret_key ) { 
                       $sql[] ="CREATE TABLE " .$critters_form_api_secret_key. "(`id` int(11) NOT NULL AUTO_INCREMENT, `api_key` varchar(255) NOT NULL,`secret_key` varchar(255) NOT NULL,`Current_date` datetime default now(), PRIMARY KEY (`id`)) $charset_collate;";
          }
                    if ( !empty($sql)) {
                      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                      dbDelta($sql);
                      add_option("wnm_db_version", $wnm_db_version);
                    }
                  }  
          register_activation_hook(__FILE__,'critters_api_secret_key');


//  function drop_table(){
//               global $wpdb;  
//               $table_name = $wpdb->prefix . 'critters_form_response';
//               $sql = "DROP TABLE ". $table_name;
//               $wpdb->query($sql);
//             }
//           register_deactivation_hook(__FILE__, 'drop_table' );






/// create first page







function critters_page(){



    $my_post1 = array(







      'post_title'    => wp_strip_all_tags('critters Detail Page'),



      'post_content'  => '[critters_detail]',



      'post_status'   => 'publish',



      'post_author'   => 1,



      'post_type'     => 'page',



    );



    $newvalue1 = wp_insert_post( $my_post1, false );

    update_option( 'vidpage1', $newvalue1 );
}

register_activation_hook(__FILE__, 'critters_page');
register_activation_hook(__FILE__, 'critters_response_page');
register_activation_hook(__FILE__, 'show_single_data_page');
register_activation_hook(__FILE__, 'show_condolence_messages_page');
function critters_response_page(){
  $my_post = array(
    'post_title'    => wp_strip_all_tags('Rouwberichten Condoleren'),
    'post_content'  => '[critters_response]',
    'post_status'   => 'publish',
    'post_author'   => 1,
    'post_type'     => 'page',
  );
  $newvalue = wp_insert_post( $my_post, false );
  update_option( 'vidpage', $newvalue );
}
function show_single_data_page(){
$my_post2 = array(
'post_title'    => wp_strip_all_tags('Show critter Details'),
'post_content'  => '[show_single_data]',
'post_status'   => 'publish',
'post_author'   => 1,
'post_type'     => 'page',
);
//$page = get_page_by_title('critters_detail_page');
//echo $page->title;
  $newvalue2 = wp_insert_post( $my_post2, false );
  update_option( 'vidpage2', $newvalue2 );
}
function show_condolence_messages_page(){
  $my_post3 = array(
  'post_title'    => wp_strip_all_tags('Show condolences Details'),
  'post_content'  => '[show_condolence_messages]',
  'post_status'   => 'publish',
  'post_author'   => 1,
  'post_type'     => 'page',
  );
  //$page = get_page_by_title('critters_detail_page');
  //echo $page->title;
    $newvalue3 = wp_insert_post( $my_post3, false );
    update_option( 'vidpage3', $newvalue3 );
}
function deactivate_plugin() {
  $page_id = get_option('vidpage');
  wp_delete_post($page_id);
}
function deactivate_plugin1() {
  $page_id1 = get_option('vidpage1');
  wp_delete_post($page_id1);
}
function deactivate_plugin2() {
  $page_id2 = get_option('vidpage2');
  wp_delete_post($page_id2);
}
function deactivate_plugin3() {
  $page_id3 = get_option('vidpage3');
  wp_delete_post($page_id3);
}
register_deactivation_hook( __FILE__, 'deactivate_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_plugin1' );
register_deactivation_hook( __FILE__, 'deactivate_plugin2' );
register_deactivation_hook( __FILE__, 'deactivate_plugin3' );
?>
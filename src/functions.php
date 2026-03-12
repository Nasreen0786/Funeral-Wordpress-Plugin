<?php 







function get_detail_cpt()



{



	ob_start();



	require ARFC_BASEPATH.'src/services_lists.php';



	return ob_get_clean();



}



add_shortcode( 'critters_detail', 'get_detail_cpt' );
function critters_response_shortcode()
{
	ob_start();
	require ARFC_BASEPATH.'src/display-data.php';
	return ob_get_clean();
}
add_shortcode( 'critters_response', 'critters_response_shortcode' );
function show_single_data_shortcode()
{
	ob_start();
	require ARFC_BASEPATH.'src/show_single_data.php';
	return ob_get_clean();
}
add_shortcode( 'show_single_data', 'show_single_data_shortcode' );
function show_condolence_messages_shortcode()
{
	ob_start();
	require ARFC_BASEPATH.'src/show_condolence_messages.php';
	return ob_get_clean();
}
add_shortcode( 'show_condolence_messages', 'show_condolence_messages_shortcode' );




function clear_cache() {
    if (function_exists('wp_cache_clear_cache')) {
        wp_cache_clear_cache();
    }
    if (function_exists('wp_cache_flush')) {
        wp_cache_flush();
    }
    if (function_exists('w3tc_pgcache_flush')) {
        w3tc_pgcache_flush();
    }
    if (function_exists('w3tc_minify_flush')) {
        w3tc_minify_flush();
    }
}
add_action('save_post', 'clear_cache');
add_action('delete_post', 'clear_cache');
add_action('edit_post', 'clear_cache');
add_action('switch_theme', 'clear_cache');


add_action('init', 'clear_cache');

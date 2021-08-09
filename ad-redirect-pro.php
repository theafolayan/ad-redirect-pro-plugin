<?php
/*
Plugin name: Kofem Media Redirect Plugin
Plugin URI: http://example.com/wordpress-kofem-media-redirect
Description: A plugin to add redirect to pages
Author: Theafolayan
Author URI: https://theafolayan.com
Version: 0.5
*/

// Call kofem_media_redirect_menu function to load plugin menu in dashboard
add_action( 'admin_menu', 'kofem_media_redirect_menu' );

// Create WordPress admin menu
function kofem_media_redirect_menu(){

  $page_title = 'Kofem Media Redirect';
  $menu_title = 'Koem Media Redirect Settings';
  $capability = 'manage_options';
  $menu_slug  = 'kofem-media-redirect';
  $function   = 'kofem_options_page';
  $icon_url   = 'dashicons-controls-repeat';
  $position   = 14;

  add_menu_page( $page_title,
                 $menu_title,
                 $capability,
                 $menu_slug,
                 $function,
                 $icon_url,
                 $position );

  // Call update_kofem_media_redirect function to update database
  add_action( 'admin_init', 'kofem_settings_init' );

}

function kofem_settings_init(  ) { 

	register_setting( 'pluginPage', 'kofem_settings' );

	add_settings_section(
		'kofem_pluginPage_section', 
		__( 'Edit the following values carefully!', 'kofem' ), 
		'kofem_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'kofem_text_field_0', 
		__( 'First Redirect URL', 'kofem' ), 
		'kofem_text_field_0_render', 
		'pluginPage', 
		'kofem_pluginPage_section' 
	);

	add_settings_field( 
		'kofem_text_field_1', 
		__( 'Seconds to delay', 'kofem' ), 
		'kofem_text_field_1_render', 
		'pluginPage', 
		'kofem_pluginPage_section' 
	);

	add_settings_field( 
		'kofem_text_field_2', 
		__( 'Second Redirect URL', 'kofem' ), 
		'kofem_text_field_2_render', 
		'pluginPage', 
		'kofem_pluginPage_section' 
	);


}


function kofem_text_field_0_render(  ) { 

	$options = get_option( 'kofem_settings' );
	?>
	<input type='text' type='hidden' name='kofem_settings[kofem_text_field_0]' value='<?php echo $options['kofem_text_field_0']; ?>'>
	<?php

}


function kofem_text_field_1_render(  ) { 

	$options = get_option( 'kofem_settings' );
	?>
	<input type='number' type='hidden' name='kofem_settings[kofem_text_field_1]' value='<?php echo $options['kofem_text_field_1']; ?>'>
	<?php

}


function kofem_text_field_2_render(  ) { 

	$options = get_option( 'kofem_settings' );
	?>
	<input type='text' type='hidden' name='kofem_settings[kofem_text_field_2]' value='<?php echo $options['kofem_text_field_2']; ?>'>
	<?php

}


function kofem_settings_section_callback(  ) { 

	echo __( 'The seconds feild should be in milliseconds', 'kofem' );

}


function kofem_options_page(  ) { 

		?>
		<form action='options.php' method='post'>

			<h2>Kofem Media Redirect Plugin</h2>

			<?php
			settings_fields( 'pluginPage' );
			do_settings_sections( 'pluginPage' );
			submit_button();
			?>

		</form>
		<?php

}


function insert_my_footer() {
$options = get_option( 'kofem_settings' );
    echo '<div id="mount"></div>';
    echo '<input type ="hidden" id="kofem-media-url" value="';
    echo $options['kofem_text_field_0'];
    echo '"/>';

}
function insert_my_secondfooter() {
	$options = get_option( 'kofem_settings' );
    echo '<div id="mount"></div>';
    echo '<input type ="hidden" id="kofem-media-seconds" value="';
    echo $options['kofem_text_field_1'];
    echo '"/>';

}
function insert_my_third_footer() {
	$options = get_option( 'kofem_settings' );
    echo '<div id="mount"></div>';
    echo '<input type ="hidden" id="kofem-media-next-url" value="';
    echo $options['kofem_text_field_2'];
    echo '"/>';

}

add_action('wp_footer', 'insert_my_footer');
add_action('wp_footer', 'insert_my_secondfooter');
add_action('wp_footer', 'insert_my_third_footer');

function enqueue_scripts(){
    wp_enqueue_script('vue', 'https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js', [], '2.5.17'); 
    wp_enqueue_script('ad-redirect-pro', plugin_dir_url( __FILE__ ) . 'ad-redirect-pro.js', [], '1.0', true);
     
}
  
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );  


?>
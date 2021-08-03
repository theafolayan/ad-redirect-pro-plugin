<?php
/*
Plugin Name: Ad Redirect Pro
Description: Adsense Redirect Plugin for Kofem Media
Version: 1.0
Author: Oluwaseun Raphael Afolayan
Author URI: https://theafolayan.com
*/


// Call kofem_media_redirect_menu function to load plugin menu in dashboard
add_action( 'admin_menu', 'kofem_media_redirect_menu' );

// Create WordPress admin menu
function kofem_media_redirect_menu(){

  $page_title = 'Ad Redirect Pro For Kofem media';
  $menu_title = 'Ad Redirect Pro Settings';
  $capability = 'manage_options';
  $menu_slug  = 'extra-post-info';
  $function   = 'kofem_media_redirect_page';
  $icon_url   = 'dashicons-admin-site-alt';
  $position   = 20;

  add_menu_page( $page_title,
                 $menu_title,
                 $capability,
                 $menu_slug,
                 $function,
                 $icon_url,
                 $position );

  // Call update_kofem_media_redirect function to update database
  add_action( 'admin_init', 'update_kofem_media_redirect' );

}

// Create function to register plugin settings in the database
function update_kofem_media_redirect() {
  register_setting( 'extra-post-info-settings', 'kofem_media_redirect' );
}

// Create WordPress plugin page
function kofem_media_redirect_page(){
?>
  <h1>Ad RedirectPro For Kofem media</h1>
  <form method="post" action="options.php">
    <?php settings_fields( 'extra-post-info-settings' ); ?>
    <?php do_settings_sections( 'extra-post-info-settings' ); ?>
    <table class="form-table">
      <tr valign="top">
      <th scope="row">Next Redirect URL:</th>
      <td><input type="text" name="kofem_media_redirect" value="<?php echo get_option('kofem_media_redirect'); ?>"/></td>
      <br>
      
      </tr>
      <tr>  <th scope="row">Seconds to delay:</th>
      <td><input type="number" name="kofem_media_redirect" value="<?php echo get_option('kofem_media_redirect'); ?>"/></td></tr>
    </table>
  <?php submit_button(); ?>
  </form>
<?php
}


// Plugin logic for adding extra info to posts
if( !function_exists("kofem_media_redirect") )
{
  function kofem_media_redirect($content)
  {
    $extra_info = get_option('kofem_media_redirect');
    return $content . $extra_info;
  }

// Apply the kofem_media_redirect function on our content  
add_filter('the_content', 'kofem_media_redirect');
}
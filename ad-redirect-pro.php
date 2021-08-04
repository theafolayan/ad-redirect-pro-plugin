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
  $menu_title = 'Redirect Settings';
  $capability = 'manage_options';
  $menu_slug  = 'kofem-media-redirect';
  $function   = 'kofem_media_redirect_page';
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
  add_action( 'admin_init', 'update_kofem_media_redirect' );

}

// Create function to register plugin settings in the database
function update_kofem_media_redirect() {
  register_setting( 'kofem-media-redirect-settings', 'kofem_media_redirect' );
}

// Create WordPress plugin page
function kofem_media_redirect_page(){
?>
  <h1>Kofem Media Redirect</h1>
  <form method="post" action="options.php">
    <?php settings_fields( 'kofem-media-redirect-settings' ); ?>
    <?php do_settings_sections( 'kofem-media-redirect-settings' ); ?>
    <table class="form-table">
      <tr valign="top">
      <th scope="row">Next Redirect URL:</th>
      <td><input type="text" name="kofem_media_redirect" value="<?php echo get_option('kofem_media_redirect'); ?>"/></td>
      </tr>
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

function enqueue_scripts(){
    wp_enqueue_script('vue', 'https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js', [], '2.5.17');       
 }

?>
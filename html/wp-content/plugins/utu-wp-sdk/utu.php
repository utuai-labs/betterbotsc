<?php
/*
Plugin Name: uTu SDK for WordPress
Plugin URI: https://github.com/utu-ai/wp-sdk
Description: utu.php handles the setting controls accessed via Admin
Author: marcus <marcus@utu.ai>
Version: 3.0
Author URI: http://utu.ai/
*/

namespace utu;

class utu {

	// Returns the contents of a parsed PHP file as a string
  public static function get_require_contents($file) {
		if (is_file($file)) {
			ob_start();
			require $file;
			return ob_get_clean();
		}
		return false;
	}

	public function __construct(){
    if(is_admin()){
    	add_action('admin_menu', array($this, 'add_settings_page'));
    	add_action('admin_init', array($this, 'utu_init'));
    	require_once dirname( __FILE__ ) . '/meta-box.php';
		} else {
			require_once dirname( __FILE__ ) . '/page.php';
		}
  }


  public function add_settings_page(){
    // This page will be under "Settings"
    add_options_page('uTu Options', 'uTu Options', 'manage_options', 'utu-admin', array($this, 'create_settings_page'));
  }

 	public function create_settings_page(){
    ?>
      <div class="wrap">
	       <?php screen_icon(); ?>
	       <h2>uTu Settings</h2>
	       <?php settings_errors(  ) ?>
	       <form method="post" action="options.php">
	          <?php
              // This prints out all hidden setting fields
		          settings_fields('utu_settings_group');
		          do_settings_sections('utu_options');
            ?>
	          <?php submit_button(); ?>
	       </form>
      </div>
	    <p>To post an event, add <code>utu.track('Event Name', { foo: 'bar' })</code>.
    <?php
  }

	public function print_section_info(){
	   print 'Enter your uTu settings below:';
  }

	function my_text_input( $args ) {
	    $name = esc_attr( $args['name'] );
	    $value = esc_attr( $args['value'] );
	    if(strlen($value) > 0) {
	    	$size = strlen($value) + 2;
	    } else {
	    	$size = 10;
	    }
	    echo "<input type='text' name='$name' size='$size' value='$value' />";
	}


  public function utu_init(){
    register_setting('utu_settings_group', 'utu_settings');
    $settings = (array) get_option( 'utu_settings' );
    add_settings_section(
      'utu_settings_section',
       'uTu ',
       array($this, 'print_section_info'),
       'utu_options'
    );
    add_settings_field(
      'token_id',
      'uTu Token', // human readable part
      array($this, 'my_text_input'),  // the function that renders the field
    	'utu_options',
    	'utu_settings_section',
      array('name' => 'utu_settings[token_id]', 'value' => $settings['token_id'],)
    );
	}

	public function validate( $input ) {
    $output = get_option( 'utu_settings' );
    if ( ctype_alnum( $input['token_id'] ) ) {
      $output['token_id'] = $input['token_id'];
    } else {
    	echo "Adding Error \n"; #die;
      add_settings_error( 'utu_options', 'token_id', 'The uTu Token looks invalid (should be alpha numeric)' );
    }
    return $output;
	}

}

$utu = new utu();

?>

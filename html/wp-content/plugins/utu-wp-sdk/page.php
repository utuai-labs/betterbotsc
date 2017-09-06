<?php
  add_action('wp_head', array('uTu', 'insert_tracker'));
  add_action('wp_footer', array('uTu', 'insert_event'));

  class uTu {

    /**
     * Gets the value of the key utu_event_label for this specific Post
     *
     * @return string The value of the meta box set on the page
     */
    static function get_post_event_label()
    {
      global $post;
      return get_post_meta( $post->ID, 'utu_event_label', true );
    }

    static function get_post_title()
    {
      global $post;
      return $post->post_title;
    }

    /**
     * Inserts the value for the utu.track() API Call
     * @return boolean technically this should be html..
     */
    function insert_event() {
      $settings = (array) get_option( 'utu_settings' );

      $event_label = self::get_post_event_label();
      $my_title = self::get_post_title();
      echo "<script>console.log( 'trying to set event: " . $event_label . " (EOL)' );</script>";
      if (!empty($event_label)) {
    		echo
          "<script type='text/javascript'>
        		  utu.track(\"$event_label\", {
          			'Post Name': \"$my_title\",
          			'Page Url': window.location.pathname,
        		  });
  	      </script>";
      }
      echo "<script>console.log( 'set event: " . $event_label . " (EOL)' );</script>";

      ?>
        <script type='text/javascript'>
          var ctaClicks = window.document.getElementsByClassName("trackCTA");
          [].forEach.call(ctaClicks, function (cta) {
            cta.addEventListener("click", function(event) {
              utu.track('wp > site', {});
          	});
          });
        </script>
      <?php
      /*
       * END STATIC PAGE UTU JS
       */
      return true;
    }

    /**
     * Adds the Javascript necessary to start tracking via uTu.
     * This gets added to the <head> section.
     *
     * @return [type] [description]
     */
    static function insert_tracker() {
    	$settings = get_option('utu_settings');
    	if (!isset($settings['token_id'])) {
    		self::no_utu_token_found();
    		return false;
    	}
    	require_once dirname(__FILE__) . '/utu-wp-js.php';
    	return true;
    }

    static function no_utu_token_found()
    {
      echo "<!-- No uTu Token Defined -->";
    }
  }
?>

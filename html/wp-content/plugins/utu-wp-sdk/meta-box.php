<?php
  /*
  ** meta-box.php handles adding the utu event input fields across events, courses,
  * lessons, posts, and pages
  */
  add_action( 'admin_menu', 'utu_create_meta_box' );
  add_action( 'admin_menu', 'page_create_meta_box' );
  add_action( 'admin_menu', 'job_create_meta_box' );
  add_action( 'save_post', 'utu_update_event_label' );

  function utu_create_meta_box(){
    if( function_exists('add_meta_box') ){
      add_meta_box( 'utu-event-label', 'uTu Event Label', 'utu_event_box', 'post' );
    }
  }

  function page_create_meta_box(){
    if( function_exists('add_meta_box') ){
      add_meta_box( 'utu-event-label', 'uTu Event Label', 'utu_event_box', 'page' );
    }
  }

  function job_create_meta_box(){
    if( function_exists('add_meta_box') ){
      add_meta_box( 'utu-event-label', 'uTu Event Label', 'utu_event_box', 'jobpost' );
    }
  }

  function utu_event_box(){
    global $post;
    $utu_event_label = get_post_meta( $post->ID, 'utu_event_label', true );
    ?>
    <table class="form_table">
      <tr>
        <th width="30%"><label for="utu_event_label">uTu Event</label></th>
        <td width="70%"><input type="text" size="60" name="utu_event_label" value="<?php echo $utu_event_label; ?>" /></td>
      </tr>
    </table>
    <?php
  }

  function utu_update_event_label( $post_id ){
    if( isset($_POST['utu_event_label']) ){
      update_post_meta( $post_id, 'utu_event_label', $_POST['utu_event_label'] );
    }
  }
?>

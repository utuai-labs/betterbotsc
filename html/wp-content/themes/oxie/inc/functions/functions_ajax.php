<?php

/**************************************

INDEX

LIKE POST BUTTON AJAX CALL
USER RATING AJAX CALL

***************************************/


/**************************************
LIKE POST BUTTON AJAX CALL
***************************************/

	add_action('wp_ajax_like_post', 'like_post');
	add_action('wp_ajax_nopriv_like_post', 'like_post');

	function like_post() {

		// GET VARS
		$post_ID = $_REQUEST['post_ID'];
		$likes_string = mb_cookie_get_key_value ("oxie_cookie", "post-likes");
		$liked = (mb_is_value_in_delim_string($likes_string, $post_ID, ",")) ? true : false;


		// BOUNCER
		if (!wp_verify_nonce($_REQUEST['nonce'], 'like_post_' . $post_ID )) {
			exit('NONCE INCORRECT!');
		}
		if (!isset($_COOKIE['oxie_cookie'])) die();

		//UPDATE POST LIKES
		$likes = get_post_meta($post_ID,'post_likes',true);
		$likes = ($liked === false) ? $likes + 1 : $likes - 1 ;
		if ($likes < 0) { $likes = 0; }
		update_post_meta($post_ID,'post_likes',$likes);

		//UPDATE USER LIKES
		$likes_string = ($liked === false) ? mb_add_value_to_delim_string ($likes_string, $post_ID, ",", false) : mb_del_value_from_delim_string ($likes_string, $post_ID, ",");
		mb_update_cookie_key_value('oxie_cookie', 'post-likes', $likes_string);

		//OUTPUT
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			echo esc_attr($likes);
		}

		die();

	}


/**************************************
USER RATING AJAX CALL
***************************************/

	add_action('wp_ajax_user_rating', 'user_rating');
	add_action('wp_ajax_nopriv_user_rating', 'user_rating');

	function user_rating() {


		// GET VARS
		$star_rating = $_REQUEST['star_rating'];
		$post_id = $_REQUEST['post_id'];
		$user_ratings_cookie_string = mb_cookie_get_key_value ("oxie_cookie", "user-ratings");

		// BOUNCER
		if (!wp_verify_nonce($_REQUEST['nonce'], 'user_rating_' . $post_id )) {
			exit('NONCE INCORRECT!');
		}
		if (!isset($_COOKIE['oxie_cookie'])) die();

		//UPDATE POST META
		$cmb_post_user_ratings = get_post_meta($post_id,'cmb_post_user_ratings',true);
		$cmb_post_user_ratings = mb_add_value_to_delim_string($cmb_post_user_ratings, $star_rating, ",", true);
		update_post_meta($post_id,'cmb_post_user_ratings',$cmb_post_user_ratings);

		//UPDATE USER COOKIE
		$this_rating_string = $post_id . "-" . $star_rating;
		$user_ratings_cookie_string = mb_add_value_to_delim_string ($user_ratings_cookie_string, $this_rating_string, ",", false);
		mb_update_cookie_key_value('oxie_cookie', 'user-ratings', $user_ratings_cookie_string);

		//OUTPUT
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			echo esc_attr($cmb_post_user_ratings);
		}

		die();

	}


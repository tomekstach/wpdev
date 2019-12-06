<?php

/**
 * Plugin name: Custom API
 * Description: Endpoints for wpdev
 * Version: 1.0
 * Author: AstoSoft Joanna Stach
 * Author URI: https://astosoft.pl
 */

/**
 * WP Custom REST API method to get user data for Umowa Serwisowa Form
 *
 * @return object
 */
function wl_current_user()
{
  $current_user = wp_get_current_user();
  $user_meta = get_user_meta($current_user->ID);

  $user = new \stdClass;
  $user->id         = $current_user->ID;
  $user->first_name = $user_meta['first_name'][0];
  $user->last_name  = $user_meta['last_name'][0];
  $user->user_nip   = $user_meta['user_nip'][0];
  $user->user_tel   = $user_meta['user_tel'][0];
  $user->user_firm  = $user_meta['user_firm'][0];
  $user->user_email = $current_user->user_email;

  return $user;
}

/**
 * WP Custom REST API method to add new Umowa Serwisowa
 *
 * @return integer
 */
function wl_add_contract()
{
  $current_user = wp_get_current_user();
  $nip          = addslashes(stripslashes(strip_tags($_POST['nip'])));
  $firm         = addslashes(stripslashes(strip_tags($_POST['firm'])));
  $email        = addslashes(stripslashes(strip_tags($_POST['email'])));
  $date         = date('Y-m-d H:i:s');
  $date_end     = date('Y-m-d', strtotime("+7 day", time()));

  $args = array(
    'comment_status' => 'closed',
    'post_status'    => 'draft',
    'post_title'     => 'Umowa serwisowa z ' . $firm . ' ' . $date,
    'post_type'      => 'umowa_serwisowa'
  );

  // Create new post
  $new_post_id = wp_insert_post($args);

  // Klient
  update_field('field_5de2ce1ccc694', $current_user->ID, 'post_' . $new_post_id);
  // Data wygasniecia
  update_field('field_5de2ce8379eb9', $date_end, 'post_' . $new_post_id);
  // NIP
  update_field('field_5de2cead79eba', $nip, 'post_' . $new_post_id);
  // Nazwa firmy
  update_field('field_5de2cec879ebb', $firm, 'post_' . $new_post_id);
  // E-mail
  update_field('field_5de2ced479ebc', $email, 'post_' . $new_post_id);

  return $new_post_id;
}

add_action('rest_api_init', function () {
  register_rest_route('wl/v1', 'user', [
    'methods' => 'POST',
    'callback' => 'wl_current_user'
  ]);
});

add_action('rest_api_init', function () {
  register_rest_route('wl/v1', 'addContract', [
    'methods' => 'POST',
    'callback' => 'wl_add_contract'
  ]);
});
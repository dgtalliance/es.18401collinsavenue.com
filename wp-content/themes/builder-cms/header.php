<?php
  global $flex_idx_info, $flex_idx_lead;
  $custom_fields = get_post_custom(get_the_id());
  $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
  $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
  $idx_contact_phone = isset($flex_idx_info['agent']['agent_contact_phone_number']) ? sanitize_text_field($flex_idx_info['agent']['agent_contact_phone_number']) : '';
  $idx_contact_email = isset($flex_idx_info['agent']['agent_contact_email_address']) ? sanitize_text_field($flex_idx_info['agent']['agent_contact_email_address']) : '';
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <?php do_action('idx_gtm_head'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- APP HEADER COLOR -->
    <meta name="apple-mobile-web-app-status-bar-style" content="">
    <meta name="theme-color" content="">
    <meta name="msapplication-navbutton-color" content="">
    <?php wp_head();?>
  </head>
  <?php $body_class = array( "ip" ); ?> 
  <body <?php body_class( ); ?>>

    <!-- GTM scripts inside body -->
    <?php do_action('idx_gtm_body'); ?>
    <!-- Header  -->
    <?php do_action('idx_dinamic_body'); ?>

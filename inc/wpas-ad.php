<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WPAdServer_Ad {
  public static function register() {
    register_post_type("wpas-ad",
      array(
       "labels" => array(
         "name" => __("Ads"),
         "singular_name" => __("Ad")
       ),
       "menu_position" => 20,
       "show_ui" => true,
       "show_in_admin_bar" => true,
       "supports" => array("custom-fields", "thumbnail", "title"),
       "taxonomies" => array("wpas-ad-zone")
     )
   );
  }

  public static function shortcode( $atts ) {
    $atts = shortcode_atts( array(
      'zone' => ''
    ), $atts );

    if ( empty( $atts['zone'] ) ) {
      return;
    }

    $output = '';

    $output = '(Zone: ' . esc_html( $atts['zone'] ) . ')';

    return $output;
  }
}

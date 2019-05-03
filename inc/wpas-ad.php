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

    $args = array(
      'post_type' => 'wpas-ad',
      'post_status' => 'publish',
      'tax_query' => array(
        array(
            'taxonomy' => 'wpas-ad-zone',
            'field'    => 'slug',
            'terms'    => $atts['zone'],
        )
      ),
      'orderby' => 'rand',
      'posts_per_page' => 1
    );

    $ad_query = new WP_Query( $args );

    ob_start();

    echo '<pre>';
    print_r( $ad_query );
    echo '</pre>';

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
  }
}

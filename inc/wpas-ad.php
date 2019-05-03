<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WPAdServer_Ad {
  public static function wpas_create_post_type() {
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
}

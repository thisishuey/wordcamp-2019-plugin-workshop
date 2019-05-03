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
	   "show_ui" => true,
       "show_in_admin_bar" => true,
       "menu_position" => 20,
       "taxonomies" => array("wpas-ad-zone")
     )
   );
  }
}

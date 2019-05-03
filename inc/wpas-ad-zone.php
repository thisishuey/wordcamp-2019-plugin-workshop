<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class WPAdServer_Ad_Zone {
	public static function register() {
		register_taxonomy( 'wpas-ad-zone', 'wpas-ad', array(
			'labels' => array(
				'name'          => 'Ad Zones',
				'singular_name' => 'Ad Zone'
			)
		) );
	}
}

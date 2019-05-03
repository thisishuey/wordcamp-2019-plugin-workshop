<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPAdServer_Ad_Zone {
	public static function register() {
		register_taxonomy(
			'wpas-ad-zone',
			'wpas-ad',
			array(
				'labels' => array(
					'name'          => 'Ad Zones',
					'singular_name' => 'Ad Zone',
				),
			)
		);
	}

	public static function render( $zone ) {
		$args = array(
			'post_type'      => 'wpas-ad',
			'post_status'    => 'publish',
			'tax_query'      => array(
				array(
					'taxonomy' => 'wpas-ad-zone',
					'field'    => 'slug',
					'terms'    => $zone,
				),
			),
			'orderby'        => 'rand',
			'posts_per_page' => 1,
		);

		$ad_query = new WP_Query( $args );

		if ( ! $ad_query->post_count ) {
			return;
		}

		$ad_post = $ad_query->posts[0];

		$output = WPAdServer_Ad::render( $ad_post );

		return $output;
	}

	public static function header_footer_zones( $content ) {
		$before = self::render( 'Header' );
		$after  = self::render( 'Footer' );

		$content = $before . $content . $after;

		return $content;
	}
}

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
		$zone_ad = self::get_zone_ad( $zone );

		$output = WPAdServer_Ad::render( $zone_ad );

		return $output;
	}

	public static function header_footer_zones( $content ) {
		$before = self::render( 'Header' );
		$after  = self::render( 'Footer' );

		$content = $before . $content . $after;

		return $content;
	}

	public static function get_zone_ad( $zone ) {
		$cache_key = 'wpas_zone_' . $zone;

		$zone_ads = wp_cache_get( $cache_key, 'wpas' );

		if ( false === $zone_ads ) {
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
				'posts_per_page' => -1,
			);
	
			$ad_query = new WP_Query( $args );

			if ( ! $ad_query->post_count ) {
				return;
			}

			$zone_ids = array();

			foreach ( $ad_query->posts as $ad_post ) {
				$zone_ids[] = $ad_post->ID;
			}

			// Get a random ad.
			$zone_ad_id = mt_rand( 0, ( count( $zone_ids ) - 1 ) );

			$zone_ad_post = get_post( $zone_ids[ $zone_ad_id ] );

			$zone_ad = array(
				'url'   => get_post_meta( $zone_ad_post->ID, 'URL', true ),
				'image' => wp_get_attachment_url( get_post_thumbnail_id( $zone_ad_post->ID ), 'full' )
			);

			wp_cache_set( $cache_key, $zone_ad, 'wpas', 10 );
		}

		return $zone_ad;
	}
}

<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPAdServer_Ad {
	public static function register() {
		register_post_type(
			'wpas-ad',
			array(
				'labels'            => array(
					'name'          => __( 'Ads' ),
					'singular_name' => __( 'Ad' ),
				),
				'menu_position'     => 20,
				'show_ui'           => true,
				'show_in_admin_bar' => true,
				'taxonomies'        => array(
					'wpas-ad-zone',
				),
				'supports'          => array(
					'custom-fields',
					'thumbnail',
					'title',
				),
			)
		);
	}

	public static function render( $ad_post ) {
		// HERE

		echo '<pre>';
		print_r( $ad_post );
		echo '</pre>';

		$ad_post_meta = get_post_meta( $ad_post->ID );

		$ad_image_url = wp_get_attachment_url( get_post_thumbnail_id( $ad_post->ID ), 'full' );

		$output = sprintf( '<a href="%s" target="_blank"><img src="%s"></a>', $ad_post_meta['URL'][0], $ad_image_url );

		return $output;
	}

	public static function shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'zone' => '',
			),
			$atts
		);

		if ( empty( $atts['zone'] ) ) {
			return;
		}

		$output = WPAdServer_Ad_Zone::render( $atts['zone'] );

		return $output;
	}
}

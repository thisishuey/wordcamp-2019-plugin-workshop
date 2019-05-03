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

	public static function render( $ad ) {
		echo '<pre>';
		print_r( $ad );
		echo '</pre>';

		$output = sprintf( '<a href="%s" target="_blank"><img src="%s"></a>', $ad['url'], $ad['image'] );

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

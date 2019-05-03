<?php
/*
 * Plugin Name: WP Ad Server
 * Plugin URI: https://github.com/thisishuey/wordcamp-2019-plugin-workshop
 * Description: Serve ads for company
 * Version 1.0
 * Author: Jake Sutherland & Jeff "Huey" Huelsbeck
 * License: GPLv3
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/inc/wpas-ad.php';
require_once __DIR__ . '/inc/wpas-ad-zone.php';

require_once __DIR__ . '/actions.php';
require_once __DIR__ . '/filters.php';

// Utilize the 'Featured Image' for the ad image.
add_theme_support( 'post-thumbnails' );

// Add the [wpasad] shortcode to allow flexibility.
add_shortcode( 'wpasad', array( 'WPAdServer_Ad', 'shortcode' ) );

<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Register the 'Ad' post type.
add_action( 'init', array( 'WPAdServer_Ad', 'register' ) );

// Register the 'Ad Zone' taxonomy.
add_action( 'init', array( 'WPAdServer_Ad_Zone', 'register' ) );


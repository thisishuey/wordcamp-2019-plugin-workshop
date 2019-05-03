<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Filter the content to include the header zone at the top and footer zone at the bottom.
add_filter( 'the_content', array( 'WPAdServer_Ad_Zone', 'header_footer_zones' ) );

<?php
/**
 * Include the snippets
 *
 * @package WPCoder
 */

defined( 'ABSPATH' ) || exit;

require_once plugin_dir_path( __FILE__ ) . 'snippets/class-snippet-disabled.php';
require_once plugin_dir_path( __FILE__ ) . 'snippets/class-snippet-enabled.php';
require_once plugin_dir_path( __FILE__ ) . 'snippets/class-snippet-changed.php';
require_once plugin_dir_path( __FILE__ ) . 'snippets/class-tools.php';
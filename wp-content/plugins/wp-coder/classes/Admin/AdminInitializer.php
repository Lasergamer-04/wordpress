<?php

namespace WPCoder\Admin;

defined( 'ABSPATH' ) || exit;

// Exit if accessed directly.
use WPCoder\Dashboard\DashboardHelper;
use WPCoder\WPCoder;

class AdminInitializer {

	public static function init(): void {
		add_filter( 'plugin_action_links', [ __CLASS__, 'settings_link' ], 10, 2 );
		add_filter( 'admin_footer_text', [ __CLASS__, 'footer_text' ], 20 );
		add_action( 'admin_menu', [ __CLASS__, 'add_admin_page' ] );
		add_action( 'admin_enqueue_scripts', [ __CLASS__, 'admin_scripts' ] );
		new AdminNotices;
		new AdminActions;
	}

	public static function settings_link( $links, $file ) {
		if ( false === strpos( $file, WPCoder::basename() ) ) {
			return $links;
		}
		$link          = admin_url( 'admin.php?page=' . WPCoder::SLUG );
		$text          = esc_attr__( 'Settings', 'wp-coder' );
		$settings_link = '<a href="' . esc_url( $link ) . '">' . esc_attr( $text ) . '</a>';
		array_unshift( $links, $settings_link );

		return $links;
	}

	public static function footer_text( $footer_text ) {
		global $pagenow;

		if ( $pagenow === 'admin.php' && ( isset( $_GET['page'] ) && $_GET['page'] === WPCoder::SLUG ) ) {
			$text = sprintf(
			/* translators: 1. link to the plugin page 2. plugin name */
				__( 'Thank you for using <b>%2$s</b>! Please <a href="%1$s" target="_blank">rate us</a>', 'wp-coder' ),
				esc_url( WPCoder::PluginURL ),
				esc_attr( WPCoder::info( 'name' ) )
			);

			return str_replace( '</span>', '', $footer_text ) . ' | ' . $text . '</span>';
		}

		return $footer_text;
	}

	public static function add_admin_page(): void {
		$icon       = 'data:image/svg+xml;base64,' . base64_encode( self::icon() );
		$parent     = 'wp-coder';
		$title      = WPCoder::info( 'name' ) . ' version ' . WPCoder::info( 'version' );
		$menu_title = 'All Codes';
		$capability = 'unfiltered_html';
		$slug       = WPCoder::SLUG;

		add_menu_page( 'WP Coder Pro', 'WP Coder', 'unfiltered_html', $slug, [ __CLASS__, 'plugin_page' ], $icon );

		add_submenu_page( $slug, $title, $menu_title, $capability, $slug, [ __CLASS__, 'plugin_page' ] );

		add_submenu_page( $slug, $title, 'Add new', $capability, $slug . '-settings', [ __CLASS__, 'settings' ] );
		add_submenu_page( $slug, $title, 'Snippets', $capability, $slug . '-snippets', [ __CLASS__, 'snippets' ] );
		add_submenu_page( $slug, $title, 'Tools', $capability, $slug . '-tools', [ __CLASS__, 'tools' ] );
		add_submenu_page( $slug, $title, 'Global PHP', $capability, $slug . '-global', [ __CLASS__, 'global_php' ] );
		add_submenu_page( $slug, $title, 'Import / Export', $capability, $slug . '-import-export', [ __CLASS__, 'import_export' ] );
		add_submenu_page( $slug, $title, 'Support', $capability, $slug . '-support', [ __CLASS__, 'support' ] );
	}

	public static function icon(): string {
		return '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><title>48px_code</title><g><path d="M14.562 14.75a1.998 1.998 0 0 0-2.811-.312l-10.001 8a2 2 0 0 0 0 3.124l10 8a1.997 1.997 0 0 0 2.811-.312 2 2 0 0 0-.312-2.81L6.201 24l8.048-6.438a2 2 0 0 0 .312-2.81v-.003h.001z" fill="url(#1699598250888-4824476_nc-code-0_linear_235_116)"></path><path d="M36.25 14.438a2 2 0 0 0-2.499 3.123L41.799 24l-8.048 6.438a2 2 0 0 0 2.499 3.123l10-8a2 2 0 0 0 0-3.124l-10-8v.002z" fill="url(#1699598250888-4824476_nc-code-1_linear_235_116)"></path><path d="M29.535 4.073a2.003 2.003 0 0 0-2.462 1.392l-10 36a2 2 0 0 0 3.854 1.07l10-36a2 2 0 0 0-1.392-2.462z" fill="url(#1699598250888-4824476_nc-code-2_linear_235_116)"></path><defs><linearGradient id="1699598250888-4824476_nc-code-0_linear_235_116" x1="8" y1="13.999" x2="8" y2="34" gradientUnits="userSpaceOnUse"><stop stop-color="#5B5E71"></stop><stop offset="1" stop-color="#393A46"></stop></linearGradient><linearGradient id="1699598250888-4824476_nc-code-1_linear_235_116" x1="40" y1="13.999" x2="40" y2="33.998" gradientUnits="userSpaceOnUse"><stop stop-color="#5B5E71"></stop><stop offset="1" stop-color="#393A46"></stop></linearGradient><linearGradient id="1699598250888-4824476_nc-code-2_linear_235_116" x1="24" y1="4" x2="24" y2="44" gradientUnits="userSpaceOnUse"><stop stop-color="#E0E0E6"></stop><stop offset="1" stop-color="#C2C3CD"></stop></linearGradient></defs></g></svg>';
	}

	public static function plugin_page(): void {
		$page_path = DashboardHelper::get_folder_path( 'pages' ) . '/1.list.php';

		if ( file_exists( $page_path ) ) {
			require_once $page_path;
		}
	}

	public static function settings(): void {
		$page_path = DashboardHelper::get_folder_path( 'pages' ) . '/2.settings.php';

		if ( file_exists( $page_path ) ) {
			require_once $page_path;
		}
	}

	public static function snippets() {
		$page_path = DashboardHelper::get_folder_path( 'pages' ) . '/3.snippets.php';

		if ( file_exists( $page_path ) ) {
			require_once $page_path;
		}
	}

	public static function tools() {
		$page_path = DashboardHelper::get_folder_path( 'pages' ) . '/4.tools.php';

		if ( file_exists( $page_path ) ) {
			require_once $page_path;
		}
	}

	public static function global_php() {
		$page_path = DashboardHelper::get_folder_path( 'pages' ) . '/5.global-php.php';

		if ( file_exists( $page_path ) ) {
			require_once $page_path;
		}
	}


	public static function import_export() {
		$page_path = DashboardHelper::get_folder_path( 'pages' ) . '/6.import-export.php';

		if ( file_exists( $page_path ) ) {
			require_once $page_path;
		}
	}

	public static function support() {
		$page_path = DashboardHelper::get_folder_path( 'pages' ) . '/7.support.php';

		if ( file_exists( $page_path ) ) {
			require_once $page_path;
		}
	}


	public static function admin_scripts( $hook ): void {
//		$page       = 'toplevel_page_' . WPCoder::SLUG;
		$assets_url = WPCoder::url() . 'assets/';
		wp_enqueue_style( 'wowp-general-admin', $assets_url . 'css/admin-general.css' );

		$page = isset( $_GET['page'] ) ? sanitize_text_field( $_GET['page'] ) : '';

		if ( strpos( $page, WPCoder::SLUG ) === false ) {
			return;
		}

		do_action( WPCoder::PREFIX . '_admin_load_styles_scripts' );
	}

}
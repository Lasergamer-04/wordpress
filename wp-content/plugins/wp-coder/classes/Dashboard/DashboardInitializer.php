<?php

namespace WPCoder\Dashboard;

defined( 'ABSPATH' ) || exit;

use WPCoder\WPCoder;

class DashboardInitializer {

	public static function init(): void {
		self::header();
		echo '<div class="wrap wowp-wrap">';
//		self::menu();
//		self::include_pages();
		echo '</div>';
	}

	public static function header(): void {
		$logo_url = self::logo_url();
		$add_url  = add_query_arg( [
			'page'   => WPCoder::SLUG,
			'tab'    => 'settings',
			'action' => 'new'
		], admin_url( 'admin.php' ) );
		?>

        <div class="wowp-header">
            <div class="wowp-header__logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64">
                    <g fill="#212121">
                        <path d="M19.562,18.75c-.69-.862-1.948-1.003-2.811-.312L1.75,30.438c-.474,.379-.75,.954-.75,1.562s.276,1.182,.75,1.562l15,12c.369,.295,.81,.438,1.248,.438,.587,0,1.168-.257,1.563-.75,.69-.863,.55-2.121-.312-2.811l-13.048-10.438,13.048-10.438c.862-.69,1.002-1.948,.312-2.811Z" fill="#fa2222"></path>
                        <path d="M47.25,18.438c-.862-.691-2.121-.55-2.811,.312-.69,.863-.55,2.121,.312,2.811l13.048,10.438-13.048,10.438c-.862,.69-1.002,1.948-.312,2.811,.395,.494,.976,.75,1.563,.75,.438,0,.879-.143,1.248-.438l15-12c.474-.379,.75-.954,.75-1.562s-.276-1.182-.75-1.562l-15-12Z" fill="#5522fa"></path>
                        <path d="M39.539,5.074c-1.063-.298-2.167,.324-2.465,1.387l-14,50c-.298,1.063,.323,2.167,1.387,2.465,.18,.051,.362,.075,.54,.075,.875,0,1.678-.578,1.925-1.461L40.926,7.539c.298-1.063-.323-2.167-1.387-2.465Z" fill="#5522fa"></path></g>
                </svg>
            </div>
            <h1 class="wowp-header__title">
				<?php echo esc_html( WPCoder::info( 'name' ) ); ?>
                <sup class="wowp-header__title-version"><?php echo esc_html( WPCoder::info( 'version' ) ); ?></sup>
            </h1>
            <div class="wowp-header__links">
				<?php do_action( WPCoder::PREFIX . '_admin_header_links' ); ?>
            </div>
        </div>


		<?php
	}

	public static function logo_url(): string {
		$logo_url = WPCoder::url() . 'assets/img/plugin-logo.png';
		if ( filter_var( $logo_url, FILTER_VALIDATE_URL ) !== false ) {
			return $logo_url;
		}

		return '';
	}

	public static function menu(): void {

		$pages = DashboardHelper::get_files( 'pages' );
		unset( $pages["3"], $pages["4"] );

		$current_page = self::get_current_page();

		$action = ( isset( $_REQUEST["action"] ) ) ? sanitize_text_field( $_REQUEST["action"] ) : '';

		echo '<h2 class="nav-tab-wrapper wowp-nav-tab-wrapper">';
		foreach ( $pages as $key => $page ) {
			$class = ( $page['file'] === $current_page ) ? ' nav-tab-active' : '';
			$id    = '';

			if ( $action === 'update' && $page['file'] === 'settings' ) {
				$id           = ( isset( $_REQUEST["id"] ) ) ? absint( $_REQUEST["id"] ) : '';
				$page['name'] = __( 'Update', 'wp-coder' ) . ' #' . $id;
			} elseif ( $page['file'] === 'settings' && ( $action !== 'new' && $action !== 'duplicate' ) ) {
				continue;
			}

			echo '<a class="nav-tab' . esc_attr( $class ) . '" href="' . esc_url( Link::menu( $page['file'], $action, $id ) ) . '">' . esc_html( $page['name'] ) . '</a>';
		}
		echo '</h2>';


	}

	public static function include_pages(): void {
		$current_page = self::get_current_page();

		$pages   = DashboardHelper::get_files( 'pages' );
		$default = DashboardHelper::first_file( 'pages' );

		$current = DashboardHelper::search_value( $pages, $current_page ) ? $current_page : $default;

		$file = DashboardHelper::get_file( $current, 'pages' );


		if ( $file !== false ) {
			$file = apply_filters( WPCoder::PREFIX . '_admin_filter_file', $file, $current );

			$page_path = DashboardHelper::get_folder_path( 'pages' ) . '/' . $file;

			if ( file_exists( $page_path ) ) {
				require_once $page_path;
			}
		}

	}


	public static function get_current_page(): string {
		$default = DashboardHelper::first_file( 'pages' );

		return ( isset( $_REQUEST["tab"] ) ) ? sanitize_text_field( $_REQUEST["tab"] ) : $default;
	}


}
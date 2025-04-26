<?php

use WPCoder\Dashboard\DBManager;
use WPCoder\Dashboard\FolderManager;
use WPCoder\WPCoder;

defined( 'ABSPATH' ) || exit;

class WPCoder_Lite_Tools {

	/**
	 * @var false|mixed|null
	 */
	private $options;

	public function __construct() {
		$options       = get_option( '_wp_coder_tools', [] );
		$this->options = $options;

		if ( array_key_exists( 'enable_tracking_tool', $options ) ) {
			add_action( 'wp_head', [ $this, 'add_tracking' ] );
		}

		if ( array_key_exists( 'enable_google_adsense', $options ) ) {
			add_action( 'wp_head', array( $this, 'add_adsense_code' ) );
		}
	}

	public function add_tracking(): void {

		$user = wp_get_current_user();

		if ( ! empty( $user->roles ) ) {
			foreach ( $user->roles as $role ) {
				if ( array_key_exists( 'disable_tracking_tool_user_' . $role, $this->options ) ) {
					return;
				}
			}
		}

		// Google Analytics code
		if ( ! empty( $this->options['tracking_tool_google'] ) ) { ?>
            <script async
                    src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $this->options['tracking_tool_google'] ); ?>"></script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }

                gtag("js", new Date());
                gtag("config", "<?php echo esc_attr( $this->options['tracking_tool_google'] ); ?>");
            </script>
		<?php }

		// Facebook Pixel code
		if ( ! empty( $this->options['tracking_tool_facebook'] ) ) { ?>
            <script>
                !function (f, b, e, v, n, t, s) {
                    if (f.fbq) return;
                    n = f.fbq = function () {
                        n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                    };
                    if (!f._fbq) f._fbq = n;
                    n.push = n;
                    n.loaded = !0;
                    n.version = '2.0';
                    n.queue = [];
                    t = b.createElement(e);
                    t.async = !0;
                    t.src = v;
                    s = b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t, s)
                }(window, document, 'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '<?php echo esc_attr( $this->options['tracking_tool_facebook'] ); ?>');
                fbq('track', 'PageView');
            </script>
            <noscript>
                <img height="1" width="1" style="display:none"
                     src="https://www.facebook.com/tr?id=<?php echo esc_attr( $this->options['tracking_tool_facebook'] ); ?>&ev=PageView&noscript=1"/>
            </noscript>
		<?php }

		// Pintrest Pixel code
		if ( ! empty( $this->options['tracking_tool_pintrest'] ) ) { ?>
            <script type="text/javascript">
                !function (e) {
                    if (!window.pintrk) {
                        window.pintrk = function () {
                            window.pintrk.queue.push(Array.prototype.slice.call(arguments))
                        };
                        var n = window.pintrk;
                        n.queue = [], n.version = "3.0";
                        var t = document.createElement("script");
                        t.async = !0, t.src = e;
                        var r = document.getElementsByTagName("script")[0];
                        r.parentNode.insertBefore(t, r)
                    }
                }("https://s.pinimg.com/ct/core.js");
                pintrk('load', '<?php echo esc_attr( $this->options['tracking_tool_pintrest'] ); ?>');
                pintrk('page');
            </script>
            <noscript>
                <img height="1" width="1" style="display:none;" alt=""
                     src="https://ct.pinterest.com/v3/?tid=<?php echo esc_attr( $this->options['tracking_tool_pintrest'] ); ?>&noscript=1"/>
            </noscript>
		<?php }
	}

	public function add_adsense_code(): void {

		if ( empty( $this->options['google_adsense_publisher'] ) ) {
			return;
		}

		$user = wp_get_current_user();

		if ( ! empty( $user->roles ) ) {
			foreach ( $user->roles as $role ) {
				if ( array_key_exists( 'disable_google_adsense_user_' . $role, $this->options ) ) {
					return;
				}
			}
		}

		// phpcs:disable WordPress.WP.EnqueuedResources.NonEnqueuedScript
		echo '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-' . esc_attr( $this->options['google_adsense_publisher'] ) . '" crossorigin="anonymous"></script>';
		// phpcs:enable
	}


}

new WPCoder_Lite_Tools;
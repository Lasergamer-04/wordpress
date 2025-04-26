<?php
/*
 * Page Name: PRO Features
 */

defined( 'ABSPATH' ) || exit;

$features = [
	[
		'icon'  => 'icon icon-template',
		'title' => __( 'Create Custom Templates', 'wp-coder' ),
		'desc'  => __( 'Design unique templates for pages, posts, categories, and other content types. Infuse your custom HTML, CSS, or PHP to build layouts that perfectly match your brand and functionality goals.', 'wp-coder' ),
	],
	[
		'icon'  => 'icon icon-document',
		'title' => __( 'Create Page Templates', 'wp-coder' ),
		'desc'  => __( 'Create custom page templates by name. Use them when editing pages to apply specific layouts or functionality.', 'wp-coder' ),
	],
	[
		'icon'  => 'icon icon-finger-snap',
		'title' => __( 'Enable QuickCode', 'wp-coder' ),
		'desc'  => __( 'Use QuickCodes in your content or templates to dynamically insert values like object ID or site options.', 'wp-coder' ),
	],
	[
		'icon'  => 'dashicons dashicons-shortcode',
		'title' => __( 'Shortcode Attributes', 'wp-coder' ),
		'desc'  => __( 'Add dynamic attributes to your shortcodes and use them directly in your HTML or PHP code. Perfect for creating flexible, reusable components that adapt to different content inputs.', 'wp-coder' ),
	],
	[
		'icon'  => 'icon icon-crosshair',
		'title' => __( 'Display Rules', 'wp-coder' ),
		'desc'  => __( 'Choose where your code appears — target specific pages, posts, categories, or custom post types. Perfect for displaying code snippets only in the right context.', 'wp-coder' ),
	],

	[
		'icon'  => 'icon icon-meeting',
		'title' => __( 'User Roles', 'wp-coder' ),
		'desc'  => __( 'Control visibility by user role. Display content only to subscribers, contributors, authors, editors, or administrators — or hide it from them.', 'wp-coder' ),
	],

	[
		'icon'  => 'icon icon-calendar',
		'title' => __( 'Schedule', 'wp-coder' ),
		'desc'  => __( 'Set start and end times, weekdays, or exact date ranges. This makes it easy to show limited-time offers, seasonal content, or schedule maintenance notices.', 'wp-coder' ),
	],

	[
		'icon'  => 'icon icon-lock-portrait',
		'title' => __( 'Hide on Mobile', 'wp-coder' ),
		'desc'  => __( 'Disable code on mobile devices. Useful for content or layouts that should appear only on desktop for optimal experience.', 'wp-coder' ),
	],

	[
		'icon'  => 'icon icon-pc',
		'title' => __( 'Hide on Desktop', 'wp-coder' ),
		'desc'  => __( 'Hide your code on desktop and show only on mobile. Great for mobile-specific banners or simplified layouts.', 'wp-coder' ),
	],

    [
		'icon'  => 'icon icon-translation',
		'title' => __( 'By Language', 'wp-coder' ),
		'desc'  => __( 'Display code based on the visitor’s browser language. Personalize your content for multilingual audiences without switching sites.', 'wp-coder' ),
	],

	[
		'icon'  => 'icon icon-browser-chrome',
		'title' => __( 'Hide in Browsers', 'wp-coder' ),
		'desc'  => __( 'Exclude specific browsers from rendering your code. Useful for avoiding compatibility issues or browser-specific bugs.', 'wp-coder' ),
	],

	[
		'icon'  => 'icon icon-login',
		'title' => __( 'Enable Style and Script on Login Page', 'wp-coder' ),
		'desc'  => __( 'Add custom CSS and JS to the WordPress login page to match your branding or add extra functionality.', 'wp-coder' ),
	],

	[
		'icon'  => 'icon icon-construction',
		'title' => __( 'Enable Maintenance Mode', 'wp-coder' ),
		'desc'  => __( 'Display a clean maintenance page for visitors while logged-in admins continue working normally on the site.', 'wp-coder' ),
	],

    [
		'icon'  => 'icon icon-clear',
		'title' => __( 'Remove Enqueued Scripts & Styles', 'wp-coder' ),
		'desc'  => __( 'Clean up your front end by removing unnecessary styles or scripts. Just enter the handle (ID) used in WordPress enqueue functions to stop them from loading. Perfect for performance tuning and avoiding conflicts.', 'wp-coder' ),
	],
    [
		'icon'  => 'icon icon-list',
		'title' => __( 'Register Menu', 'wp-coder' ),
		'desc'  => __( 'Automatically register a WordPress menu if one isn’t already created. Great for fresh installations.', 'wp-coder' ),
	],

];

?>


    <div class="wowp-pro">
        <div class="wowp-fieldset__header">
            <div class="wowp-fieldset__header-title">
                Unlock More with WP Coder Pro 🚀
                <p>Supercharge your development experience with advanced features and tools.</p>
            </div>

            <div class="wowp-fieldset__header-button">
                <a href="https://wpcoder.pro/pricing/" target="_blank" class="wowp-button button button-dark">Get
                    Pro</a>
            </div>
        </div>

        <div class="wowp-pro__features">

		    <?php foreach ( $features as $feature ) : ?>
                    <div class="wowp-pro__feature">
                        <div class="wowp-pro-feature__icon">
                            <span class="<?php echo esc_attr( $feature['icon'] ); ?>"></span>
                        </div>
                        <div class="wowp-pro-feature__content">
                            <div class="wowp-pro-feature__title">
							    <?php echo esc_html( $feature['title'] ); ?>
                            </div>
                            <div class="wowp-pro-feature__desc">
							    <?php echo esc_html( $feature['desc'] ); ?>
                            </div>
                        </div>
                    </div>
		    <?php endforeach; ?>

        </div>

    </div>

<?php


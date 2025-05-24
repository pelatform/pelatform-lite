<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! defined( 'PELATFORM_LITE_VERSION' ) ) {
	define( 'PELATFORM_LITE_VERSION', '1.0.1' );
}

if ( ! defined( 'PELATFORM_LITE_PATH' ) ) {
	define( 'PELATFORM_LITE_PATH', trailingslashit( get_template_directory() ) );
}

if ( ! defined( 'PELATFORM_LITE_URL' ) ) {
	define( 'PELATFORM_LITE_URL', trailingslashit( get_template_directory_uri() ) );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function pelatform_lite_setup() {
	load_theme_textdomain( 'pelatform-lite', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'custom-logo' );

	add_post_type_support( 'page', 'excerpt' );

	add_theme_support(
		'html5',
		apply_filters(
			'pelatform_lite_html5_args',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'widgets',
				'style',
				'script',
			)
		)
	);

	add_theme_support( 'title-tag' );

	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'align-wide' );

	add_theme_support( 'editor-styles' );

	add_theme_support( 'responsive-embeds' );

	remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'pelatform_lite_setup' );

/**
 * Enqueue scripts theme.
 */
function pelatform_lite_scripts_theme() {
	wp_enqueue_style( 'pelatform-lite', PELATFORM_LITE_URL . 'style.css', false, PELATFORM_LITE_VERSION, 'all' );
}
add_action( 'wp_enqueue_scripts', 'pelatform_lite_scripts_theme' );

/**
 * Disable default WordPress new user notifications and replace with custom notifications.
 *
 * This function removes the default new user notifications sent by WordPress and replaces them
 * with a custom implementation using the `pelatform_lite_send_new_user_notifications` function.
 *
 * @since 1.0.0
 * @return void
 */
function pelatform_lite_disable_new_user_notifications() {
	// Remove original user created emails.
	remove_action( 'register_new_user', 'wp_send_new_user_notifications' );
	remove_action( 'edit_user_created_user', 'wp_send_new_user_notifications', 10, 2 );

	// Add custom notifications.
	add_action( 'register_new_user', 'pelatform_lite_send_new_user_notifications' );
	add_action( 'edit_user_created_user', 'pelatform_lite_send_new_user_notifications', 10, 2 );
}
add_action( 'init', 'pelatform_lite_disable_new_user_notifications' );

/**
 * Send custom new user notifications.
 *
 * This function replaces the default WordPress new user notifications. It only sends notifications
 * to the user and skips admin notifications.
 *
 * @since 1.0.0
 * @param int    $user_id The ID of the new user.
 * @param string $notify  The type of notification to send. Possible values are 'admin', 'user', or 'both'.
 *                        Default is 'user'.
 * @return void
 */
function pelatform_lite_send_new_user_notifications( $user_id, $notify = 'user' ) {
	if ( empty( $notify ) || 'admin' === $notify ) {
		return;
	} elseif ( 'both' === $notify ) {
		// Only send the new user their email, not the admin.
		$notify = 'user';
	}
	wp_send_new_user_notifications( $user_id, $notify );
}

/**
 * Registers navigation menu locations for the theme.
 *
 * This function registers the 'primary' menu location to be used
 * with wp_nav_menu(). It allows users to assign a custom menu
 * via the WordPress admin under Appearance > Menus.
 *
 * @since 1.0.0
 * @return void
 */
function pelatform_lite_register_menus() {
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'pelatform-lite' ),
		)
	);
}
add_action( 'after_setup_theme', 'pelatform_lite_register_menus' );

/**
 * Custom comment callback
 *
 * @since 1.0.1
 * @param WP_Comment $comment Comment object.
 * @param array      $args    Arguments passed to the callback.
 * @param int        $depth   Depth of the current comment in the tree.
 */
function pelatform_lite_comment_callback( $comment, $args, $depth ) {
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment' ); ?>>
		<article class="comment-body">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
				<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
			</div>

			<div class="comment-metadata">
				<time datetime="<?php comment_time( 'c' ); ?>">
					<?php
					printf(
						/* translators: 1: Comment date, 2: Comment time */
						esc_html__( '%1$s at %2$s', 'pelatform-lite' ),
						esc_html( get_comment_date() ),
						esc_html( get_comment_time() )
					);
					?>
				</time>
				<?php edit_comment_link( __( 'Edit', 'pelatform-lite' ), ' <span class="edit-link">', '</span>' ); ?>
			</div>

			<div class="comment-content">
				<?php comment_text(); ?>
			</div>

			<div class="reply">
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
						)
					)
				);
				?>
			</div>
		</article>
	<?php
}

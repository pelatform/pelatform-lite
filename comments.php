<?php
/**
 * The template for displaying comments
 *
 * @package Pelatform_Lite
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Don't load comments if password is required
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="mt-12 comments-area">
	<?php if ( have_comments() ) : ?>
		<h3 class="mb-8 comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				printf(
					/* translators: %s: Post title. */
					esc_html__( 'One comment on &ldquo;%s&rdquo;', 'pelatform-lite' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: Number of comments, 2: Post title. */
					esc_html( _n( '%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $comments_number, 'pelatform-lite' ) ),
					esc_html( number_format_i18n( $comments_number ) ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h3>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 60,
					'callback'    => 'pelatform_lite_comment_callback',
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note.
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'pelatform-lite' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form(
		array(
			'class_form'         => 'comment-form mt-8',
			'title_reply'        => esc_html__( 'Leave a Comment', 'pelatform-lite' ),
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h3>',
		)
	);
	?>
</div>

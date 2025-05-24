<?php
/**
 * The template for displaying all single posts
 *
 * @package Pelatform_Lite
 */

get_header();

if ( function_exists( 'edd__utils' ) ) {
	edd__utils( 'template', 'is_header' );
	edd__utils( 'template', 'is_navbar' );
}
?>

<div id="blog" class="section">
	<div class="f-flex container-box">
		<div class="max-w-(--breakpoint-lg) py-10 mx-auto lg:py-20">
			<h2 class="text-xl font-medium text-center text-dark dark:text-light md:text-2xl"><?php the_title(); ?></h2>
			
			<!-- Post Meta -->
			<div class="text-center post-meta">
				<span class="post-date">
					<?php echo get_the_date(); ?> -
				</span>
				<span class="post-author">
					<?php
					$author_id   = get_post_field( 'post_author', get_the_ID() );
					$author_name = get_the_author_meta( 'display_name', $author_id );
					echo esc_html( $author_name );
					?>
					-
				</span>
				<span class="post-category">
					<?php the_category( ', ' ); ?>
				</span>
			</div>
		</div>

		<div class="relative w-full lg:max-w-[900px] mx-auto p-8 overflow-hidden rounded-md bg-light shadow-card dark:bg-dark-200 dark:shadow-none md:p-10 lg:p-16 lg:flex-row mb-8 lg:mb-12">
			<!-- Featured Image -->
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="mb-8 post-thumbnail">
				<?php the_post_thumbnail( 'large', array( 'class' => 'w-full rounded-lg' ) ); ?>
			</div>
			<?php endif; ?>

			<div class="w-full max-w-full prose dark:prose-invert">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>

				<!-- Tags -->
				<?php if ( has_tag() ) : ?>
				<div class="mt-8 post-tags">
					<span class="font-bold"><?php esc_html_e( 'Tags:', 'pelatform-lite' ); ?></span>
					<?php the_tags( '', ', ' ); ?>
				</div>
				<?php endif; ?>

				<!-- Author Box -->
				<div class="p-6 mt-12 bg-gray-100 rounded-lg author-box dark:bg-dark-300">
					<div class="flex items-center">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 60, '', '', array( 'class' => 'rounded-full' ) ); ?>
						<div class="ml-4">
							<h4 class="font-bold"><?php the_author(); ?></h4>
							<p class="text-sm"><?php the_author_meta( 'description' ); ?></p>
						</div>
					</div>
				</div>

				<!-- Post Navigation -->
				<div class="flex justify-between mt-12 post-navigation">
					<?php
					$prev_post = get_previous_post();
					$next_post = get_next_post();
					?>
					<div class="prev-post">
						<?php if ( ! empty( $prev_post ) ) : ?>
							<span class="block text-sm"><?php esc_html_e( 'Previous Post', 'pelatform-lite' ); ?></span>
							<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>"><?php echo esc_html( $prev_post->post_title ); ?></a>
						<?php endif; ?>
					</div>
					<div class="text-right next-post">
						<?php if ( ! empty( $next_post ) ) : ?>
							<span class="block text-sm"><?php esc_html_e( 'Next Post', 'pelatform-lite' ); ?></span>
							<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>"><?php echo esc_html( $next_post->post_title ); ?></a>
						<?php endif; ?>
					</div>
				</div>

				<!-- Comments -->
				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>
			</div>
		</div>
	</div>
</div>

<?php
if ( function_exists( 'edd__utils' ) ) {
	edd__utils( 'template', 'is_footer' );
}
get_footer();

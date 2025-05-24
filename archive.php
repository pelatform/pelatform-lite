<?php
/**
 * The template for displaying archive pages
 *
 * @package Pelatform_Lite
 */

if ( function_exists( 'edd__utils' ) ) {
	edd__utils( 'template', 'is_header' );
	edd__utils( 'template', 'is_navbar' );
} else {
	get_header();
}
?>

<div id="blog" class="py-10 section lg:py-20">
	<div class="mx-auto container-box">
		<div class="max-w-[800px] mx-auto mb-12">
			<h2 class="mb-4 text-xl font-medium text-center text-dark dark:text-light md:text-2xl">
				<?php
				if ( is_category() ) {
					single_cat_title();
				} elseif ( is_tag() ) {
					single_tag_title();
				} else {
					esc_html_e( 'Blog', 'pelatform-lite' );
				}
				?>
			</h2>
			<?php
			if ( is_archive() ) {
				the_archive_description( '<div class="text-center text-gray-600 archive-description dark:text-gray-400">', '</div>' );
			}
			?>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'flex flex-col bg-light dark:bg-dark-200 rounded-lg overflow-hidden shadow-card dark:shadow-none' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="block relative pt-[56.25%]">
								<?php the_post_thumbnail( 'medium_large', array( 'class' => 'absolute inset-0 w-full h-full object-cover' ) ); ?>
							</a>
						<?php endif; ?>

						<div class="flex flex-col flex-1 p-6">
							<div class="mb-4 text-sm text-gray-600 post-meta dark:text-gray-400">
								<span class="post-date">
									<?php echo get_the_date(); ?>
								</span>
								<span class="mx-2">•</span>
								<span class="post-author">
									<?php the_author(); ?>
								</span>
							</div>

							<h3 class="flex-none mb-4 text-xl font-bold">
								<a href="<?php the_permalink(); ?>" class="transition-colors hover:text-primary">
									<?php the_title(); ?>
								</a>
							</h3>

							<div class="flex-1 mb-4 text-gray-600 dark:text-gray-400">
								<?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?>
							</div>

							<div class="flex items-center justify-between pt-4 mt-auto border-t border-gray-200 dark:border-gray-700">
								<div class="text-sm post-category">
									<?php the_category( ', ' ); ?>
								</div>
								<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-sm font-medium transition-colors text-primary hover:text-primary-dark">
									<?php esc_html_e( 'Read More', 'pelatform-lite' ); ?>
									<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
									</svg>
								</a>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<div class="flex justify-center mt-12">
				<?php
				$args = array(
					'base'               => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
					'format'             => '?paged=%#%',
					'current'            => max( 1, get_query_var( 'paged' ) ),
					'total'              => $wp_query->max_num_pages,
					'type'               => 'list',
					'mid_size'           => 1,
					'prev_text'          => '<span class="flex items-center justify-center w-10 h-10"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></span>',
					'next_text'          => '<span class="flex items-center justify-center w-10 h-10"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>',
					'before_page_number' => '<span class="flex items-center justify-center w-10 h-10">',
					'after_page_number'  => '</span>',
				);
				?>
				<nav class="inline-flex items-center overflow-hidden bg-white rounded-lg shadow-sm dark:bg-dark-200" aria-label="<?php esc_attr_e( 'Posts Navigation', 'pelatform-lite' ); ?>">
					<?php echo paginate_links( $args ); ?>
				</nav>
			</div>

		<?php else : ?>
			<div class="py-20 text-center">
				<h3 class="mb-4 text-xl"><?php esc_html_e( 'No posts found.', 'pelatform-lite' ); ?></h3>
				<p class="text-gray-600 dark:text-gray-400"><?php esc_html_e( 'It seems we can\'t find what you\'re looking for.', 'pelatform-lite' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php
if ( function_exists( 'edd__utils' ) ) {
	edd__utils( 'template', 'is_footer' );
} else {
	get_footer();
}

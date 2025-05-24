<?php
/**
 * Template part for displaying posts
 *
 * @package Pelatform_Lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'flex flex-col bg-light dark:bg-dark-200 rounded-lg overflow-hidden shadow-card dark:shadow-none' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="block relative pt-[56.25%]">
			<?php the_post_thumbnail( 'medium_large', array( 'class' => 'absolute inset-0 w-full h-full object-cover' ) ); ?>
		</a>
	<?php endif; ?>

	<div class="flex flex-col flex-1 p-6">
		<div class="mb-4 text-sm text-gray-600 post-meta dark:text-gray-400">
			<span class="post-date"><?php echo get_the_date(); ?></span>
			<span class="mx-2">•</span>
			<span class="post-author"><?php the_author(); ?></span>
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

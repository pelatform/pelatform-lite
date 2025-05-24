<?php get_header(); ?>

<main id="main" class="site-main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>

				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'pelatform-lite' ),
						'after'  => '</div>',
					)
				);
				?>
			</article>

			<?php
		endwhile;
	endif;
	?>
</main>

<?php get_footer(); ?>

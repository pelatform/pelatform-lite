<?php
/**
 * The main template file
 *
 * @package Pelatform_Lite
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

get_header();

if ( function_exists( 'edd__utils' ) ) {
    edd__utils( 'template', 'is_header' );
    edd__utils( 'template', 'is_navbar' );
}
?>

<div id="blog" class="py-10 section lg:py-20">
    <div class="mx-auto container-box">
        <!-- Blog Posts -->
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'templates/content', get_post_type() );
                endwhile;
                ?>
            </div>

            <div class="flex justify-center mt-12">
                <?php the_posts_pagination(); ?>
            </div>

        <?php else : ?>
            <?php get_template_part( 'templates/content', 'none' ); ?>
        <?php endif; ?>
    </div>
</div>

<?php
if ( function_exists( 'edd__utils' ) ) {
    edd__utils( 'template', 'is_footer' );
}
get_footer();

<?php
/**
 * The main template file
 *
 * @package Pelatform_Lite
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( function_exists( 'edd__utils' ) ) {
    edd__utils( 'template', 'is_header' );
    edd__utils( 'template', 'is_navbar' );
} else {
    get_header();
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
            <?php get_template_part( 'templates/content', 'none' ); ?>
        <?php endif; ?>
    </div>
</div>

<?php
if ( function_exists( 'edd__utils' ) ) {
    edd__utils( 'template', 'is_footer' );
} else {
    get_footer();
}

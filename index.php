<?php

get_header();

global $wp_query;
$params = isset($_GET['cats']) && $_GET['cats']  ? wp_strip_all_tags($_GET['cats']) : "";

if ($params) {
    $params_slit = explode('-', $params);
}

$total_posts = $wp_query->found_posts;
$posts_per_show = count($wp_query->posts);

$categories = get_field('filter_terms', 'options');

if(!$categories) {
    $categories =  get_terms( array(
        'taxonomy'   => 'category',
        'hide_empty' => false,
    ) );

    $categories = array_filter( (array) $categories, function($cat) {
        return $cat->slug !== 'uncategorized';
    });
}

?>

<section class="posts">
    <div style="position:relative" class="posts_grid">
        <h1 class="heading-primary resource-center-title"><?php esc_html_e('Resources', 'kernutt-software'); ?></h1>
        <div class="posts_filters">
            <div class="filter-wrapper">
                <div class="posts_filters_panel">

                </div>
            </div>

            <div class="posts_filters_selection">

                <?php if ($categories) : ?>

                    <div class="posts_filter">
                        <div class="posts_filter_top">
                            <?php esc_html_e('Filter by category', 'kernutt-software'); ?>
                        </div>
                        <div style="display: none;" class="posts_filter_bottom">

                            <?php
                            if ($categories) :
                                foreach ($categories as $cat) :

                            ?>
                                    <div class='post-category'>
                                        <input <?php if (isset($params_slit) && in_array($cat->term_id, $params_slit)) echo 'checked=checked'; ?> class="post_categories" type="checkbox" id="<?php echo $cat->term_id; ?>" name="post-category" value="<?php echo $cat->term_id; ?>">
                                        <label for="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></label>
                                    </div>

                            <?php

                                endforeach;
                            endif;

                            ?>

                        </div>
                    </div>

                <?php endif; ?>

            </div>

            <a class="blog_reset" href="<?php echo get_post_type_archive_link( 'post' ); ?>"> <?php esc_html_e('Clear All', 'kernutt-software'); ?></a>

        </div>
        <div class="posts_grid_inner">

            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', 'post');
                endwhile;
            else :

            ?>
                <p class="filter_no_results"> <?php esc_html_e('No results for the given terms.', 'kernutt-software'); ?> </p>
            <?php

            endif;
            ?>
        </div>

        <div class="load_more_container">
            <a class="load-more-filter <?php if ($posts_per_show >= $total_posts) echo "hidden"; ?>" href="#"><?php esc_html_e('Load More', 'kernutt-software'); ?></a>
        </div>

    </div>
</section>

<div style="display: none;" class="loader-wrapper">
    <span class="loader"></span>
</div>



<?php get_footer();

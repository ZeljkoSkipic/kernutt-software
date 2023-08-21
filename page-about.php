<?php

/*
Template Name: About
Template Post Type: page
*/

get_header();

?>

<div class="ks_about_page ks_page_content">
	<?php the_post_thumbnail(); ?>
	<?php get_template_part('template-parts/about'); ?>
</div>
<?php

get_footer();

<?php

/*
Template Name: Solutions
Template Post Type: page
*/

get_header();

?>

<div class="ks_software_solutions ks_page_content">
	<div class="ks_ss_hero space_3_2">
		<h1 class="title-1"><?php the_title(); ?></h1>
	</div>
	<div class="ks_ss_inner space_2_3 container">
	<?php get_template_part('components/info-box'); ?>
	</div>
</div>
<?php

get_footer();

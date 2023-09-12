<?php

/*
Template Name: Contact
Template Post Type: page
*/

get_header();

?>

<div class="ks_about_page ks_page_content">
<div class="ks_contact_top">
	<h1><?php the_title(); ?></h1>
</div>

	<div class="ks_contact_inner">
		<div class="ks_col">
			<?php
			$image = get_field('image');
			$size = 'full';
			if( $image ) {
				echo wp_get_attachment_image( $image, $size, "", array( "class" => "image" ) );
			} ?>
			<?php the_field('caption'); ?>
		</div>
		<div class="ks_col body-1">
			<?php the_field('description'); ?>
		</div>
		<div class="ks_col">
			<?php the_field('form_shortcode'); ?>
		</div>
	</div>
</div>
<?php

get_footer();

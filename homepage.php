<?php

/*
Template Name: Homepage
Template Post Type: page
*/

get_header();

?>

<div class="ks_homepage">

<?php

if( have_rows('carousel') ): ?>
	<div class="ks_home_carousel">
	<?php while( have_rows('carousel') ) : the_row(); ?>

		<?php
		$title = get_sub_field('title');
		$text = get_sub_field('text');  ?>

		<div class="carousel-cell">
		<?php
		$background_image = get_sub_field('background_image');
		$size = 'full';
		if( $background_image ) {
			echo wp_get_attachment_image( $background_image, $size, "", array( "class" => "background_image" ) );
		} ?>

			<div class="ks_hc_inner">
				<h3><?php echo $title; ?></h3>
				<div><?php echo $text; ?></div>
			</div>
		</div>
	<?php endwhile; ?>
	</div>
<?php endif; ?>


</div>

<script>
jQuery(function($){
	$('.ks_home_carousel').flickity({
	// options
	cellAlign: 'left',
	contain: true,
	pageDots: false
	});
});
</script>

<?php

get_footer();

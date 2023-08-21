<?php

/*
Template Name: Homepage
Template Post Type: page
*/

get_header();

?>

<div class="ks_homepage ks_page_content">

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
	<div class="ks_home_sec1 space_2_0">
		<div class="ks_hs1_inner container">
			<h2 class="title-1"><?php the_field('sec1_title'); ?></h2>
			<div class="sec1_text body-1"><?php the_field('sec1_text'); ?></div>
			<div class="sec1_images">
				<?php
				$sec1_image_1 = get_field('sec1_image_1');
				$size = 'full';
				if( $sec1_image_1 ) {
					echo wp_get_attachment_image( $sec1_image_1, $size, "", array( "class" => "sec1_image_1" ) );
				} ?>
				<?php
				$sec1_image_2 = get_field('sec1_image_2');
				if( $sec1_image_2 ) {
					echo wp_get_attachment_image( $sec1_image_2, $size, "", array( "class" => "sec1_image_2" ) );
				} ?>
			</div>
		</div>
	</div>

	<div class="ks_home_sec2">
		<div class="bg_img">
			<?php
			$background_image = get_field('background_image');
			$size = 'full';
			if( $background_image ) {
				echo wp_get_attachment_image( $background_image, $size, "", array( "class" => "backgr$background_image" ) );
			} ?>
		</div>
		<div class="ks_hs2_inner space_1_3 container">
		<?php get_template_part('components/info-box'); ?>
		</div>
		<div class="cta_track space_3">
			<div class="container">
				<h3 class="title-2"><?php the_field('track_text'); ?></h3>
				<?php
				$cta_button = get_field('cta_button');
				if( $cta_button ):
					$cta_button_url = $cta_button['url'];
					$cta_button_title = $cta_button['title'];
					$cta_button_target = $cta_button['target'] ? $cta_button['target'] : '_self';
					?>
					<a class="btn btn-3" href="<?php echo esc_url( $cta_button_url ); ?>" target="<?php echo esc_attr( $cta_button_target ); ?>"><?php echo esc_html( $cta_button_title ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php get_template_part('template-parts/about'); ?>

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

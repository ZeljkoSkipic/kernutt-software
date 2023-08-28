<?php

/*
Template Name: Century
Template Post Type: page
*/

get_header();

$custom_title = get_field('custom_title');
$intro_text = get_field('intro_text');
$iframe = get_field('iframe');
?>

<div class="ks_century ks_page_content space_2">
	<div class="ks_col">
		<?php
		$image = get_field('image');
		$size = 'full';
		if( $image ) {
			echo wp_get_attachment_image( $image, $size, "", array( "class" => "image" ) );
		} ?>
		<?php
		$button = get_field('button');
		if( $button ):
			$link_url = $button['url'];
			$link_title = $button['title'];
			$link_target = $button['target'] ? $button['target'] : '_self';
			?>
			<a class="btn btn-1" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
		<?php endif; ?>
	</div>
	<?php

	if( have_rows('columns') ): ?>

		<?php while( have_rows('columns') ) : the_row(); ?>

			<div class="ks_col">
			<?php
			$title = get_sub_field('title'); ?>
			<h3 class="title-2"><?php echo $title; ?></h3>
			<ul class="body-2">
			<?php

			if( have_rows('list_items') ): ?>

				<?php while( have_rows('list_items') ) : the_row(); ?>

					<?php
					$item = get_sub_field('item'); ?>
					<li><?php echo $item; ?></li>
				<?php endwhile; ?>

			<?php endif; ?>
			</ul>
			</div>

		<?php endwhile; ?>

	<?php endif; ?>
</div>
<?php

get_footer();

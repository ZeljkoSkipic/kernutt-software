<?php

/*
Template Name: Sage Inner
Template Post Type: page
*/

get_header();

$iframe = get_field('video_embed');

?>

<div class="ks_sage ks_page_content">
	<?php
	if( !get_field('disable_hero') ) { ?>

	<div class="ks_ss_hero space_3_2">
		<h1 class="title-1"><?php the_title(); ?></h1>
	</div>
	<?php } ?>
	<div class="ks_sage_inner space_2_3">
		<div class="left">
			<div class="wp_content body-1">
				<?php the_content(); ?>
			</div>
		<?php

			if( have_rows('sage_inner_ib') ): ?>

				<?php while( have_rows('sage_inner_ib') ) : the_row(); ?>
					<div class="ks_si_ib">
					<?php
					$title = get_sub_field('title');
					$text = get_sub_field('text');
					?>

					<?php if( $title ) { ?>
						<h3 class="title-2"><?php echo $title; ?></h3>
					<?php } ?>
					<?php if( $text ) { ?>
						<div class="body-2"><?php echo $text; ?></div>
					<?php } ?>
					<?php
					$button = get_sub_field('button');
					if( $button ):
						$link_url = $button['url'];
						$link_title = $button['title'];
						$link_target = $button['target'] ? $button['target'] : '_self';
						?>
						<a class="btn btn-1" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
					</div>
				<?php endwhile; ?>

			<?php endif; ?>
		</div>
		<div class="right">
			<?php echo $iframe; ?>
		</div>
	</div>
</div>
<?php

get_footer();

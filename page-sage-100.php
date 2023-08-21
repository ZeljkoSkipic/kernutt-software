<?php

/*
Template Name: Sage 100
Template Post Type: page
*/

get_header();

$custom_title = get_field('custom_title');
$intro_text = get_field('intro_text');
$iframe = get_field('iframe');
?>

<div class="ks_sage_100 ks_page_content">
	<div class="ks_sage_hero">
		<div class="left">
			<h1 class="title-1">
				<?php if( $custom_title ) {
					echo $custom_title;
				} else {
				 the_title();
			 	} ?>
			</h1>
			<div><?php echo $intro_text; ?></div>
		</div>
		<div class="right">
			<?php echo $iframe; ?>
		</div>
	</div>
	<div class="ks_sage_section">
		<div class="left">
			<?php

			if( have_rows('blurb') ): ?>

				<?php while( have_rows('blurb') ) : the_row(); ?>

					<?php
					$title = get_sub_field('title');
					$text = get_sub_field('text'); ?>

					<div class="blurb">
						<h3 class="title-2"><?php echo $title; ?></h3>
						<div class="body-2"><?php echo $text; ?></div>
					</div>

				<?php endwhile; ?>

			<?php endif; ?>
		</div>
		<div class="right">
		<?php

		if( have_rows('info_box') ): ?>

			<?php while( have_rows('info_box') ) : the_row(); ?>

				<?php
				$title = get_sub_field('title');
				$text = get_sub_field('text'); ?>

				<div class="sage_ib">
					<h3><?php echo $title; ?></h3>
					<div class="body-2"><?php echo $text; ?></div>
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
	</div>
</div>
<?php

get_footer();

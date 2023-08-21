<?php

if( have_rows('info_box') ): ?>

	<?php while( have_rows('info_box') ) : the_row(); ?>
		<div class="info_box">
			<?php
			$image = get_sub_field('image');
			$size = 'full';
			if( $image ) {
				echo wp_get_attachment_image( $image, $size, "", array( "class" => "image" ) );
			} ?>
			<?php
			$title = get_sub_field('title');
			$content = get_sub_field('content'); ?>

			<div class="ib_text">
				<h3 class="ib_title"><?php echo $title; ?></h3>
				<div class="body-2"><?php echo $content; ?></div>
			</div>
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

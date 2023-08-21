<div class="ks_about container space_2">
	<div class="left">
		<h2 class="title-1"><?php the_field('about_title', 'option'); ?></h2>
		<div class="body-2"><?php the_field('about_text', 'option'); ?></div>
		<?php
		$about_link = get_field('about_link', 'option');
		if( $about_link ):
			$about_link_url = $about_link['url'];
			$about_link_title = $about_link['title'];
			$about_link_target = $about_link['target'] ? about_link['target'] : '_self';
			?>
			<a class="btn btn-1" href="<?php echo esc_url( $about_link_url ); ?>" target="<?php echo esc_attr( $about_link_target ); ?>"><?php echo esc_html( $about_link_title ); ?></a>
		<?php endif; ?>
	</div>
	<div class="right">
		<?php
		$about_image = get_field('about_image', 'option');
		$size = 'full';
		if( $about_image ) {
			echo wp_get_attachment_image( $about_image, $size, "", array( "class" => "about_image" ) );
		} ?>
	</div>
</div>

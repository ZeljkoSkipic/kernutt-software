<?php
if ( ( is_single() || is_page() ) && in_array( get_post_meta( get_queried_object_id(), '_et_pb_page_layout', true ), array( 'et_full_width_page', 'et_no_sidebar' ) ) ) {
	return;
}

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="sidebar">
		<?php if(is_single()) {
			$related = new WP_Query(
			array(
				'category__in'   => wp_get_post_categories( $post->ID ),
				'posts_per_page' => 3,
				'post__not_in'   => array( $post->ID )
			)
		);

		if( $related->have_posts() ) { ?>
				<h3>Related Posts</h3>

			<?php while( $related->have_posts() ) {
				$related->the_post(); ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php }
			wp_reset_postdata();
		}
		} ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>

	</div>
<?php
endif;
